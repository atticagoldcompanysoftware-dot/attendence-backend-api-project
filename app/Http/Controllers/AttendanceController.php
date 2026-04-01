<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Branch;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class AttendanceController extends Controller
{
    private const ATTENDANCE_RADIUS_METERS = 500.0;

    public function latest(Request $request): JsonResponse
    {
        $employee = $request->user();

        abort_unless($employee instanceof Employee, 401);

        return response()->json([
            'attendance' => $this->latestAttendancePayload($employee),
        ]);
    }

    public function history(Request $request): JsonResponse
    {
        $employee = $request->user();

        abort_unless($employee instanceof Employee, 401);

        $filters = $request->validate([
            'month' => ['nullable', 'date_format:Y-m'],
            'limit' => ['nullable', 'integer', 'min:1', 'max:90'],
        ]);

        $historyQuery = Attendance::query()
            ->where('empId', trim((string) $employee->empId))
            ->latest('check_in_date')
            ->latest('id');

        if (! empty($filters['month'])) {
            $month = Carbon::createFromFormat('Y-m', $filters['month'])->startOfMonth();
            $historyQuery->whereBetween('check_in_date', [
                $month->toDateString(),
                $month->copy()->endOfMonth()->toDateString(),
            ]);
        }

        $attendance = $historyQuery
            ->limit((int) ($filters['limit'] ?? 31))
            ->get();

        return response()->json([
            'attendance' => $attendance
                ->map(fn (Attendance $record): array => $this->attendancePayload($record))
                ->values(),
            'summary' => $this->historySummaryPayload($attendance),
            'month' => $filters['month'] ?? null,
        ]);
    }

    public function checkIn(Request $request): JsonResponse
    {
        $employee = $request->user();
        $timezone = $this->appTimezone();

        abort_unless($employee instanceof Employee, 401);

        $data = $request->validate([
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'photo' => ['required', 'image', 'max:5120'],
        ]);

        $today = Carbon::now($timezone);
        $existing = Attendance::query()
            ->where('empId', trim((string) $employee->empId))
            ->where('check_in_date', $today->toDateString())
            ->whereNull('check_out_date')
            ->first();

        if ($existing) {
            return response()->json([
                'message' => 'Attendance already checked in for today.',
                'attendance' => $this->attendancePayload($existing),
            ], 422);
        }

        $sessionBranchId = $this->sessionBranchId($request);
        $locationValidation = $this->validateBranchRadius(
            $sessionBranchId,
            (float) $data['latitude'],
            (float) $data['longitude']
        );

        if ($locationValidation instanceof JsonResponse) {
            return $locationValidation;
        }

        $photoPath = $this->storeAttendancePhoto(
            $request->file('photo'),
            $employee,
            'attendence',
            $sessionBranchId
        );

        $attendance = Attendance::query()->create([
            'empId' => trim($employee->empId),
            'check_in_branch_id' => $sessionBranchId,
            'photo_path' => $photoPath,
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'check_in_date' => $today->toDateString(),
            'check_in_time' => $today->format('H:i:s'),
            'check_in_distance' => $locationValidation['distanceMeters'],
        ]);

        return response()->json([
            'message' => 'Attendance checked in successfully.',
            'attendance' => $this->attendancePayload($attendance),
        ], 201);
    }

    public function checkOut(Request $request): JsonResponse
    {
        $employee = $request->user();
        $timezone = $this->appTimezone();

        abort_unless($employee instanceof Employee, 401);

        $data = $request->validate([
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'photo' => ['required', 'image', 'max:5120'],
        ]);

        $attendance = Attendance::query()
            ->where('empId', trim((string) $employee->empId))
            ->where('check_in_date', Carbon::today($timezone)->toDateString())
            ->whereNull('check_out_date')
            ->latest('id')
            ->first();

        if (! $attendance) {
            return response()->json([
                'message' => 'No active attendance found for today.',
            ], 404);
        }

        $sessionBranchId = $this->sessionBranchId($request);
        $locationValidation = $this->validateBranchRadius(
            $sessionBranchId,
            (float) $data['latitude'],
            (float) $data['longitude']
        );

        if ($locationValidation instanceof JsonResponse) {
            return $locationValidation;
        }

        $checkOutPhotoPath = $this->storeAttendancePhoto(
            $request->file('photo'),
            $employee,
            'attendence_checkout',
            $sessionBranchId
        );

        $now = Carbon::now($timezone);
        $attendance->update([
            'check_out_branch_id' => $sessionBranchId,
            'check_out_photo_path' => $checkOutPhotoPath,
            'check_out_latitude' => $data['latitude'],
            'check_out_longitude' => $data['longitude'],
            'check_out_date' => $now->toDateString(),
            'check_out_time' => $now->format('H:i:s'),
            'check_out_distance' => $locationValidation['distanceMeters'],
        ]);

        return response()->json([
            'message' => 'Attendance checked out successfully.',
            'attendance' => $this->attendancePayload($attendance->fresh()),
        ]);
    }

    private function latestAttendancePayload(Employee $employee): ?array
    {
        $attendance = Attendance::query()
            ->where('empId', trim((string) $employee->empId))
            ->latest('id')
            ->first();

        return $attendance ? $this->attendancePayload($attendance) : null;
    }

    private function historySummaryPayload($attendance): array
    {
        $completedRecords = $attendance
            ->filter(fn (Attendance $record): bool => ! empty($record->check_out_date) && ! empty($record->check_out_time))
            ->count();

        return [
            'totalRecords' => $attendance->count(),
            'presentDays' => $attendance->pluck('check_in_date')->unique()->count(),
            'completedRecords' => $completedRecords,
            'activeRecords' => $attendance->count() - $completedRecords,
        ];
    }

    private function attendancePayload(Attendance $attendance): array
    {
        $photoPath = trim((string) $attendance->photo_path);
        $checkOutPhotoPath = trim((string) $attendance->check_out_photo_path);
        $hasCheckedOut = ! empty($attendance->check_out_date) && ! empty($attendance->check_out_time);
        $checkInBranchId = $this->clean((string) $attendance->check_in_branch_id);
        $checkOutBranchId = $hasCheckedOut
            ? $this->clean((string) $attendance->check_out_branch_id)
            : '';

        return [
            'id' => $attendance->id,
            'empId' => trim((string) $attendance->empId),
            'checkInBranchId' => $checkInBranchId,
            'checkOutBranchId' => $checkOutBranchId,
            'photoPath' => $photoPath,
            'photoUrl' => $this->resolvePhotoUrl($photoPath),
            'checkOutPhotoPath' => $checkOutPhotoPath,
            'checkOutPhotoUrl' => $this->resolvePhotoUrl($checkOutPhotoPath),
            'latitude' => $attendance->latitude === null ? null : (float) $attendance->latitude,
            'longitude' => $attendance->longitude === null ? null : (float) $attendance->longitude,
            'checkOutLatitude' => $attendance->check_out_latitude === null ? null : (float) $attendance->check_out_latitude,
            'checkOutLongitude' => $attendance->check_out_longitude === null ? null : (float) $attendance->check_out_longitude,
            'checkInDate' => $attendance->check_in_date,
            'checkInTime' => $attendance->check_in_time,
            'checkOutDate' => $attendance->check_out_date,
            'checkOutTime' => $attendance->check_out_time,
        ];
    }

    private function resolvePhotoUrl(?string $path): string
    {
        $trimmed = trim((string) $path);

        if ($trimmed === '') {
            return '';
        }

        if (preg_match('/^https?:\/\//i', $trimmed) === 1) {
            return $trimmed;
        }

        return url(ltrim($trimmed, '/'));
    }

    private function storeAttendancePhoto(
        $image,
        Employee $employee,
        string $prefix = 'attendence',
        ?string $sessionBranchId = null
    ): string
    {
        $directory = public_path('storage/AttendenceImage');

        if (! File::exists($directory)) {
            File::makeDirectory($directory, 0777, true);
        }

        $extension = strtolower($image->getClientOriginalExtension() ?: 'jpg');
        $branchId = preg_replace(
            '/[^A-Za-z0-9_-]+/',
            '-',
            $this->clean($sessionBranchId)
        );
        $empId = preg_replace('/[^A-Za-z0-9_-]+/', '-', trim((string) $employee->empId));
        $filename = sprintf(
            '%s_%s_%s_%s_%s.%s',
            $prefix,
            $branchId ?: 'branch',
            $empId ?: 'employee',
            Carbon::now($this->appTimezone())->format('YmdHis'),
            bin2hex(random_bytes(4)),
            $extension
        );

        Image::make($image)
            ->resize(256, 256)
            ->save($directory.'/'.$filename);

        return 'storage/AttendenceImage/'.$filename;
    }

    private function validateBranchRadius(
        string $sessionBranchId,
        float $latitude,
        float $longitude
    ): array|JsonResponse {
        $branch = $this->resolveBranch($sessionBranchId);

        if (! $branch) {
            return response()->json([
                'message' => 'Assigned branch location could not be found.',
            ], 422);
        }

        $branchLatitude = $this->parseCoordinate($branch->latitude);
        $branchLongitude = $this->parseCoordinate($branch->longitude);

        if ($branchLatitude === null || $branchLongitude === null) {
            return response()->json([
                'message' => 'Assigned branch location is not configured.',
            ], 422);
        }

        $distanceMeters = round(
            $this->calculateDistanceMeters(
                $latitude,
                $longitude,
                $branchLatitude,
                $branchLongitude
            ),
            2
        );

        if ($distanceMeters > self::ATTENDANCE_RADIUS_METERS) {
            $branchLabel = $this->clean((string) ($branch->branchName ?: $branch->branchId));

            return response()->json([
                'message' => sprintf(
                    'You are %s away from %s. Attendance is allowed only within %s.',
                    $this->formatDistance($distanceMeters),
                    $branchLabel,
                    $this->formatDistance(self::ATTENDANCE_RADIUS_METERS)
                ),
                'distanceMeters' => $distanceMeters,
                'allowedRadiusMeters' => self::ATTENDANCE_RADIUS_METERS,
                'withinAllowedRadius' => false,
            ], 422);
        }

        return ['distanceMeters' => $distanceMeters];
    }

    private function resolveBranch(?string $branchId = null): ?Branch
    {
        $branchId = $this->clean($branchId);

        if ($branchId === '') {
            return null;
        }

        return Branch::query()
            ->select(['id', 'branchId', 'branchName', 'latitude', 'longitude'])
            ->whereRaw('TRIM(branchId) = ?', [$branchId])
            ->first();
    }

    private function sessionBranchId(Request $request): string
    {
        $abilities = $request->user()?->currentAccessToken()?->abilities ?? [];

        foreach ($abilities as $ability) {
            $normalizedAbility = trim((string) $ability);

            if (str_starts_with($normalizedAbility, 'branch:')) {
                return $this->clean(substr($normalizedAbility, 7));
            }
        }

        return '';
    }

    private function parseCoordinate($value): ?float
    {
        $trimmed = trim((string) $value);

        if ($trimmed === '' || ! is_numeric($trimmed)) {
            return null;
        }

        return (float) $trimmed;
    }

    private function calculateDistanceMeters(
        float $fromLatitude,
        float $fromLongitude,
        float $toLatitude,
        float $toLongitude
    ): float {
        $earthRadius = 6371000.0;
        $latitudeDelta = deg2rad($toLatitude - $fromLatitude);
        $longitudeDelta = deg2rad($toLongitude - $fromLongitude);
        $fromLatitudeRad = deg2rad($fromLatitude);
        $toLatitudeRad = deg2rad($toLatitude);

        $a = sin($latitudeDelta / 2) ** 2 +
            cos($fromLatitudeRad) * cos($toLatitudeRad) *
            sin($longitudeDelta / 2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    private function formatDistance(float $distanceMeters): string
    {
        if ($distanceMeters >= 1000) {
            return number_format($distanceMeters / 1000, 2).' km';
        }

        return round($distanceMeters).' m';
    }

    private function clean(?string $value): string
    {
        return trim((string) $value);
    }

    private function appTimezone(): string
    {
        return (string) config('app.timezone', 'Asia/Kolkata');
    }
}

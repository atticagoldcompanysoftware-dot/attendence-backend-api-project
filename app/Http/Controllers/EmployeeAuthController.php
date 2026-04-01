<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EmployeeAuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'branchId' => ['required', 'string'],
            'empId' => ['required', 'string'],
        ]);

        $branchId = trim($credentials['branchId']);
        $empId = trim($credentials['empId']);
        $branch = $this->resolveBranch($branchId);

        $employee = Employee::query()
            ->whereRaw('TRIM(empId) = ?', [$empId])
            ->first();

        if (! $branch || ! $employee) {
            throw ValidationException::withMessages([
                'branchId' => ['Invalid branch ID or password.'],
            ]);
        }

        $employee->tokens()->delete();
        $sessionBranchId = $this->clean($branchId);

        return response()->json([
            'token' => $employee->createToken('flutter-login', [
                $this->branchSessionAbility($sessionBranchId),
            ])->plainTextToken,
            'employee' => $this->employeePayload($employee, $sessionBranchId),
        ]);
    }

    public function profile(Request $request): JsonResponse
    {
        $employee = $request->user();

        abort_unless($employee instanceof Employee, 401);
        $sessionBranchId = $this->sessionBranchId($request);

        return response()->json([
            'employee' => $this->employeePayload($employee, $sessionBranchId),
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()?->currentAccessToken()?->delete();

        return response()->json([
            'message' => 'Logged out successfully.',
        ]);
    }

    private function employeePayload(Employee $employee, ?string $sessionBranchId = null): array
    {
        $resolvedBranchId = $this->clean($sessionBranchId);
        $branch = $this->resolveBranch($resolvedBranchId);

        return [
            'id' => $employee->id,
            'branchId' => $this->clean($branch?->branchId ?? $resolvedBranchId),
            'branchTableId' => $branch?->id,
            'branchName' => $this->clean($branch?->branchName),
            'branchLatitude' => $this->parseNullableFloat($branch?->latitude),
            'branchLongitude' => $this->parseNullableFloat($branch?->longitude),
            'empId' => $this->clean($employee->empId),
            'name' => $this->clean($employee->name),
            'contact' => $this->clean($employee->contact),
            'mailId' => $this->clean($employee->mailId),
            'address' => $this->clean($employee->address),
            'location' => $this->clean($employee->location),
            'designation' => $this->clean($employee->designation),
            'photo' => $this->clean($employee->photo),
            'rating' => $employee->rating,
            'status' => $this->clean($employee->status),
            'salary' => $employee->salary,
            'advance' => $employee->advance,
        ];
    }

    private function clean(?string $value): string
    {
        return trim((string) $value);
    }

    private function parseNullableFloat($value): ?float
    {
        $trimmed = trim((string) $value);

        if ($trimmed === '' || ! is_numeric($trimmed)) {
            return null;
        }

        return (float) $trimmed;
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

    private function branchSessionAbility(string $branchId): string
    {
        return 'branch:' . $this->clean($branchId);
    }

    private function resolveBranch(string $branchId): ?Branch
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
}

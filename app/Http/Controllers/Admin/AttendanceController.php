<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Branch;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function todayAttendance(Request $request)
    {
        $validated = $request->validate([
            'state' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:100'],
            'branch_name' => ['nullable', 'string', 'max:150'],
            'emp_id' => ['nullable', 'string', 'max:50'],
            'from_date' => ['nullable', 'date_format:Y-m-d'],
            'to_date' => ['nullable', 'date_format:Y-m-d', 'after_or_equal:from_date'],
        ]);

        $filters = [
            'state' => trim((string) ($validated['state'] ?? '')),
            'city' => trim((string) ($validated['city'] ?? '')),
            'branch_name' => trim((string) ($validated['branch_name'] ?? '')),
            'emp_id' => trim((string) ($validated['emp_id'] ?? '')),
            'from_date' => trim((string) ($validated['from_date'] ?? '')),
            'to_date' => trim((string) ($validated['to_date'] ?? '')),
        ];

        $hasFilters = collect($filters)->contains(function ($value) {
            return $value !== '';
        });

        $query = Attendance::with(['employee', 'checkInBranch', 'checkOutBranch'])
            ->latest('created_at')
            ->latest('id');

        if ($hasFilters) {
            if ($filters['emp_id'] !== '') {
                $query->where('empId', $filters['emp_id']);
            }

            if ($filters['from_date'] !== '') {
                $query->whereDate('created_at', '>=', $filters['from_date']);
            }

            if ($filters['to_date'] !== '') {
                $query->whereDate('created_at', '<=', $filters['to_date']);
            }

            if ($filters['state'] !== '') {
                $query->where(function ($attendanceQuery) use ($filters) {
                    $attendanceQuery
                        ->whereHas('checkInBranch', function ($branchQuery) use ($filters) {
                            $branchQuery->where('state', $filters['state']);
                        })
                        ->orWhereHas('checkOutBranch', function ($branchQuery) use ($filters) {
                            $branchQuery->where('state', $filters['state']);
                        });
                });
            }

            if ($filters['city'] !== '') {
                $query->where(function ($attendanceQuery) use ($filters) {
                    $attendanceQuery
                        ->whereHas('checkInBranch', function ($branchQuery) use ($filters) {
                            $branchQuery->where('city', $filters['city']);
                        })
                        ->orWhereHas('checkOutBranch', function ($branchQuery) use ($filters) {
                            $branchQuery->where('city', $filters['city']);
                        });
                });
            }

            if ($filters['branch_name'] !== '') {
                $query->where(function ($attendanceQuery) use ($filters) {
                    $attendanceQuery
                        ->whereHas('checkInBranch', function ($branchQuery) use ($filters) {
                            $branchQuery->where('branchName', $filters['branch_name']);
                        })
                        ->orWhereHas('checkOutBranch', function ($branchQuery) use ($filters) {
                            $branchQuery->where('branchName', $filters['branch_name']);
                        });
                });
            }
        } else {
            $query->whereDate('created_at', today());
        }

        $todayAttendance = $query->get();

        $states = Branch::query()
            ->whereNotNull('state')
            ->where('state', '!=', '')
            ->distinct()
            ->orderBy('state')
            ->pluck('state');

        $cities = Branch::query()
            ->whereNotNull('city')
            ->where('city', '!=', '')
            ->distinct()
            ->orderBy('city')
            ->pluck('city');

        $branchNames = Branch::query()
            ->whereNotNull('branchName')
            ->where('branchName', '!=', '')
            ->distinct()
            ->orderBy('branchName')
            ->pluck('branchName');

        $employees = Employee::query()
            ->whereNotNull('empId')
            ->where('empId', '!=', '')
            ->orderBy('empId')
            ->get(['empId', 'name']);

        return view('admin.attendance.today', compact(
            'todayAttendance',
            'filters',
            'hasFilters',
            'states',
            'cities',
            'branchNames',
            'employees'
        ));
    }
}

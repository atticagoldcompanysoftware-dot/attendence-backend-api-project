<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function todayAttendance()
    {
        $todayAttendance = Attendance::with(['employee', 'checkInBranch', 'checkOutBranch'])->whereDate('created_at', today())->latest()->get();
        return view('admin.attendance.today', compact('todayAttendance'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Branch;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;


class AdminController extends Controller
{
    public function login()
    {
        return view("admin.login");
    }


    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            $notification1 = array(
                'message' => 'Admin Login Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('admin-dashboard')->with($notification1);
        } else {
            $notification2 = array(
                'message' => 'Invalid Credentials',
                'alert-type' => 'error'
            );
            return back()->with($notification2);
        }
    }

    public function dashboard()
    {
        $BranchCount = Branch::count();
        $activeBranchCount = Branch::where('status', 1)->count();
        $inActiveBranchCount = Branch::where('status', 0)->count();
        $employeeCount = Employee::count();
        $todayAttendenceCount = Attendance::whereDate('created_at', today())->count();
        $singlePunchCount = Attendance::whereDate('created_at', today())
            ->whereNull('check_out_date')
            ->whereNull('check_out_time')
            ->whereNull('check_out_photo_path')
            ->whereNull('check_out_distance')
            ->whereColumn('updated_at', 'created_at')
            ->count();

        return view("admin.dashboard", compact(
            'BranchCount',
            'activeBranchCount',
            'inActiveBranchCount',
            'employeeCount',
            'todayAttendenceCount',
            'singlePunchCount'
        ));
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Admin Logout Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('admin-login')->with($notification);
    }


    public function changePassword()
    {
        return view('admin.change_password');
    }

    public function updatePassword(Request $request)
    {

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::guard('admin')->user()->password;
        if (Hash::check($request->old_password, $hashedPassword)) {
            $admin = Auth::guard('admin')->user();
            $admin->password = bcrypt($request->new_password);
            $admin->save();


            $notification1 = array(
                'message' => 'Password Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('admin-login')->with($notification1);
        } else {

            $notification2 = array(
                'message' => 'Old password is not match',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification2);
        }
    }

    public function adminProfile()
    {
        $admin = Auth::user();
        // dd($admin);
        return view('admin.profile', compact('admin'));
    }


    public function adminProfileUpdate(Request $request)
    {
        // dd($request->all());
        $admin = Auth::user();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->address = $request->address;

        if ($request->file('image')) {
            $image = $request->file('image');
            @unlink(public_path('storage/admin/' . $admin->image));
            $filename = 'admin' . time() . '.' . $image->getClientOriginalExtension();

            // installing image intervention
            // composer require intervention/image

            // config/app.php
            // Intervention\Image\ImageServiceProvider::class,
            // 'Image' => Intervention\Image\Facades\Image::class,

            // php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravelRecent"


            Image::make($image)->resize(256, 256)->save('storage/admin/' . $filename);
            $filePath = 'storage/admin/' . $filename;
            $admin->image = $filename;
        }
        $admin->save();



        return redirect()->back()->with('flash_success', 'Admin Profile Updated Successfully');
    }
}

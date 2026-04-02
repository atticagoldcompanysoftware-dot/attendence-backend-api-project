<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\EmployeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function () {
    return "Abhiram";
});


Route::group(
    ['prefix' => 'admin'],
    function () {
        Route::get('/login', [AdminController::class, 'login'])->name('admin-login');
        Route::post('/login', [AdminController::class, 'loginPost'])->name('admin-login-post');
        Route::group(
            ['middleware' => 'auth:admin'],
            function () {
                Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin-dashboard');
                Route::get('/logout', [Admincontroller::class, 'adminLogout'])->name('admin-logout');
                Route::get('/profile', [Admincontroller::class, 'adminProfile'])->name('admin-profile');
                Route::post('/profile/update', [AdminController::class, 'adminProfileUpdate'])->name('admin-profile-update');
                Route::get('/change/password', [Admincontroller::class, 'changePassword'])->name('admin-change-password');
                Route::post('/update/password', [AdminController::class, 'updatePassword'])->name('admin-password-update');

                Route::get('/branch/create', [BranchController::class, 'create'])->name('admin-branch-create');
                Route::post('/branch/store', [BranchController::class, 'store'])->name('admin-branch-store');
                Route::get('/branch/index', [BranchController::class, 'index'])->name('admin-branch-index');
                Route::get('/branch/edit/{id}', [BranchController::class, 'edit'])->name('admin-branch-edit');
                Route::post('/branch/update', [BranchController::class, 'update'])->name('admin-branch-update');
                Route::get('/branch/inactive/{id}', [BranchController::class, 'inactive'])->name('admin-branch-inactive');
                Route::get('/branch/active/{id}', [BranchController::class, 'active'])->name('admin-branch-active');
                Route::get('/branch/delete/{id}', [BranchController::class, 'delete'])->name('admin-branch-delete');


                Route::get('/employee/create', [EmployeeController::class, 'create'])->name('admin-employee-create');
                Route::post('/employee/store', [EmployeeController::class, 'store'])->name('admin-employee-store');
                Route::get('/employee/index', [EmployeeController::class, 'index'])->name('admin-employee-index');
                Route::get('/employee/edit/{id}', [EmployeeController::class, 'edit'])->name('admin-employee-edit');
                Route::post('/employee/update', [EmployeeController::class, 'update'])->name('admin-employee-update');
                Route::get('/employee/inactive/{id}', [EmployeeController::class, 'inactive'])->name('admin-employee-inactive');
                Route::get('/employee/active/{id}', [EmployeeController::class, 'active'])->name('admin-employee-active');
                Route::get('/employee/delete/{id}', [EmployeeController::class, 'delete'])->name('admin-employee-delete');

                Route::get('/attendance/today', [AttendanceController::class, 'todayAttendance'])->name('admin-attendance-today');
            }




        );
    }
);

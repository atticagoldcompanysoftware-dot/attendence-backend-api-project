<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function create()
    {
        return view('admin.employee.create');
    }


    public function store(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'empId' => 'required',
            'name' => 'required',
        ], [
            'empId.required' => 'Employee ID Required',
            'name.required' => 'Employee Name Required',
        ]);




        $employee = new Employee();
        $employee->empId = $request->empId;
        $employee->name = $request->name;
        $employee->contact = $request->contact;
        $employee->address = $request->address;
        $employee->designation = $request->designation;
        $employee->doj = $request->doj;
        $employee->shift_timing = $request->shift_timing;
        $employee->gender = $request->gender;
        $employee->marital_status = $request->marital_status;
        $employee->salary = $request->salary;
        $employee->save();

        $notification = array(
            'message' => 'Employee Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin-employee-index')->with($notification);
    }


    public function index()
    {
        $datas = Employee::orderBy('empId', 'asc')->get();
        return view('admin.employee.index', compact('datas'));
    }


    public function edit($id)
    {
        $data = Employee::findOrFail($id);
        return view('admin.employee.edit', compact('data'));
    }

    public function update(Request $request)
    {

        $id = $request->id;

        Employee::findOrFail($id)->update([
            'empId' => $request->empId,
            'name' => $request->name,
            'contact' => $request->contact,
            'address' => $request->address,
            'designation' => $request->designation,
            'doj' => $request->doj,
            'shift_timing' => $request->shift_timing,
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'remark' => $request->remark,
            'salary' => $request->salary,
        ]);

        $notification = array(
            'message' => 'Employee Updated Successfully',
            'alert-type' => 'success'

        );

        return redirect()->route('admin-employee-index')->with($notification);
    }



    public function inactive($id)
    {
        Employee::findOrFail($id)->update(['status' => 'Inactive']);

        $notification = array(
            'message' => 'Employee InActive Successfully',
            'alert-type' => 'error'

        );
        return redirect()->back()->with($notification);
    }

    public function active($id)
    {
        Employee::findOrFail($id)->update(['status' => 'Active']);

        $notification = array(
            'message' => 'Employee Active Successfully',
            'alert-type' => 'success'

        );
        return redirect()->back()->with($notification);
    }

    public function delete($id)
    {

        Employee::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Employee Deleted Successfully',
            'alert-type' => 'success'

        );

        return redirect()->back()->with($notification);
    }
}

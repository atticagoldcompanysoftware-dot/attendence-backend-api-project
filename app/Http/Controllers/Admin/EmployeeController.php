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
        $request->validate([
            'empId' => 'required',
            'name' => 'required',
            'contact' => 'required',
            'mailId' => 'required',
            'address' => 'required',
            'designation' => 'required',
            'salary' => 'required',
            'advance' => 'required',
        ], [
            'empId.required' => 'Employee ID Required',
            'name.required' => 'Employee Name Required',
            'contact.required' => 'Employee Contact Required',
            'mailId.required' => 'Employee Mail ID Required',
            'address.required' => 'Employee Address Required',
            'designation.required' => 'Employee designation Required',
            'salary.required' => 'Employee Salary Required',
            'advance.required' => 'Employee Advance Required',
        ]);




        $employee = new Employee();
        $employee->empId = $request->empId;
        $employee->name = $request->name;
        $employee->contact = $request->contact;
        $employee->mailId = $request->mailId;
        $employee->address = $request->address;
        $employee->designation = $request->designation;
        $employee->rating = $request->rating;
        $employee->salary = $request->salary;
        $employee->advance = $request->advance;
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
            'mailId' => $request->mailId,
            'address' => $request->address,
            'designation' => $request->designation,
            'rating' => $request->rating,
            'salary' => $request->salary,
            'advance' => $request->advance,

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

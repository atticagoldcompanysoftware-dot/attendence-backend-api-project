<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{

    public function create()
    {
        return view('admin.branch.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'branchId' => 'required',
            'addressline' => 'required',
            'area' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required',
            'branchName' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'url' => 'required',
        ], [
            'branchId.required' => 'Branch Id Required',
            'addressline.required' => 'Branch Address Required',
            'area.required' => 'Branch Area Required',
            'city.required' => 'Branch City Required',
            'state.required' => 'Branch State Required',
            'pincode.required' => 'Branch Pincode Required',
            'branchName.required' => 'Branch Name Required',
            'latitude.required' => 'Branch Latitude Required',
            'longitude.required' => 'Branch Longitude Required',
            'url.required' => 'Branch URL Required',
        ]);




        $branch = new Branch();
        $branch->branchId = $request->branchId;
        $branch->addressline = $request->addressline;
        $branch->area = $request->area;
        $branch->city = $request->city;
        $branch->state = $request->state;
        $branch->pincode = $request->pincode;
        $branch->branchName = $request->branchName;
        $branch->latitude = $request->latitude;
        $branch->longitude = $request->longitude;
        $branch->url = $request->url;
        $branch->save();

        $notification = array(
            'message' => 'Branch Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin-branch-index')->with($notification);
    }


    public function index()
    {
        $datas = Branch::orderBy('branchId', 'asc')->get();
        return view('admin.branch.index', compact('datas'));
    }


    public function edit($id)
    {
        $data = Branch::findOrFail($id);
        return view('admin.branch.edit', compact('data'));
    }

    public function update(Request $request)
    {

        $id = $request->id;

        Branch::findOrFail($id)->update([
            'branchId' => $request->branchId,
            'addressline' => $request->addressline,
            'area' => $request->area,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'branchName' => $request->branchName,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'url' => $request->url,

        ]);

        $notification = array(
            'message' => 'Branch Updated Successfully',
            'alert-type' => 'success'

        );

        return redirect()->route('admin-branch-index')->with($notification);
    }



    public function inactive($id)
    {
        Branch::findOrFail($id)->update(['status' => 0]);

        $notification = array(
            'message' => 'Branch InActive Successfully',
            'alert-type' => 'error'

        );
        return redirect()->back()->with($notification);
    }

    public function active($id)
    {
        Branch::findOrFail($id)->update(['status' => 1]);

        $notification = array(
            'message' => 'Branch Active Successfully',
            'alert-type' => 'success'

        );
        return redirect()->back()->with($notification);
    }

    public function delete($id)
    {

        Branch::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Branch Deleted Successfully',
            'alert-type' => 'success'

        );

        return redirect()->back()->with($notification);
    }
}

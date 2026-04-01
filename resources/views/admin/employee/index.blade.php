@extends('admin.layout.app')
@section('content')
    <style>
        .branch-action-buttons {
            display: flex;
            flex-wrap: nowrap;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        .branch-action-buttons .btn {
            width: 42px;
            height: 30px;
            padding: 0;
        }
    </style>

    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Admin</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Employees</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a href="{{ route('admin-employee-create') }}" type="button" class="btn btn-primary">Add Employee</a>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Address</th>
                                <th>Designation</th>
                                <th>Date of Joining</th>
                                <th>Shift Timing</th>
                                <th>Gender</th>
                                <th>Marital Status</th>
                                <th>Salary</th>
                                <th>Remark</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($datas as $key => $item)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td>{{ $item->empId }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->contact }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->designation }}</td>
                                    <td>{{ $item->doj }}</td>
                                    <td>{{ $item->shift_timing }}</td>
                                    <td>{{ $item->gender }}</td>
                                    <td>{{ $item->marital_status }}</td>
                                    <td>{{ $item->salary }}</td>
                                    <td>{{ $item->remark }}</td>
                                    <td>
                                        @if ($item->status == 'Active')
                                            <span class="badge bg-grd-primary">Active</span>
                                        @else
                                            <span class="badge bg-grd-danger">InActive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="branch-action-buttons">
                                            <a href="{{ route('admin-employee-edit', $item->id) }}"
                                                class="btn btn-outline-primary d-inline-flex align-items-center justify-content-center"
                                                title="Edit" aria-label="Edit">
                                                <i class="fadeIn animated bx bx-pencil"></i>
                                            </a>
                                            <a href="{{ route('admin-employee-delete', $item->id) }}"
                                                class="btn btn-outline-danger d-inline-flex align-items-center justify-content-center"
                                                id="delete" title="Delete" aria-label="Delete">
                                                <i class="fadeIn animated bx bx-trash-alt"></i>
                                            </a>

                                            @if ($item->status == 'Active')
                                                <a href="{{ route('admin-employee-inactive', $item->id) }}"
                                                    class="btn btn-primary rounded-pill waves-effect waves-light"
                                                    title="Inactive"><i class="fa-solid fa-thumbs-down"></i></a>
                                            @else
                                                <a href="{{ route('admin-employee-active', $item->id) }}"
                                                    class="btn btn-primary rounded-pill waves-effect waves-light"
                                                    title="Active"><i class="fa-solid fa-thumbs-up"></i></a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>SL No</th>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Address</th>
                                <th>Designation</th>
                                <th>Date of Joining</th>
                                <th>Shift Timing</th>
                                <th>Gender</th>
                                <th>Marital Status</th>
                                <th>Salary</th>
                                <th>Remark</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>


    </div>
@endsection

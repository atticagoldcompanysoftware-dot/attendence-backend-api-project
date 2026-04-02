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
                        <li class="breadcrumb-item active" aria-current="page">Today Attendance</li>
                    </ol>
                </nav>
            </div>
            {{-- <div class="ms-auto">
                <a href="{{ route('admin-branch-create') }}" type="button" class="btn btn-primary">Add Branch</a>
            </div> --}}
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Emp Id</th>
                                <th>Emp Name</th>
                                <th>Check IN Branch Id</th>
                                <th>Check IN Branch Name</th>
                                <th>Check IN Photo</th>
                                <th>Check IN Location</th>
                                <th>Check IN Time</th>
                                <th>Check Out Branch Id</th>
                                <th>Check Out Branch Name</th>
                                <th>Check Out Photo</th>
                                <th>Check Out Location</th>
                                <th>Check Out Time</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($todayAttendance as $key => $item)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td>{{ $item->empId }}</td>
                                    <td>{{ $item->employee?->name ?? 'N/A' }}</td>
                                    <td>{{ $item->check_in_branch_id }}</td>
                                    <td>{{ $item->checkInBranch?->branchName ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ !empty($item->photo_path) ? url('public/' . $item->photo_path) : url('public/no_image.jpg') }}"
                                            target="_blank" rel="noopener noreferrer">
                                            <img src="{{ !empty($item->photo_path) ? url('public/' . $item->photo_path) : url('public/no_image.jpg') }}"
                                                class="rounded-circle p-1 border" width="100" height="100" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        @if ($item->latitude && $item->longitude)
                                            <a href="{{ 'https://www.google.com/maps/search/?api=1&query=' . $item->latitude . ',' . $item->longitude }}"
                                                target="_blank" rel="noopener noreferrer">
                                                View Location
                                            </a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $item->check_in_time }}</td>
                                    <td>{{ $item->check_out_branch_id }}</td>
                                    <td>{{ $item->checkOutBranch?->branchName ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ !empty($item->check_out_photo_path) ? url('public/' . $item->check_out_photo_path) : url('public/no_image.jpg') }}"
                                            target="_blank" rel="noopener noreferrer">
                                            <img src="{{ !empty($item->check_out_photo_path) ? url('public/' . $item->check_out_photo_path) : url('public/no_image.jpg') }}"
                                                class="rounded-circle p-1 border" width="100" height="100" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        @if ($item->check_out_latitude && $item->check_out_longitude)
                                            <a href="{{ 'https://www.google.com/maps/search/?api=1&query=' . $item->check_out_latitude . ',' . $item->check_out_longitude }}"
                                                target="_blank" rel="noopener noreferrer">
                                                View Location
                                            </a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $item->check_in_time }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>SL No</th>
                                <th>Emp Id</th>
                                <th>Emp Name</th>
                                <th>Check IN Branch Id</th>
                                <th>Check IN Branch Name</th>
                                <th>Check IN Photo</th>
                                <th>Check IN Location</th>
                                <th>Check IN Time</th>
                                <th>Check Out Branch Id</th>
                                <th>Check Out Branch Name</th>
                                <th>Check Out Photo</th>
                                <th>Check Out Location</th>
                                <th>Check Out Time</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>


    </div>
@endsection

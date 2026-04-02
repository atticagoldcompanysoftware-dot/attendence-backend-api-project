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
                        <li class="breadcrumb-item active" aria-current="page">Attendance</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <form action="{{ route('admin-attendance-today') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-md-2">
                            <label class="form-label">State</label>
                            <select name="state" class="form-select">
                                <option value="">All States</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state }}"
                                        {{ ($filters['state'] ?? '') === $state ? 'selected' : '' }}>
                                        {{ $state }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">City</label>
                            <select name="city" class="form-select">
                                <option value="">All Cities</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city }}"
                                        {{ ($filters['city'] ?? '') === $city ? 'selected' : '' }}>
                                        {{ $city }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Branch Name</label>
                            <select name="branch_name" class="form-select">
                                <option value="">All Branches</option>
                                @foreach ($branchNames as $branchName)
                                    <option value="{{ $branchName }}"
                                        {{ ($filters['branch_name'] ?? '') === $branchName ? 'selected' : '' }}>
                                        {{ $branchName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Employee ID</label>
                            <select name="emp_id" class="form-select">
                                <option value="">All Employees</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->empId }}"
                                        {{ ($filters['emp_id'] ?? '') === $employee->empId ? 'selected' : '' }}>
                                        {{ $employee->empId }} - {{ $employee->name ?? 'N/A' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">From Date</label>
                            <input type="date" name="from_date" class="form-control"
                                value="{{ $filters['from_date'] ?? '' }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">To Date</label>
                            <input type="date" name="to_date" class="form-control"
                                value="{{ $filters['to_date'] ?? '' }}">
                        </div>
                        <div class="col-12 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Filter Attendance</button>
                            <a href="{{ route('admin-attendance-today') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>


            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Created Date</th>
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

                            @forelse ($todayAttendance as $key => $item)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td>{{ optional($item->created_at)->format('Y-m-d') ?? 'N/A' }}</td>
                                    <td>{{ $item->empId }}</td>
                                    <td>{{ $item->employee?->name ?? 'N/A' }}</td>
                                    <td>{{ $item->check_in_branch_id }}</td>
                                    <td>{{ $item->checkInBranch?->branchName ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ !empty($item->photo_path) ? url('public/' . $item->photo_path) : url('public/no_image.jpg') }}"
                                            target="_blank" rel="noopener noreferrer">
                                            <img src="{{ !empty($item->photo_path) ? url('public/' . $item->photo_path) : url('public/no_image.jpg') }}"
                                                class="rounded-circle p-1 border" width="100" height="100"
                                                alt="">
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
                                    <td>{{ $item->check_in_time ?? 'N/A' }}</td>
                                    <td>{{ $item->check_out_branch_id }}</td>
                                    <td>{{ $item->checkOutBranch?->branchName ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ !empty($item->check_out_photo_path) ? url('public/' . $item->check_out_photo_path) : url('public/no_image.jpg') }}"
                                            target="_blank" rel="noopener noreferrer">
                                            <img src="{{ !empty($item->check_out_photo_path) ? url('public/' . $item->check_out_photo_path) : url('public/no_image.jpg') }}"
                                                class="rounded-circle p-1 border" width="100" height="100"
                                                alt="">
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
                                    <td>{{ $item->check_out_time ?? 'N/A' }}</td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="14" class="text-center">No attendance records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>SL No</th>
                                <th>Created Date</th>
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

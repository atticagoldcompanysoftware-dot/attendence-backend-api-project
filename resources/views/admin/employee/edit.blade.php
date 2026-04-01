@extends('admin.layout.app')
@section('content')
    <div class="main-content">


        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Admin</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Emplyee</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">

            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <hr>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin-employee-update') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">

                            <div class="row g-3">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Employee ID</label>
                                        <input class="form-control" type="text" name="empId"
                                            placeholder="Enter Employee ID" aria-label="default input example"
                                            value="{{ $data->empId }}">
                                        @error('empId')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Employee Name</label>
                                        <input class="form-control" type="text" name="name"
                                            placeholder="Enter Employee Name" aria-label="default input example"
                                            value="{{ $data->name }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Employee Contact</label>
                                        <input class="form-control" type="text" name="contact"
                                            placeholder="Enter Employee Contact" aria-label="default input example"
                                            value="{{ $data->contact }}">
                                        @error('contact')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Employee Mail ID</label>
                                        <input class="form-control" type="text" name="mailId"
                                            placeholder="Enter Employee Mail ID" aria-label="default input example"
                                            value="{{ $data->mailId }}">
                                        @error('mailId')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Employee Designation</label>
                                        <input class="form-control" type="text" name="designation"
                                            placeholder="Enter Employee Designation" aria-label="default input example"
                                            value="{{ $data->designation }}">
                                        @error('designation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Employee Rating</label>
                                        <input class="form-control" type="number" name="rating"
                                            placeholder="Enter Employee Rating" min="1" max="10"
                                            aria-label="default input example" value="{{ $data->rating }}">
                                        @error('rating')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Employee Salary</label>
                                        <input class="form-control" type="text" name="salary"
                                            placeholder="Enter Employee Salary" aria-label="default input example"
                                            value="{{ $data->salary }}">
                                        @error('salary')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Employee Advace</label>
                                        <input class="form-control" type="text" name="advance"
                                            placeholder="Enter Employee Advance" aria-label="default input example"
                                            value="{{ $data->advance }}">
                                        @error('advance')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Employee Address</label>
                                        <textarea class="form-control" name="address" aria-label="With textarea" placeholder="Enter Employee Address">{{ $data->address }}</textarea>
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-grd btn-grd-success px-5">Update
                                            Employee</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
@endsection

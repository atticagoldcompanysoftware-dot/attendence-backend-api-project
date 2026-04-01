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
                        <li class="breadcrumb-item active" aria-current="page">Add Brach</li>
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
                        <form action="{{ route('admin-branch-store') }}" method="post">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">BranchId</label>
                                        <input class="form-control" type="text" name="branchId"
                                            placeholder="Enter branchId" aria-label="default input example">
                                        @error('branchId')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Branch Name</label>
                                        <input class="form-control" type="text" name="branchName"
                                            placeholder="Enter BranchName" aria-label="default input example">
                                        @error('branchName')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Area</label>
                                        <input class="form-control" type="text" name="area" placeholder="Enter Area"
                                            aria-label="default input example">
                                        @error('area')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">City</label>
                                        <input class="form-control" type="text" name="city" placeholder="Enter City"
                                            aria-label="default input example">
                                        @error('city')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">State</label>
                                        <input class="form-control" type="text" name="state" placeholder="Enter State"
                                            aria-label="default input example">
                                        @error('state')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Pincode</label>
                                        <input class="form-control" type="text" name="pincode"
                                            placeholder="Enter Pincode" aria-label="default input example">
                                        @error('pincode')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Latitude</label>
                                        <input class="form-control" type="text" name="latitude"
                                            placeholder="Enter Latitude" aria-label="default input example">
                                        @error('latitude')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Longitude</label>
                                        <input class="form-control" type="text" name="longitude"
                                            placeholder="Enter longitude" aria-label="default input example">
                                        @error('longitude')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">URL</label>
                                        <input class="form-control" type="text" name="url"
                                            placeholder="Enter url" aria-label="default input example">
                                        @error('url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Branch Address</label>
                                        <textarea class="form-control" name="addressline" aria-label="With textarea" placeholder="Enter Branch Address"></textarea>
                                        @error('addressline')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-grd btn-grd-success px-5">Add
                                            Branch</button>
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

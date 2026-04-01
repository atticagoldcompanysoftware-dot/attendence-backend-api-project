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
                        <li class="breadcrumb-item active" aria-current="page">Add Emplyee</li>
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
                        <form action="{{ route('admin-employee-store') }}" method="post">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Employee ID</label>
                                        <input class="form-control" type="text" name="empId"
                                            placeholder="Enter Employee ID" aria-label="default input example">
                                        @error('empId')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Employee Name</label>
                                        <input class="form-control" type="text" name="name"
                                            placeholder="Enter Employee Name" aria-label="default input example">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Employee Contact</label>
                                        <input class="form-control" type="text" name="contact"
                                            placeholder="Enter Employee Contact" aria-label="default input example">
                                        @error('contact')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Employee Designation</label>
                                        <select name="designation" class="form-select" id="inputSelectCountry"
                                            aria-label="Default select example">
                                            <option value="" selected>Select Designation</option>
                                            <option value="admin">admin</option>
                                            <option value="Master">Master</option>
                                            <option value="Accounts">Accounts</option>
                                            <option value="HR">HR</option>
                                            <option value="Branch">Branch</option>
                                            <option value="Assets">Assets</option>
                                            <option value="Zonal">Zonal</option>
                                            <option value="IssueHead">IssueHead</option>
                                            <option value="Agent">Agent</option>
                                            <option value="ITMaster">ITMaster</option>
                                            <option value="Legal">Legal</option>
                                            <option value="CallDisplay">CallDisplay</option>
                                            <option value="AccHead">AccHead</option>
                                            <option value="Accounts IMPS">Accounts IMPS</option>
                                            <option value="Expense Team">Expense Team</option>
                                            <option value="VM-HO">VM-HO</option>
                                            <option value="VM-AD">VM-AD</option>
                                            <option value="Issuecall">Issuecall</option>
                                            <option value="Software">Software</option>
                                            <option value="SocialMedia">SocialMedia</option>
                                            <option value="ApprovalTeam">ApprovalTeam</option>
                                            <option value="VM-REG">VM-REG</option>
                                            <option value="Call Centre Report">Call Centre Report</option>
                                            <option value="Leads">Leads</option>
                                            <option value="ZonalMaster">ZonalMaster</option>
                                            <option value="SubZonal">SubZonal</option>
                                            <option value="IssueHeadNew">IssueHeadNew</option>
                                            <option value="SundayUser">SundayUser</option>
                                            <option value="BD">BD</option>
                                            <option value="VM-WAIT">VM-WAIT</option>
                                            <option value="Reportor">Reportor</option>
                                            <option value="Goldsmith">Goldsmith</option>
                                            <option value="Call Centre">Call Centre</option>
                                            <option value="ChequesCounter">ChequesCounter</option>
                                            <option value="BusinessDeveloper">BusinessDeveloper</option>
                                            <option value="CashMovers">CashMovers</option>
                                            <option value="Task">Task</option>
                                            <option value="CallCenterUser">CallCenterUser</option>
                                            <option value="CCAdmin">CCAdmin</option>
                                            <option value="StockManager">StockManager</option>
                                            <option value="Doorstep">Doorstep</option>
                                            <option value="GoldReceiver">GoldReceiver</option>
                                            <option value="GoldAuditor">GoldAuditor</option>
                                            <option value="GoldSmelter">GoldSmelter</option>
                                            <option value="RegionalManager">RegionalManager</option>
                                            <option value="PurityMan">PurityMan</option>
                                            <option value="ExpansionUser">ExpansionUser</option>
                                            <option value="GoldBuyer">GoldBuyer</option>
                                            <option value="CashHandler">CashHandler</option>
                                            <option value="GoldAuditor2">GoldAuditor2</option>
                                            <option value="Jaya">Jaya</option>
                                            <option value="Tax">Tax</option>
                                            <option value="MD">MD</option>
                                            <option value="GoldReceiveReporter">GoldReceiveReporter</option>
                                            <option value="MIS-Team">MIS-Team</option>
                                            <option value="StoneManager">StoneManager</option>
                                            <option value="DevOps">DevOps</option>
                                            <option value="GattiSale">GattiSale</option>
                                            <option value="VM-StoneCID">VM-StoneCID</option>
                                        </select>
                                        @error('designation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Employee Salary</label>
                                        <input class="form-control" type="text" name="salary"
                                            placeholder="Enter Employee Salary" aria-label="default input example">
                                        @error('salary')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Employee Date of Joining</label>
                                        <input class="form-control" type="date" name="doj"
                                            placeholder="Enter Date of Joining" min="1" max="10"
                                            aria-label="default input example">
                                        @error('doj')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Employee Shift Timing</label>
                                        <input class="form-control" type="text" name="shift_timing"
                                            placeholder="Enter Employee Shift Timing" aria-label="default input example">
                                        @error('shift_timing')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Employee Gender</label>
                                        <select name="gender" class="form-select" id="inputSelectCountry"
                                            aria-label="Default select example">
                                            <option selected="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        @error('gender')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Employee Marital Status</label>
                                        <select name="marital_status" class="form-select" id="inputSelectCountry"
                                            aria-label="Default select example">
                                            <option selected="">Select Gender</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                        </select>
                                        @error('marital_status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Employee Address</label>
                                        <textarea class="form-control" name="address" aria-label="With textarea" placeholder="Enter Employee Address"></textarea>
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-grd btn-grd-success px-5">Add
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

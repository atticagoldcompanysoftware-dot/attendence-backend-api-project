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
                                <div class="col-md-4">
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

                                <div class="col-md-4">
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



                                <div class="col-md-4">
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



                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Employee Designation</label>
                                        <select name="designation" class="form-select" id="inputSelectCountry"
                                            aria-label="Default select example">
                                            <option value="">Select Designation</option>
                                            <option value="admin" {{ $data->designation == 'admin' ? 'selected' : '' }}>
                                                admin</option>
                                            <option value="Master" {{ $data->designation == 'Master' ? 'selected' : '' }}>
                                                Master</option>
                                            <option value="Accounts"
                                                {{ $data->designation == 'Accounts' ? 'selected' : '' }}>
                                                Accounts</option>
                                            <option value="HR" {{ $data->designation == 'HR' ? 'selected' : '' }}>HR
                                            </option>
                                            <option value="Branch" {{ $data->designation == 'Branch' ? 'selected' : '' }}>
                                                Branch</option>
                                            <option value="Assets" {{ $data->designation == 'Assets' ? 'selected' : '' }}>
                                                Assets</option>
                                            <option value="Zonal" {{ $data->designation == 'Zonal' ? 'selected' : '' }}>
                                                Zonal</option>
                                            <option value="IssueHead"
                                                {{ $data->designation == 'IssueHead' ? 'selected' : '' }}>
                                                IssueHead</option>
                                            <option value="Agent" {{ $data->designation == 'Agent' ? 'selected' : '' }}>
                                                Agent</option>
                                            <option value="ITMaster"
                                                {{ $data->designation == 'ITMaster' ? 'selected' : '' }}>
                                                ITMaster</option>
                                            <option value="Legal" {{ $data->designation == 'Legal' ? 'selected' : '' }}>
                                                Legal</option>
                                            <option value="CallDisplay"
                                                {{ $data->designation == 'CallDisplay' ? 'selected' : '' }}>
                                                CallDisplay</option>
                                            <option value="AccHead"
                                                {{ $data->designation == 'AccHead' ? 'selected' : '' }}>
                                                AccHead</option>
                                            <option value="Accounts IMPS"
                                                {{ $data->designation == 'Accounts IMPS' ? 'selected' : '' }}>
                                                Accounts IMPS</option>
                                            <option value="Expense Team"
                                                {{ $data->designation == 'Expense Team' ? 'selected' : '' }}>
                                                Expense Team</option>
                                            <option value="VM-HO" {{ $data->designation == 'VM-HO' ? 'selected' : '' }}>
                                                VM-HO</option>
                                            <option value="VM-AD" {{ $data->designation == 'VM-AD' ? 'selected' : '' }}>
                                                VM-AD</option>
                                            <option value="Issuecall"
                                                {{ $data->designation == 'Issuecall' ? 'selected' : '' }}>
                                                Issuecall</option>
                                            <option value="Software"
                                                {{ $data->designation == 'Software' ? 'selected' : '' }}>
                                                Software</option>
                                            <option value="SocialMedia"
                                                {{ $data->designation == 'SocialMedia' ? 'selected' : '' }}>
                                                SocialMedia</option>
                                            <option value="ApprovalTeam"
                                                {{ $data->designation == 'ApprovalTeam' ? 'selected' : '' }}>
                                                ApprovalTeam</option>
                                            <option value="VM-REG" {{ $data->designation == 'VM-REG' ? 'selected' : '' }}>
                                                VM-REG</option>
                                            <option value="Call Centre Report"
                                                {{ $data->designation == 'Call Centre Report' ? 'selected' : '' }}>
                                                Call Centre Report</option>
                                            <option value="Leads" {{ $data->designation == 'Leads' ? 'selected' : '' }}>
                                                Leads</option>
                                            <option value="ZonalMaster"
                                                {{ $data->designation == 'ZonalMaster' ? 'selected' : '' }}>
                                                ZonalMaster</option>
                                            <option value="SubZonal"
                                                {{ $data->designation == 'SubZonal' ? 'selected' : '' }}>
                                                SubZonal</option>
                                            <option value="IssueHeadNew"
                                                {{ $data->designation == 'IssueHeadNew' ? 'selected' : '' }}>
                                                IssueHeadNew</option>
                                            <option value="SundayUser"
                                                {{ $data->designation == 'SundayUser' ? 'selected' : '' }}>
                                                SundayUser</option>
                                            <option value="BD" {{ $data->designation == 'BD' ? 'selected' : '' }}>BD
                                            </option>
                                            <option value="VM-WAIT"
                                                {{ $data->designation == 'VM-WAIT' ? 'selected' : '' }}>
                                                VM-WAIT</option>
                                            <option value="Reportor"
                                                {{ $data->designation == 'Reportor' ? 'selected' : '' }}>
                                                Reportor</option>
                                            <option value="Goldsmith"
                                                {{ $data->designation == 'Goldsmith' ? 'selected' : '' }}>
                                                Goldsmith</option>
                                            <option value="Call Centre"
                                                {{ $data->designation == 'Call Centre' ? 'selected' : '' }}>
                                                Call Centre</option>
                                            <option value="ChequesCounter"
                                                {{ $data->designation == 'ChequesCounter' ? 'selected' : '' }}>
                                                ChequesCounter</option>
                                            <option value="BusinessDeveloper"
                                                {{ $data->designation == 'BusinessDeveloper' ? 'selected' : '' }}>
                                                BusinessDeveloper</option>
                                            <option value="CashMovers"
                                                {{ $data->designation == 'CashMovers' ? 'selected' : '' }}>
                                                CashMovers</option>
                                            <option value="Task" {{ $data->designation == 'Task' ? 'selected' : '' }}>
                                                Task</option>
                                            <option value="CallCenterUser"
                                                {{ $data->designation == 'CallCenterUser' ? 'selected' : '' }}>
                                                CallCenterUser</option>
                                            <option value="CCAdmin"
                                                {{ $data->designation == 'CCAdmin' ? 'selected' : '' }}>
                                                CCAdmin</option>
                                            <option value="StockManager"
                                                {{ $data->designation == 'StockManager' ? 'selected' : '' }}>
                                                StockManager</option>
                                            <option value="Doorstep"
                                                {{ $data->designation == 'Doorstep' ? 'selected' : '' }}>
                                                Doorstep</option>
                                            <option value="GoldReceiver"
                                                {{ $data->designation == 'GoldReceiver' ? 'selected' : '' }}>
                                                GoldReceiver</option>
                                            <option value="GoldAuditor"
                                                {{ $data->designation == 'GoldAuditor' ? 'selected' : '' }}>
                                                GoldAuditor</option>
                                            <option value="GoldSmelter"
                                                {{ $data->designation == 'GoldSmelter' ? 'selected' : '' }}>
                                                GoldSmelter</option>
                                            <option value="RegionalManager"
                                                {{ $data->designation == 'RegionalManager' ? 'selected' : '' }}>
                                                RegionalManager</option>
                                            <option value="PurityMan"
                                                {{ $data->designation == 'PurityMan' ? 'selected' : '' }}>
                                                PurityMan</option>
                                            <option value="ExpansionUser"
                                                {{ $data->designation == 'ExpansionUser' ? 'selected' : '' }}>
                                                ExpansionUser</option>
                                            <option value="GoldBuyer"
                                                {{ $data->designation == 'GoldBuyer' ? 'selected' : '' }}>
                                                GoldBuyer</option>
                                            <option value="CashHandler"
                                                {{ $data->designation == 'CashHandler' ? 'selected' : '' }}>
                                                CashHandler</option>
                                            <option value="GoldAuditor2"
                                                {{ $data->designation == 'GoldAuditor2' ? 'selected' : '' }}>
                                                GoldAuditor2</option>
                                            <option value="Jaya" {{ $data->designation == 'Jaya' ? 'selected' : '' }}>
                                                Jaya</option>
                                            <option value="Tax" {{ $data->designation == 'Tax' ? 'selected' : '' }}>Tax
                                            </option>
                                            <option value="MD" {{ $data->designation == 'MD' ? 'selected' : '' }}>MD
                                            </option>
                                            <option value="GoldReceiveReporter"
                                                {{ $data->designation == 'GoldReceiveReporter' ? 'selected' : '' }}>
                                                GoldReceiveReporter</option>
                                            <option value="MIS-Team"
                                                {{ $data->designation == 'MIS-Team' ? 'selected' : '' }}>
                                                MIS-Team</option>
                                            <option value="StoneManager"
                                                {{ $data->designation == 'StoneManager' ? 'selected' : '' }}>
                                                StoneManager</option>
                                            <option value="DevOps" {{ $data->designation == 'DevOps' ? 'selected' : '' }}>
                                                DevOps</option>
                                            <option value="GattiSale"
                                                {{ $data->designation == 'GattiSale' ? 'selected' : '' }}>
                                                GattiSale</option>
                                            <option value="VM-StoneCID"
                                                {{ $data->designation == 'VM-StoneCID' ? 'selected' : '' }}>
                                                VM-StoneCID</option>
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
                                            placeholder="Enter Employee Salary" aria-label="default input example"
                                            value="{{ $data->salary }}">
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
                                            aria-label="default input example" value="{{ $data->doj }}">
                                        @error('doj')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Employee Shift Timing</label>
                                        <input class="form-control" type="text" name="shift_timing"
                                            placeholder="Enter Employee Shift Timing" aria-label="default input example"
                                            value="{{ $data->shift_timing }}">
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
                                            <option value="Male" {{ $data->gender == 'Male' ? 'selected' : '' }}>
                                            <option value="Female" {{ $data->gender == 'Female' ? 'selected' : '' }}>

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
                                            <option value="Single"
                                                {{ $data->marital_status == 'Single' ? 'selected' : '' }}>
                                            <option value="Married"
                                                {{ $data->marital_status == 'Married' ? 'selected' : '' }}>

                                        </select>
                                        @error('marital_status')
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



                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="formName" class="form-label">Employee Remark</label>
                                        <textarea class="form-control" name="remark" aria-label="With textarea" placeholder="Enter Employee Remark">{{ $data->remark }}</textarea>
                                        @error('remark')
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

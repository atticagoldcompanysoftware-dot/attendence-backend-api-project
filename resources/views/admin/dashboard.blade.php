@extends('admin.layout.app')
@section('content')
    <style>
        .dashboard-stat-card .card-body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            height: 160px;
        }

        .dashboard-stat-card h5 {
            margin-bottom: 10px;
            color: #fff;
        }

        .dashboard-stat-number {
            color: #fff;
            font-size: 50px;
            font-weight: 700;
            line-height: 1;
        }
    </style>

    <div class="main-content">

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-lg-4 g-3">
                        <div class="col">
                            <div class="card shadow-none bg-grd-voilet mb-0 dashboard-stat-card" style="height: 160px;">
                                <div class="card-body">
                                    <h5>TOTAL Branches</h5>
                                    <div class="dashboard-stat-number">{{ $BranchCount }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow-none bg-grd-primary mb-0 dashboard-stat-card" style="height: 160px;">
                                <div class="card-body">
                                    <h5>Total Active Branches</h5>
                                    <div class="dashboard-stat-number">{{ $activeBranchCount }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow-none bg-grd-success mb-0 dashboard-stat-card" style="height: 160px;">
                                <div class="card-body">
                                    <h5>Total Inactive Branches</h5>
                                    <div class="dashboard-stat-number">{{ $inActiveBranchCount }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow-none bg-grd-danger mb-0 dashboard-stat-card" style="height: 160px;">
                                <div class="card-body">
                                    <h5>Employee Count</h5>
                                    <div class="dashboard-stat-number">{{ $employeeCount }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow-none bg-grd-deep-blue mb-0 dashboard-stat-card" style="height: 160px;">
                                <div class="card-body">
                                    <h5>Today Attendance</h5>
                                    <div class="dashboard-stat-number">{{ $todayAttendenceCount }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow-none bg-grd-danger mb-0 dashboard-stat-card" style="height: 160px;">
                                <div class="card-body">
                                    <h5>Single Punch</h5>
                                    <div class="dashboard-stat-number">{{ $singlePunchCount }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col">
                            <div class="card shadow-none bg-grd-warning mb-0 dashboard-stat-card" style="height: 160px;">
                                <div class="card-body">
                                    <h5>LESS TIME LOGGED</h5>
                                    <div class="dashboard-stat-number">50</div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow-none bg-grd-voilet mb-0 dashboard-stat-card" style="height: 160px;">
                                <div class="card-body">
                                    <h5>AVERAGE LOGGED TIME</h5>
                                    <div class="dashboard-stat-number">50</div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow-none bg-grd-primary mb-0 dashboard-stat-card" style="height: 160px;">
                                <div class="card-body">
                                    <h5>WORKING / SUNDAY</h5>
                                    <div class="dashboard-stat-number">50</div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow-none bg-grd-success mb-0 dashboard-stat-card" style="height: 160px;">
                                <div class="card-body">
                                    <h5>SINGLE PUNCH</h5>
                                    <div class="dashboard-stat-number">50</div>
                                </div>
                            </div>
                        </div> --}}


                    </div><!--end row-->
                </div>
            </div>
        </div>
    </div>
@endsection

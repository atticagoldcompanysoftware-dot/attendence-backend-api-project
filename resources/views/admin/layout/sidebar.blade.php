    <aside class="sidebar-wrapper" data-simplebar="true">
        <div class="sidebar-header">
            <div class="logo-icon">
                <img src="{{ asset('admin/assets/images/logo-icon.png') }}" class="logo-img" alt="">
            </div>
            <div class="logo-name flex-grow-1">
                <h5 class="mb-0">Attica Pagar</h5>
            </div>
            <div class="sidebar-close">
                <span class="material-icons-outlined">close</span>
            </div>
        </div>
        <div class="sidebar-nav">
            <!--navigation-->
            <ul class="metismenu" id="sidenav">
                <li>
                    <a href="{{ route('admin-dashboard') }}">
                        <div class="parent-icon"><i class="material-icons-outlined">home</i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>

                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon">
                            <i class="material-icons-outlined">widgets</i>
                        </div>
                        <div class="menu-title">Branch</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin-branch-create') }}"><i
                                    class="material-icons-outlined">arrow_right</i>Add Branch</a>
                        </li>
                        <li>
                            <a href="{{ route('admin-branch-index') }}"><i
                                    class="material-icons-outlined">arrow_right</i>All
                                Branches</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class="material-icons-outlined">apps</i>
                        </div>
                        <div class="menu-title">Employee</div>
                    </a>
                    <ul>
                        <li><a href="{{ route('admin-employee-create') }}"><i
                                    class="material-icons-outlined">arrow_right</i>Add Employee</a>
                        </li>
                        <li><a href="{{ route('admin-employee-index') }}"><i
                                    class="material-icons-outlined">arrow_right</i>All Employees</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="material-icons-outlined">shopping_bag</i>
                        </div>
                        <div class="menu-title">Attendance</div>
                    </a>
                    <ul>
                        <li><a href="{{ route('admin-attendance-today') }}"><i
                                    class="material-icons-outlined">arrow_right</i>Today
                                Attendance</a>
                        </li>
                        {{-- <li><a href="ecommerce-products.html"><i
                                    class="material-icons-outlined">arrow_right</i>Products</a>
                        </li>
                        <li><a href="ecommerce-customers.html"><i
                                    class="material-icons-outlined">arrow_right</i>Customers</a>
                        </li>
                        <li><a href="ecommerce-customer-details.html"><i
                                    class="material-icons-outlined">arrow_right</i>Customer Details</a>
                        </li>
                        <li><a href="ecommerce-orders.html"><i class="material-icons-outlined">arrow_right</i>Orders</a>
                        </li>
                        <li><a href="ecommerce-order-details.html"><i
                                    class="material-icons-outlined">arrow_right</i>Order Details</a>
                        </li> --}}
                    </ul>
                </li>
            </ul>
            <!--end navigation-->
        </div>
    </aside>

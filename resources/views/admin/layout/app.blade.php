<!doctype html>
<html lang="en" data-bs-theme="blue-theme">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <!--favicon-->
    <link rel="icon" href="{{ asset('public/admin/assets/images/favicon-96x96.png') }}" type="image/png">
    <!-- loader-->
    <link href="{{ asset('public/admin/assets/css/pace.min.css') }}" rel="stylesheet">
    <script src="{{ asset('public/admin/assets/js/pace.min.js') }}"></script>

    <!--plugins-->
    <link href="{{ asset('public/admin/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/admin/assets/plugins/metismenu/metisMenu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/assets/plugins/metismenu/mm-vertical.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/admin/assets/plugins/simplebar/css/simplebar.css') }}">
    <!--bootstrap css-->
    <link href="{{ asset('public/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    <!--main css-->
    <link href="{{ asset('public/admin/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/sass/main.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/sass/dark-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/sass/blue-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/sass/semi-dark.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/sass/bordered-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/sass/responsive.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdn.boxicons.com/animations.min.css" rel="stylesheet">
    <link href="{{ asset('public/admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}"
        rel="stylesheet" />
    {{-- thumbs up and down font awesome start --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- thumbs up and down font awesome end --}}
    <style>
        body.admin-layout {
            min-height: 100vh;
        }

        body.admin-layout .main-wrapper {
            min-height: calc(100vh - 70px);
            display: flex;
            flex-direction: column;
            padding-bottom: 0;
        }

        body.admin-layout .admin-page-content {
            flex: 1 0 auto;
        }

        body.admin-layout .page-footer {
            position: static;
            left: auto;
            right: auto;
            bottom: auto;
            width: 100%;
            margin-top: auto;
        }
    </style>

</head>

<body class="admin-layout">

    <!--start header-->
    @include('admin.layout.header')
    <!--end top header-->


    <!--start sidebar-->
    @include('admin.layout.sidebar')
    <!--end sidebar-->


    <!--start main wrapper-->
    <main class="main-wrapper">
        <div class="admin-page-content">
            @yield('content')
        </div>

        <!--start footer-->
        @include('admin.layout.footer')
        <!--end footer-->
    </main>
    <!--end main wrapper-->


    <!--start overlay-->
    <div class="overlay btn-toggle"></div>
    <!--end overlay-->

    <!--bootstrap js-->
    <script src="{{ asset('public/admin/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('public/admin/assets/plugins/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/plugins/peity/jquery.peity.min.js') }}"></script>
    <script>
        $(".data-attributes span").peity("donut")
    </script>
    <script src="{{ asset('public/admin/assets/js/main.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/dashboard1.js') }}"></script>
    <script>
        new PerfectScrollbar(".user-list")
    </script>

    <script src="{{ asset('public/admin/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var table = $('#example2').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print']
            });

            table.buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        });
    </script>
    <!--Datatable-->

</body>

</html>

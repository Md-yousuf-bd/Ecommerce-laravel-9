<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ECOMMERCE') }}</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('admins/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admins/vendors/base/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admins/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('admins/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('admins/images/favicon.png') }}" />

    @livewireStyles
</head>

<body>

    <div class="container-scroller">
        @include('layouts.inc.admin.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('layouts.inc.admin.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>


    <!-- plugins:js -->
    <script src="{{ asset('admins/vendors/base/vendor.bundle.base.js') }}"></script>
    <!-- Plugin js for this page-->
    <script src="{{ asset('admins/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admins/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <!-- inject:js -->
    <script src="{{ asset('admins/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admins/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('admins/js/template.js') }}"></script>
    <!-- Custom js for this page-->
    <script src="{{ asset('admins/js/dashboard.js') }}"></script>
    <script src="{{ asset('admins/js/data-table.js') }}"></script>
    <script src="{{ asset('admins/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admins/js/dataTables.bootstrap4.js') }}"></script>
    <!-- End custom js for this page-->
    <!-- jquery compress  -->
    <Script src="{{ asset('admins/js/jquary.main.js') }}"></Script>

    @yield('scripts')

    @livewireScripts
    @stack('script')
</body>

</html>

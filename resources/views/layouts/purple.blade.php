<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Sekawan</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('template/dist/assets/images/favicon.png') }}" />

    <!-- Core CSS (vendors) -->
    <link rel="stylesheet" href="{{ asset('build/assets/css/modern.css') }}">
    <link rel="stylesheet" href="{{ asset('template/dist/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/dist/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('template/dist/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/dist/assets/vendors/css/vendor.bundle.base.css') }}">


    <!-- Plugins CSS -->
    <link rel="stylesheet"
        href="{{ asset('template/dist/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">

    <!-- Custom layout styles -->
    <link rel="stylesheet" href="{{ asset('template/dist/assets/css/style.css') }}">

    <!-- External libraries (CDN) -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">

    <!-- Laravel Vite -->
    @vite(['resources/js/app.js'])

</head>

<body>
    <div class="container-scroller">

        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <span>Sekawan</span>
            </div>
            <x-header />
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            {{-- component sidebar --}}
            <x-sidebar />

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        @yield ('content')
                    </div>
                    <x-footer />
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->

        <!-- jQuery first -->
        <script src="{{asset('template/dist')}}/assets/vendors/js/vendor.bundle.base.js"></script>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Plugin js for this page -->
        <script src="{{asset('template/dist')}}/assets/vendors/chart.js/chart.umd.js"></script>
        <script
            src="{{asset('template/dist')}}/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

        <!-- Template custom js -->
        <script src="{{asset('template/dist')}}/assets/js/off-canvas.js"></script>
        <script src="{{asset('template/dist')}}/assets/js/misc.js"></script>
        <script src="{{asset('template/dist')}}/assets/js/settings.js"></script>
        <script src="{{asset('template/dist')}}/assets/js/todolist.js"></script>
        <script src="{{asset('template/dist')}}/assets/js/jquery.cookie.js"></script>
        <script src="{{asset('template/dist')}}/assets/js/dashboard.js"></script>
        <script src="{{ asset('build/assets/js/script.js') }}"></script>

        <!-- DataTables and SweetAlert -->
        <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(document).ready(function () {
                // Inisialisasi DataTable
                let table = new DataTable('#table');

                // SweetAlert sukses
                @if(session('success'))
                    Swal.fire({
                        title: "Berhasil!",
                        text: "{{ session('success') }}",
                        icon: "success",
                        showConfirmButton: false, // hilangkan tombol OK
                        timer: 1500, // durasi muncul (ms), misal 1,5 detik
                        timerProgressBar: true // optional, tampil progress bar
                    });
                @endif
        });
        </script>

</body>

</html>

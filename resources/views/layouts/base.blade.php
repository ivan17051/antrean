<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Vendor styles -->
        <link rel="stylesheet" href="{{ asset('public/vendors/material-design-iconic-font/css/material-design-iconic-font.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/vendors/animate.css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/vendors/jquery-scrollbar/jquery.scrollbar.css') }}">
        <link rel="stylesheet" href="{{ asset('public/vendors/fullcalendar/fullcalendar.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/vendors/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/vendors/draganddrop/draganddrop.css') }}">

        <!-- App styles -->
        <link rel="stylesheet" href="{{ asset('public/css/app.min.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">
        <link rel="stylesheet" href="{{ asset('public/css/custom.css') }}">
    </head>

    <body data-ma-theme="purple">
        <main class="main">
            <div class="page-loader">
                <div class="page-loader__spinner">
                    <svg viewBox="25 25 50 50">
                        <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
                    </svg>
                </div>
            </div>

            @include('layouts.partials.navbar')

            @include('layouts.partials.sidebar')

            @include('layouts.partials.chat')   

            <section class="content">
                 
                @yield('content')

                @include('layouts.partials.footer')
            </section>
        </main>

        <!-- Javascript -->
        <!-- Vendors -->
        <script src="{{ asset('public/vendors/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('public/vendors/popper.js/popper.min.js') }}"></script>
        <script src="{{ asset('public/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('public/vendors/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
        <script src="{{ asset('public/vendors/jquery-scrollLock/jquery-scrollLock.min.js') }}"></script>

        <script src="{{ asset('public/vendors/flot/jquery.flot.js') }}"></script>
        <script src="{{ asset('public/vendors/flot/jquery.flot.resize.js') }}"></script>
        <script src="{{ asset('public/vendors/flot.curvedlines/curvedLines.js') }}"></script>
        <script src="{{ asset('public/vendors/jqvmap/jquery.vmap.min.js') }}"></script>
        <script src="{{ asset('public/vendors/jqvmap/maps/jquery.vmap.world.js') }}"></script>
        <script src="{{ asset('public/vendors/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
        <script src="{{ asset('public/vendors/salvattore/salvattore.min.js') }}"></script>
        <script src="{{ asset('public/vendors/sparkline/jquery.sparkline.min.js') }}"></script>
        <script src="{{ asset('public/vendors/moment/moment.min.js') }}"></script>
        <script src="{{ asset('public/vendors/fullcalendar/fullcalendar.min.js') }}"></script>
        <script src="{{ asset('public/vendors/draganddrop/draganddrop.js') }}"></script>
        <script src="{{ asset('public/vendors/easy.qrcode/easy.qrcode.min.js') }}"></script>

        <!-- Charts and maps-->
        <script src="{{ asset('public/demo/js/flot-charts/curved-line.js') }}"></script>
        <script src="{{ asset('public/demo/js/flot-charts/dynamic.js') }}"></script>
        <script src="{{ asset('public/demo/js/flot-charts/line.js') }}"></script>
        <script src="{{ asset('public/demo/js/flot-charts/chart-tooltips.js') }}"></script>
        <script src="{{ asset('public/demo/js/other-charts.js') }}"></script>
        <script src="{{ asset('public/demo/js/jqvmap.js') }}"></script>

        <!-- App functions and actions -->
        <script src="{{ asset('public/js/app.min.js') }}"></script>
        <script src="{{ asset('public/js/custom.js') }}"></script>
        <script src="{{ asset('public/vendors/select2/js/select2.full.min.js') }}"></script>

        @yield('jsx')
        @stack('script')
    </body>
</html>
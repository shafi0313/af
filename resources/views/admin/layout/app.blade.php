<!doctype html>
<html class="no-js h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    {{-- <title>ADMIN PANEL || {{ $basic_info->website_title }}</title> --}}
    <title>AF Welfare Trust</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('vendor/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    {{-- Font-awesome --}}
    <link href="{{ asset('vendor/fontawesome/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('styles/1.9966074a.chunk.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/main.ac60eb4c.chunk.css') }}">
    <link rel="stylesheet" id="main-stylesheet" data-version="1.1.0"
        href="{{ asset('styles/shards-dashboards.1.1.0.css') }}">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/modal/popModal.css') }}">
    

    <link rel="stylesheet" href="{{ asset('styles/extras.1.1.0.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/util/util.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/animate/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('custom/style.css') }}">
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script data-pace-options='{ "ajax": true }' src="{{ asset('vendor/pace/pace.js') }}"></script>
    <link href="{{ asset('vendor/pace/themes/black/pace-theme-minimal.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('backend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">
</head>

<body class="h-100">
    <div class="container-fluid">
        <div class="row">
            @include('admin.inc.header')
            @yield('content')

        </div>
    </div>
    <div id="ajax_modal_container"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script> --}}
    {{-- <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <!-- jQuery Modal -->
    {{-- <script src="{{ asset('vendor/modal/popModal.js') }}"></script> --}}

    <!-- Latest compiled and minified JavaScript -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script> --}}
    <!-- jQuery Custom Scroller CDN -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js">
    </script>
    {{-- <script src="{{ asset('scripts/extras.1.1.0.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('scripts/shards-dashboards.1.1.0.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('scripts/1.c2333a40.chunk.js') }}"></script> --}}
    {{-- <script src="{{ asset('scripts/main.f1367185.chunk.js') }}"></script>
    <script src="{{ asset('scripts/app/app-blog-overview.1.1.0.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('custom/script.js') }}"></script>
    <script src="{{ asset('backend/js/plugins-init.js') }}"></script>
    @include('sweetalert::alert')
</body>

</html>

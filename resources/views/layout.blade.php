<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'MathX')</title>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('/assets/lib/bootstrap/4.6.0/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/lib/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/global.css') }}">
    @yield('extra-css')
</head>
<body>
    
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}" style="font-weight: bold;"><i class="fas fa-calculator mr-1"></i> MathX</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-link" id="dashboard-menu" href="{{ url('/') }}">Dashboard</a>
                    <a class="nav-link" id="faktorial-menu" href="{{ url('/faktorial') }}">Perhitungan Faktorial</a>
                    <a class="nav-link" id="perpangkatan-menu" href="{{ url('/perpangkatan') }}">Perhitungan Perpangkatan</a>
                </div>
            </div>
        </div>
    </nav>
    {{-- ./Navbar --}}

    {{-- Content --}}
    <div class="px-5 py-4">
        @yield('content')
    </div>
    {{-- ./Content --}}

    {{-- Javascript --}}
    <script src="{{ asset('/assets/lib/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('/assets/lib/popper.js/1.16.1/popper.min.js') }}"></script>
    <script src="{{ asset('/assets/lib/bootstrap/4.6.0/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/assets/lib/fontawesome/js/all.min.js') }}"></script>
    <script src="{{ asset('/assets/lib/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        const BASE_URL = "{{ url('/') }}"
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')
    </script>
    <script src="{{ asset('/assets/js/global.js') }}"></script>

    @if (session('notification_success'))
        <script>
            notification_success('{{ session('notification_success') }}')
        </script>
    @endif

    @if (session('notification_error'))
        <script>
            notification_error('{{ session('notification_error') }}')
        </script>
    @endif

    @php
        Session::forget('notification_success');
        Session::forget('notification_error');
    @endphp

    @yield('extra-js')
</body>
</html>
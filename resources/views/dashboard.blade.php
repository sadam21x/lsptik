@extends('layout')
@section('title', 'Dashboard')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('/assets/css/dashboard.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="container">
            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="font-weight-bold">
                    <i class="fas fa-tachometer-alt mr-1"></i>
                    Dashboard
                </h5>

                <h6>{{ date('D, d M Y') }}</h6>
            </div>
            <hr>
            {{-- ./Header --}}

            {{-- Data Total Perhitungan --}}
            <div class="data_statistik_container d-flex align-items-center">
                <h6 class="font-weight-bold">Total Perhitungan:  <span class="badge badge-primary">{{ $total_perhitungan }}</span></h6>
                <h6 class="font-weight-bold">Faktorial: <span class="badge badge-primary">{{ $total_perhitungan_faktorial }}</span></h6>
                <h6 class="font-weight-bold">Perpangkatan: <span class="badge badge-primary">{{ $total_perhitungan_perpangkatan }}</span></h6>
            </div>
            {{-- Data Total Perhitungan --}}

            <div class="chart_container mt-3">
                <div id="chart_presentase"></div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('extra-js')
    <script src="{{ asset('/assets/lib/apexcharts/apexcharts-3.27.2.min.js') }}"></script>
    <script>
        const TOTAL_PERHITUNGAN_FAKTORIAL = {!! json_encode($total_perhitungan_faktorial) !!}
        const TOTAL_PERHITUNGAN_PERPANGKATAN = {!! json_encode($total_perhitungan_perpangkatan) !!}
    </script>
    <script src="{{ asset('/assets/js/dashboard.js') }}"></script>
@endsection
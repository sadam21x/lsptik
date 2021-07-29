@extends('layout')
@section('title', 'Faktorial')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('/assets/lib/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/faktorial.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="container">
            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="font-weight-bold">
                    Perhitungan Faktorial
                </h5>
            </div>
            <hr>
            {{-- ./Header --}}

            {{-- Calculator --}}
            <div id="calculator_container" class="d-flex flex-row align-items-center">
                <input type="number" id="input_bilangan" class="form-control" placeholder="Bilangan">

                <div class="hasil ml-3 d-flex flex-row align-items-center">
                    <i class="fas fa-arrow-right fa-lg"></i>
                    <h4 class="ml-3">
                        <span id="show_bilangan">x</span>!
                    </h4>
                    <h4 class="mx-2">=</h4>
                    <h4 id="show_hasil">y</h4>
                </div>
            </div>

            <div class="d-flex flex-row align-items-center mt-3">
                <button type="button" onclick="hitung_faktorial()" class="btn btn-primary">
                    Hitung
                </button>

                <button type="button" onclick="histori_perhitungan()" class="btn btn-dark ml-2">
                    <i class="fas fa-history ml1"></i>
                    Histori
                </button>
            </div>
            {{-- ./Calculator --}}
        </div>
    </div>
</div>

{{-- Modal Histori Perhitungan --}}
<div class="modal fade" id="histori-perhitungan-modal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Histori Perhitungan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <table id="histori-perhitungan-table" class="table table-bordered table-sm datatables-table">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Input</th>
                            <th>Output</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
{{-- ./Modal Histori Perhitungan --}}
@endsection

@section('extra-js')
    <script src="{{ asset('/assets/lib/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('/assets/js/faktorial.js') }}"></script>
@endsection
@extends('admin.layouts.app')

@section('title')
    Transaksi Penjualan
@endsection

@push('after-style')
    <!-- Custom styles for this page -->
    <link href="{{ asset('SBAdmin2/assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('after-script')
    <!-- Page level plugins -->
    <script src="{{ asset('SBAdmin2/assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('SBAdmin2/assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('SBAdmin2/assets/js/demo/datatables-demo.js') }}"></script>
@endpush

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Transaksi Penjualan</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-2 font-weight-bold text-primary">Data Transaksi Penjualan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Transaksi</th>
                            <th>Counter</th>
                            <th>Tanggal Penjualan</th>
                            <th>Grand Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    {{-- <tfoot>
                        <tr>
                            <th>No</th>
                            <th>ID Transaksi</th>
                            <th>Counter</th>
                            <th>Tanggal Penjualan</th>
                            <th>Grand Total</th>
                            <th>Action</th>
                        </tr>
                    </tfoot> --}}
                    <tbody>
                        @foreach ($transaksi_penjualans as $no => $transaksi_penjualan)
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>{{ $transaksi_penjualan->transaksi_penjualan_id }}</td>
                                <td>{{ $transaksi_penjualan->name }}</td>
                                <td>
                                    @php
                                        $date = date_create($transaksi_penjualan->tanggal_penjualan);
                                        $tanggal = date_format($date, 'd F Y');
                                        echo $tanggal;
                                    @endphp
                                </td>
                                <td>{{ $transaksi_penjualan->grand_total_penjualan }}</td>
                                <td>
                                    <a href="{{ url('/transaksi/detail/' . $transaksi_penjualan->slug) }}"
                                        class="btn btn-info">
                                        <i class="fas fa-info-circle"></i>&nbsp;<span>Detail</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

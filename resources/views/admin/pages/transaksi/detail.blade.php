@extends('admin.layouts.app')

@section('title')
    Detail Transaksi Penjualan
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
    <script>
        $('#dataTable').dataTable({
            "ordering": false
        });
    </script>
@endpush

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Transaksi Penjualan</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-2 font-weight-bold text-primary">ID Transaksi Penjualan : {{ $transaksi_penjualan_id }}</h6>
            <div class="row">
                <a class="btn btn-secondary mr-2" href="{{ route('index.transaksi') }}"><i
                        class="fas fa-arrow-circle-left"></i>&nbsp;<span>Kembali</span></a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Harga Barang</th>
                            <th>Jumlah Penjualan</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    {{-- <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Harga Barang</th>
                            <th>Jumlah Penjualan</th>
                            <th>Subtotal</th>
                        </tr>
                    </tfoot> --}}
                    <tbody>
                        @php
                            $number = 1;
                        @endphp
                        @foreach ($details as $no => $detail)
                            <tr>
                                <td>{{ $number++ }}&nbsp;</td>
                                <td>{{ $detail->nama_barang }}</td>
                                <td>{{ $detail->harga_barang }}</td>
                                <td>{{ $detail->qty_penjualan }}</td>
                                <td>{{ $detail->subtotal_penjualan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

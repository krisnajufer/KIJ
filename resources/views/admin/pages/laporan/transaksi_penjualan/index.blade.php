@extends('admin.layouts.app')

@section('title')
    Laporan Transaksi Penjualan
@endsection

@push('after-style')
    <!-- Custom styles for this page -->
    <link href="{{ asset('SBAdmin2/assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css"
        rel="stylesheet" />
@endpush

@push('after-script')
    <!-- Page level plugins -->
    <script src="{{ asset('SBAdmin2/assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('SBAdmin2/assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('SBAdmin2/assets/js/demo/datatables-demo.js') }}"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <script>
        $("#datepicker").datepicker({
            format: " yyyy", // Notice the Extra space at the beginning
            viewMode: "years",
            minViewMode: "years"
        });
    </script>
@endpush

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Laporan Transaksi Penjualan</h1>
    </div>

    @if (session()->has('success'))
        <div class="row">
            <div class="col-md-12">

                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
            </div>
        </div>
    @endif

    @if (session()->has('info'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info alert-dismissible fade show text-center" role="alert">
                    <strong>{{ session('info') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
            </div>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-2 font-weight-bold text-primary">Laporan Transaksi Penjualan</h6>
            @if ($counts > 0)
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#saveModal"><i
                        class="fas fa-file-export"></i><span>&nbsp;Export PDF</span></a>
            @endif
        </div>
        <form action="{{ route('laporan.penjualan.export') }}" method="post">
            @csrf
            @if ($counts > 0)
                <input type="hidden" name="tahun_periode" value="{{ $periode }}">
            @endif
            <!-- Save Modal-->
            <div class="modal fade" id="saveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Siap untuk diexport sebagai PDF ?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Pastikan data sudah benar, jika sudah benar klik benar dan
                            jika belum klik tidak</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-primary">Benar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="card-body">
            <form action="{{ route('get.periode') }}" method="post">
                <div class="row justify-content-start">
                    @csrf
                    <div class="col-2">
                        <div class="form-group">
                            <label for="yearpicker">Periode</label>
                            <input type="text" name="periode" id="datepicker" class="form-control">
                        </div>
                    </div>
                    <div class="col" style="margin-top: 32px;">
                        <input type="submit" name="proses" value="Proses" class="btn btn-success">
                    </div>
            </form>
        </div>
        <div class="table-responsive">
            @if ($counts > 0)
                <h5 class="mt-3 mb-3">Laporan Transaksi Tahun
                    <span class="text-primary">
                        {{ $periode }}
                    </span>
                </h5>
            @endif
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Transaksi</th>
                        <th>Counter</th>
                        <th>Tanggal Penjualan</th>
                        <th>Grand Total Penjualan</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>ID Transaksi</th>
                        <th>Counter</th>
                        <th>Tanggal Penjualan</th>
                        <th>Grand Total Penjualan</th>
                    </tr>
                </tfoot>
                <tbody>
                    @if ($counts > 0)
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
                                <td>
                                    {{ $transaksi_penjualan->grand_total_penjualan }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection

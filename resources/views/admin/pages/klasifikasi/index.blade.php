@extends('admin.layouts.app')

@section('title')
    Klasifikasi
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
        <h1 class="h3 mb-0 text-gray-800">Klasifikasi</h1>
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

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-2 font-weight-bold text-primary">Data Klasifikasi</h6>
            <a href="{{ route('create.klasifikasi') }}" class="btn btn-primary"><i
                    class="fas fa-plus-circle"></i><span>&nbsp;Tambah</span></a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Klasifikasi</th>
                            <th>Bulan Mulai Klasifikasi</th>
                            <th>Bulan Akhir Klasifikasi</th>
                            <th>Total Pendapatan Pertahun</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    {{-- <tfoot>
                        <tr>
                            <th>No</th>
                            <th>ID Klasifikasi</th>
                            <th>Tanggal Mulai Klasifikasi</th>
                            <th>Tanggal Akhir Klasifikasi</th>
                            <th>Total Biaya Pertahun</th>
                            <th>Action</th>
                        </tr>
                    </tfoot> --}}
                    <tbody>
                        @foreach ($klasifikasis as $no => $klasifikasi)
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>{{ $klasifikasi->klasifikasi_id }}</td>
                                <td>
                                    @php
                                        $date_start = date_create($klasifikasi->tgl_mulai_klasifikasi);
                                        $tanggal_awal = date_format($date_start, 'F Y');
                                        echo $tanggal_awal;
                                    @endphp
                                </td>
                                <td>
                                    @php
                                        $date_end = date_create($klasifikasi->tgl_akhir_klasifikasi);
                                        $tanggal_akhir = date_format($date_end, 'F Y');
                                        echo $tanggal_akhir;
                                    @endphp
                                </td>
                                <td>{{ $klasifikasi->total_biaya_pertahun }}</td>
                                <td>
                                    <a href="{{ url('/klasifikasi/detail/' . $klasifikasi->slug) }}"
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

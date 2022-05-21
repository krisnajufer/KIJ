@extends('admin.layouts.app')

@section('title')
    Detail Klasifikasi
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
        <h1 class="h3 mb-0 text-gray-800">Detail Klasifikasi</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-2 font-weight-bold text-primary">ID Klasifikasi : {{ $klasifikasi_id }}</h6>
            <div class="row">
                <a class="btn btn-secondary mr-2" href="{{ route('klasifikasi') }}"><i
                        class="fas fa-arrow-circle-left"></i>&nbsp;<span>Kembali</span></a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Klasifikasi</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Terjual Pertahun</th>
                            <th>(Penjualan Pertahun
                                × cost/unit)/Total
                                (%)</th>
                            <th>Persentase Kumulatif</th>
                            <th>Klasifikasi</th>
                        </tr>
                    </thead>
                    {{-- <tfoot>
                        <tr>
                            <th>No</th>
                            <th>ID Klasifikasi</th>
                            <th>Nama Barang</th>
                            <th>Permintaan Tahunan</th>
                            <th>Persentase Biaya</th>
                            <th>Klasifikasi</th>
                        </tr>
                    </tfoot> --}}
                    <tbody>
                        @php
                            $hasil = 0;
                            $total = 0;
                            foreach ($details as $detail) {
                                $total += $detail->costxpertahun;
                            }
                        @endphp
                        @foreach ($details as $no => $detail)
                            <tr>
                                <td>{{ $no + 1 }}&nbsp;</td>
                                <td>{{ $detail->klasifikasi_id }}</td>
                                <td>{{ $detail->nama_barang }}</td>
                                <td>{{ $detail->permintaan_tahunan }}</td>
                                <td>{{ $detail->persentase_biaya }}%</td>
                                <td>
                                    @php
                                        $decimal = round(($detail->costxpertahun / $total) * 100, 2);
                                        $hasil += $decimal;
                                        echo $hasil . ' %';
                                    @endphp
                                </td>
                                <td>{{ $detail->klasifikasi }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

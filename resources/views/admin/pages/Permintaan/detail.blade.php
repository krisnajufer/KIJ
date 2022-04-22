@extends('admin.layouts.app')

@section('title')
    Detail Permintaan
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
        <h1 class="h3 mb-0 text-gray-800">Detail Permintaan</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-2 font-weight-bold text-primary">ID Permintaan : {{ $permintaan_id }} </h6>
            <div class="row">
                <a class="btn btn-secondary mr-2" href="{{ route('permintaan') }}"><i
                        class="fas fa-arrow-circle-left"></i>&nbsp;<span>Kembali</span></a>
                @if (Auth::guard('admin')->user()->role == 'gudang')
                    @if ($count_tmp == $count_persetujuans)
                        <a class="btn btn-primary" href="{{ url('/permintaan/store/pengiriman/' . $permintaan_id) }}"><i
                                class="fas fa-save"></i>&nbsp;<span>Simpan</span></a>
                    @endif
                @endif
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Permintaan</th>
                            @if (Auth::guard('admin')->user()->role == 'gudang')
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    {{-- <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Permintaan</th>
                            @if (Auth::guard('admin')->user()->role == 'gudang')
                                <th>Action</th>
                            @endif
                        </tr>
                    </tfoot> --}}
                    <tbody>
                        @foreach ($details as $no => $detail)
                            <tr>
                                <td>{{ $no + 1 }}&nbsp;</td>
                                <td>{{ $detail->nama_barang }}</td>
                                <td>{{ $detail->jumlah_permintaan }}</td>
                                @if (Auth::guard('admin')->user()->role == 'gudang')
                                    <td>
                                        @if (!empty($temporary_persetujuans))
                                            @if (array_key_exists($permintaan_id . $detail->barang_id, $temporary_persetujuans) or $detail->status == 'Dikirim')
                                                <h5>
                                                    <span class="badge badge-success">Selesai</span>
                                                </h5>
                                            @else
                                                <a href="{{ url('/permintaan/create/persetujuan/' . $slug . '/' . $detail->barang_id) }}"
                                                    class="btn btn-success"><i
                                                        class="fas fa-check-circle"></i>&nbsp;<span>Persetujuan</span></a>
                                            @endif
                                        @elseif ($detail->status == 'Dikirim' or $detail->status == 'Diterima' or $detail->status == 'Ditolak')
                                            <h5>
                                                <span class="badge badge-success">Selesai</span>
                                            </h5>
                                        @else
                                            <a href="{{ url('/permintaan/create/persetujuan/' . $slug . '/' . $detail->barang_id) }}"
                                                class="btn btn-success"><i
                                                    class="fas fa-check-circle"></i>&nbsp;<span>Persetujuan</span></a>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

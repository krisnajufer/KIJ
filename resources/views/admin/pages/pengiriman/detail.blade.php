@extends('admin.layouts.app')

@section('title')
    Detail Pengiriman
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
        <h1 class="h3 mb-0 text-gray-800">Detail Pengiriman</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between"">
                                <h6 class="     m-2 font-weight-bold text-primary">ID Pengiriman : {{ $pengiriman_id }}
            </h6>
            <a class="btn btn-secondary" href="{{ route('pengiriman') }}"><i
                    class="fas fa-arrow-circle-left"></i>&nbsp;<span>Kembali</span></a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Pengiriman</th>
                            <th>Persetujuan</th>
                            <th>Sumber</th>
                            <th>Dikirim dari</th>
                            <th>Alasan</th>
                        </tr>
                    </thead>
                    {{-- <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Pengiriman</th>
                            <th>Persetujuan</th>
                            <th>Sumber</th>
                            <th>Dikirim dari</th>
                        </tr>
                    </tfoot> --}}
                    <tbody>
                        @foreach ($details as $no => $detail)
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>{{ $detail->nama_barang }}</td>
                                <td>{{ $detail->jumlah_pengiriman }}</td>
                                <td>{{ $detail->persetujuan }}</td>
                                <td>
                                    @if ($detail->persetujuan == 'Setuju')
                                        {{ $detail->sumber }}
                                    @elseif ($detail->persetujuan == 'Tidak')
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if ($detail->persetujuan == 'Setuju')
                                        @if ($detail->sumber == 'gudang')
                                            Gudang
                                        @elseif ($detail->sumber == 'counter')
                                            {{ $detail->name }}
                                        @endif
                                    @elseif ($detail->persetujuan == 'Tidak')
                                        -
                                    @endif
                                </td>
                                <td>
                                    {{ $detail->alasan }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

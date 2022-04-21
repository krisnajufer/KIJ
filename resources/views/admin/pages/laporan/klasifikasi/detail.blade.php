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
                <a class="btn btn-secondary mr-2" href="{{ route('laporan.klasifikasi') }}"><i
                        class="fas fa-arrow-circle-left"></i>&nbsp;<span>Kembali</span></a>
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#saveModal"><i
                        class="fas fa-file-export"></i><span>&nbsp;Export PDF</span></a>
            </div>
        </div>
        <form action="{{ route('laporan.klasifikasi.export') }}" method="post">
            @csrf
            <input type="hidden" name="slug" value="{{ $slug }}">
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
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Klasifikasi</th>
                            <th>Nama Barang</th>
                            <th>Permintaan Tahunan</th>
                            <th>Persentase Biaya</th>
                            <th>Klasifikasi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>ID Klasifikasi</th>
                            <th>Nama Barang</th>
                            <th>Permintaan Tahunan</th>
                            <th>Persentase Biaya</th>
                            <th>Klasifikasi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($details as $no => $detail)
                            <tr>
                                <td>{{ $no + 1 }}&nbsp;</td>
                                <td>{{ $detail->klasifikasi_id }}</td>
                                <td>{{ $detail->nama_barang }}</td>
                                <td>{{ $detail->permintaan_tahunan }}</td>
                                <td>{{ $detail->persentase_biaya }}%</td>
                                <td>{{ $detail->klasifikasi }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@extends('admin.layouts.app')

@section('title')
    Penerimaan
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
        <h1 class="h3 mb-0 text-gray-800">Penerimaan</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-2 font-weight-bold text-primary">Data Penerimaan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Penerimaan</th>
                            <th>ID Pengiriman</th>
                            <th>Nama Counter</th>
                            <th>Tanggal Penerimaan</th>
                        </tr>
                    </thead>
                    {{-- <tfoot>
                        <tr>
                            <th>No</th>
                            <th>ID Penerimaan</th>
                            <th>ID Pengiriman</th>
                            <th>Nama Counter</th>
                            <th>Tanggal Penerimaan</th>
                        </tr>
                    </tfoot> --}}
                    <tbody>
                        @foreach ($penerimaans as $no => $penerimaan)
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>{{ $penerimaan->penerimaan_id }}</td>
                                <td>{{ $penerimaan->pengiriman_id }}</td>
                                <td>{{ $penerimaan->name }}</td>
                                <td>
                                    @php
                                        $date = date_create($penerimaan->tanggal_penerimaan);
                                        $tanggal = date_format($date, 'd F Y');
                                        echo $tanggal;
                                    @endphp
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

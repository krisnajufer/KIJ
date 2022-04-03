@extends('admin.layouts.app')

@section('title')
    Pengiriman
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
        <h1 class="h3 mb-0 text-gray-800">Pengiriman</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-2 font-weight-bold text-primary">Data Pengiriman</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Pengiriman</th>
                            <th>ID Permintaan</th>
                            <th>Nama Counter</th>
                            <th>Status</th>
                            <th>Tanggal Pengiriman</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>ID Pengiriman</th>
                            <th>ID Permintaan</th>
                            <th>Nama Counter</th>
                            <th>Status</th>
                            <th>Tanggal Pengiriman</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($pengirimans as $no => $pengiriman)
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>{{ $pengiriman->pengiriman_id }}</td>
                                <td>{{ $pengiriman->permintaan_id }}</td>
                                <td>{{ $pengiriman->name }}</td>
                                <td>
                                    <h5>
                                        @if ($pengiriman->status == 'Dikirim')
                                            <span class="badge badge-success">{{ $pengiriman->status }}</span>
                                        @elseif ($pengiriman->status == 'Diterima')
                                            <span class="badge badge-primary">{{ $pengiriman->status }}</span>
                                        @endif
                                    </h5>
                                </td>
                                <td>
                                    @php
                                        $date = date_create($pengiriman->tanggal_pengiriman);
                                        $tanggal = date_format($date, 'd F Y');
                                        echo $tanggal;
                                    @endphp
                                </td>
                                <td>
                                    <a href="{{ url('/pengiriman/show/' . $pengiriman->slug) }}" class="btn btn-info">
                                        <i class="fas fa-info-circle"></i>&nbsp;<span>Detail</span>
                                    </a>
                                    @if (Auth::guard('admin')->user()->role == 'counter')
                                        @if ($pengiriman->status == 'Dikirim')
                                            <a href="{{ url('/penerimaan/store/' . $pengiriman->slug) }}"
                                                class="btn btn-success">
                                                <i class="fas fa-hand-paper"></i>&nbsp;<span>Diterima</span>
                                            </a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

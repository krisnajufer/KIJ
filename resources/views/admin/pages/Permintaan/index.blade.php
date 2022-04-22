@extends('admin.layouts.app')

@section('title')
    Permintaan
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
        <h1 class="h3 mb-0 text-gray-800">Permintaan</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row justify-content-between m-0">
                <h6 class="m-2 font-weight-bold text-primary">Data Permintaan</h6>
                @if (Auth::guard('admin')->user()->role == 'counter')
                    <a href="{{ route('create.permintaan') }}" class="btn btn-primary"><i
                            class="fas fa-plus-circle"></i><span>&nbsp;Tambah</span></a>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Permintaan</th>
                            <th>Counter</th>
                            <th>Tanggal Permintaan</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    {{-- <tfoot>
                        <tr>
                            <th>No</th>
                            <th>ID Permintaan</th>
                            <th>Counter</th>
                            <th>Tanggal Permintaan</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot> --}}
                    <tbody>
                        @foreach ($permintaans as $no => $permintaan)
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>{{ $permintaan->permintaan_id }}</td>
                                <td>{{ $permintaan->name }}</td>
                                <td>
                                    @php
                                        $tanggal = date_create($permintaan->tanggal_permintaan);
                                        echo date_format($tanggal, 'd F Y');
                                    @endphp
                                </td>
                                <td>
                                    <h5>
                                        @if ($permintaan->status == 'Pending')
                                            <span class="badge badge-secondary">{{ $permintaan->status }}</span>
                                        @elseif ($permintaan->status == 'Proses')
                                            <span class="badge badge-warning">{{ $permintaan->status }}</span>
                                        @elseif ($permintaan->status == 'Dikirim')
                                            <span class="badge badge-success">{{ $permintaan->status }}</span>
                                        @elseif ($permintaan->status == 'Diterima')
                                            <span class="badge badge-primary">{{ $permintaan->status }}</span>
                                        @elseif ($permintaan->status == 'Ditolak')
                                            <span class="badge badge-danger">{{ $permintaan->status }}</span>
                                        @endif
                                    </h5>
                                </td>
                                <td>
                                    @if (Auth::guard('admin')->user()->role == 'counter')
                                        <a href="{{ url('/permintaan/show/' . $permintaan->slug) }}"
                                            class="btn btn-info"><i
                                                class="fas fa-info-circle"></i>&nbsp;<span>Detail</span></a>
                                    @elseif (Auth::guard('admin')->user()->role == 'gudang')
                                        @if ($permintaan->status == 'Pending')
                                            <a href="{{ url('/permintaan/show/' . $permintaan->slug) }}"
                                                class="btn btn-info"><i
                                                    class="fas fa-tasks"></i>&nbsp;<span>Proses</span></a>
                                        @elseif ($permintaan->status == 'Proses')
                                            <a href="{{ url('/permintaan/show/' . $permintaan->slug) }}"
                                                class="btn btn-info"><i
                                                    class="fas fa-tasks"></i>&nbsp;<span>Persetujuan</span></a>
                                        @elseif ($permintaan->status == 'Dikirim' or $permintaan->status == 'Ditolak' or $permintaan->status == 'Diterima')
                                            <a href="{{ url('/permintaan/show/' . $permintaan->slug) }}"
                                                class="btn btn-info"><i
                                                    class="fas fa-tasks"></i>&nbsp;<span>Details</span></a>
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

@extends('admin.layouts.app')

@section('title')
    Gudang
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
        <h1 class="h3 mb-0 text-gray-800">Gudang</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-2 font-weight-bold text-primary">Data Gudang</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Gudang</th>
                            <th>Nama Gudang</th>
                            <th>Alamat</th>
                            <th>Username</th>
                            @if (Auth::guard('admin')->user()->role == 'gudang')
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    {{-- <tfoot>
                        <tr>
                            <th>No</th>
                            <th>ID Gudang</th>
                            <th>Nama Gudang</th>
                            <th>Alamat</th>
                            <th>Username</th>
                            @if (Auth::guard('admin')->user()->role == 'gudang')
                                <th>Action</th>
                            @endif
                        </tr>
                    </tfoot> --}}
                    <tbody>
                        @foreach ($gudangs as $no => $gudang)
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>{{ $gudang->gudang_id }}</td>
                                <td>{{ $gudang->name }}</td>
                                <td>{{ $gudang->alamat_gudang }}</td>
                                <td>{{ $gudang->username }}</td>
                                @if (Auth::guard('admin')->user()->role == 'gudang')
                                    <td><a href="{{ url('/gudang/edit/' . $gudang->slug) }}" class="btn btn-info"><i
                                                class="fas fa-edit"></i><Span>&nbsp;Edit</Span></a>
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

@extends('admin.layouts.app')

@section('title')
    Barang
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
        <h1 class="h3 mb-0 text-gray-800">Barang</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row justify-content-between m-0">
                <h6 class="m-2 font-weight-bold text-primary">Data Barang</h6>
                @if (Auth::guard('admin')->user()->role == 'gudang')
                    <a href="" class="btn btn-primary"><i class="fas fa-plus-circle"></i><span>&nbsp;Tambah</span></a>
                @endif
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Barang</th>
                            <th>Nama Barang</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            @if (Auth::guard('admin')->user()->role == 'gudang')
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            @if (Auth::guard('admin')->user()->role == 'gudang')
                                <th>Salary</th>
                            @endif
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            @if (Auth::guard('admin')->user()->role == 'gudang')
                                <td>
                                    <a href="#" class="btn btn-info"><i
                                            class="fas fa-edit"></i><Span>&nbsp;Edit</Span></a>
                                    <a href="#" class="btn btn-danger"><i
                                            class="fas fa-trash"></i></i><Span>&nbsp;Delete</Span></a>

                                </td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

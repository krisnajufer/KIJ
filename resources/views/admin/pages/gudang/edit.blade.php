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

    <div class="row">
        <div class="col-md-12">
            @if (session()->has('warning'))
                <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    <strong>{{ session('warning') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-2 font-weight-bold text-primary">Edit Data Gudang</h6>
                </div>
                <div class="card-body ml-5">
                    <form action="{{ url('/gudang/update/' . $gudangs->slug) }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <label for="id_gudang" style="color: black; font-weight: 500px;">ID Gudang</label>
                                <input type="text" class="form-control form-control-user"
                                    style="color: black; font-weight: 500px;" id="id_gudang" name="id_gudang"
                                    value="{{ $gudangs->gudang_id }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <label for="nama_gudang" style="color: black; font-weight: 500px;">Nama Gudang</label>
                                <input type="text" class="form-control form-control-user"
                                    style="color: black; font-weight: 500px;" id="nama_gudang" name="nama_gudang"
                                    value="{{ $users->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <label for="alamat_gudang" style="color: black; font-weight: 500px;">Alamat Gudang</label>
                                <input type="text" class="form-control form-control-user" id="alamat_gudang"
                                    style="color: black; font-weight: 500px;" name="alamat_gudang"
                                    value="{{ $gudangs->alamat_gudang }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <label for="username_gudang" style="color: black; font-weight: 500px;">Username
                                    Gudang</label>
                                <input type="text" class="form-control form-control-user" id="username_gudang"
                                    style="color: black; font-weight: 500px;" name="username_gudang"
                                    value="{{ $users->username }}">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center m-0">
                            <div class="col-sm-6 text-right">
                                <a href="{{ route('gudang') }}" class="btn btn-secondary"><i
                                        class="fas fa-window-close"></i><span>&nbsp;Batal</span></a>
                            </div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary"><i
                                        class="fas fa-save"></i><span>&nbsp;Simpan</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

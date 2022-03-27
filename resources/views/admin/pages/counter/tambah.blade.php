@extends('admin.layouts.app')

@section('title')
    Counter
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
        <h1 class="h3 mb-0 text-gray-800">Counter</h1>
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
                    <h6 class="m-2 font-weight-bold text-primary">Tambah Data Counter</h6>
                </div>
                <div class="card-body ml-5">
                    <form action="{{ route('store.counter') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <label for="id_counter" style="color: black; font-weight: 500px;">ID Counter</label>
                                <input type="text" class="form-control form-control-user"
                                    style="color: black; font-weight: 500px;" id="id_counter" name="id_counter"
                                    value="{{ $kode }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <label for="nama_counter" style="color: black; font-weight: 500px;">Nama Counter</label>
                                <input type="text" class="form-control form-control-user"
                                    style="color: black; font-weight: 500px;" id="nama_counter" name="nama_counter"
                                    placeholder="Nama Counter">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <label for="alamat_counter" style="color: black; font-weight: 500px;">Alamat Counter</label>
                                <input type="text" class="form-control form-control-user" id="alamat_counter"
                                    style="color: black; font-weight: 500px;" name="alamat_counter"
                                    placeholder="Alamat Counter">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <label for="username_counter" style="color: black; font-weight: 500px;">Username
                                    Counter</label>
                                <input type="text" class="form-control form-control-user" id="username_counter"
                                    style="color: black; font-weight: 500px;" name="username_counter"
                                    placeholder="Username Counter">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center m-0">
                            <div class="col-sm-6 text-right">
                                <a href="{{ route('counter') }}" class="btn btn-secondary"><i
                                        class="fas fa-window-close"></i><span>&nbsp;Batal</span></a>
                            </div>
                            <div class="col-sm-6">
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#saveModal"><i
                                        class="fas fa-save"></i><span>&nbsp;Simpan</span></a>
                            </div>
                        </div>
                        <!-- Save Modal-->
                        <div class="modal fade" id="saveModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Siap untuk disimpan ?</h5>
                                        <button class="close" type="button" data-dismiss="modal"
                                            aria-label="Close">
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
                </div>
            </div>
        </div>
    </div>
@endsection

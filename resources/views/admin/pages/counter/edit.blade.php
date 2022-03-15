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
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-2 font-weight-bold text-primary">Edit Data Counter</h6>
                </div>
                <div class="card-body ml-5">
                    <form action="" method="post">
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <label for="id_counter" style="color: black; font-weight: 500px;">ID Counter</label>
                                <input type="text" class="form-control form-control-user"
                                    style="color: black; font-weight: 500px;" id="id_counter" name="id_counter"
                                    placeholder="" readonly>
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
                                <a href="" class="btn btn-secondary"><i
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

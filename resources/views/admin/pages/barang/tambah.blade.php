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

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-2 font-weight-bold text-primary">Tambah Data Barang</h6>
                </div>
                <div class="card-body ml-5">
                    <form action="" method="post">
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <label for="id_barang" style="color: black; font-weight: 500px;">ID Barang</label>
                                <input type="text" class="form-control form-control-user"
                                    style="color: black; font-weight: 500px;" id="id_barang" name="id_barang" placeholder=""
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <label for="nama_barang" style="color: black; font-weight: 500px;">Nama Barang</label>
                                <input type="text" class="form-control form-control-user"
                                    style="color: black; font-weight: 500px;" id="nama_barang" name="nama_barang"
                                    placeholder="Nama Barang">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <label for="harga_barang" style="color: black; font-weight: 500px;">Harga Barang</label>
                                <input type="text" class="form-control form-control-user" id="harga_barang"
                                    style="color: black; font-weight: 500px;" name="harga_barang"
                                    placeholder="Harga Barang">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <label for="stok_barang" style="color: black; font-weight: 500px;">Stok Barang</label>
                                <input type="text" class="form-control form-control-user" id="stok_barang"
                                    style="color: black; font-weight: 500px;" name="stok_barang" placeholder="Stok Barang">
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

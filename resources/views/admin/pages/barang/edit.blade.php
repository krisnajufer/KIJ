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

    <script>
        function InputNumbers(evt) {

            var key = String.fromCharCode(evt.which);

            if (!(/[0-9]/.test(key))) {
                evt.preventDefault();
            }
        };
    </script>
@endpush

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Barang</h1>
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
                    <h6 class="m-2 font-weight-bold text-primary">Edit Data Barang</h6>
                </div>
                <div class="card-body ml-5">
                    <form action="{{ url('/barang/update/' . $barangs->slug) }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <label for="id_barang" style="color: black; font-weight: 500px;">ID Barang</label>
                                <input type="text" class="form-control form-control-user"
                                    style="color: black; font-weight: 500px;" id="id_barang" name="id_barang"
                                    value="{{ $barangs->barang_id }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <label for="nama_barang" style="color: black; font-weight: 500px;">Nama Barang</label>
                                <input type="text" class="form-control form-control-user"
                                    style="color: black; font-weight: 500px;" id="nama_barang" name="nama_barang"
                                    value="{{ $barangs->nama_barang }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <label for="harga_barang" style="color: black; font-weight: 500px;">Harga Barang</label>
                                <input type="text" class="form-control form-control-user" id="harga_barang"
                                    style="color: black; font-weight: 500px;" name="harga_barang"
                                    value="{{ $barangs->harga_barang }}" onkeypress="InputNumbers(event)">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <label for="stok_barang" style="color: black; font-weight: 500px;">Stok Barang</label>
                                <input type="text" class="form-control form-control-user" id="stok_barang"
                                    style="color: black; font-weight: 500px;" name="stok_barang"
                                    value="{{ $barangs->stok_barang }}" onkeypress="InputNumbers(event)">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center m-0">
                            <div class="col-sm-6 text-right">
                                <a href="{{ route('barang') }}" class="btn btn-secondary"><i
                                        class="fas fa-window-close"></i><span>&nbsp;Batal</span></a>
                            </div>
                            <div class="col-sm-6">
                                {{-- <button type="submit" class="btn btn-primary"><i
                                        class="fas fa-save"></i><span>&nbsp;Simpan</span></button> --}}
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editModal"><i
                                        class="fas fa-save"></i></i><span>&nbsp;Simpan</span></a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Logout Modal-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin menyimpan perubahan?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Iya" jika ingin menyimpan perubahan atau pilih "Tidak" untuk tidak
                    menyimpan perubahan.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-primary">Iya</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

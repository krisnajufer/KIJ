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
    <script>
        function InputNumbers(evt) {

            var key = String.fromCharCode(evt.which);

            if (!(/[0-9]/.test(key))) {
                evt.preventDefault();
            }
        };

        $(document).on('click', '#delete', function() {
            let kode_session = $(this).attr('data-id');
            $('#kode_session').val(kode_session);
        });
    </script>
@endpush

@php
$no = 0;
@endphp

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Permintaan</h1>
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
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-2 font-weight-bold text-primary">Tambah Data Permintaan</h6>
                </div>
                <div class="card-body ml-5">
                    <form action="{{ route('temporary.permintaan') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <label for="id_barang" style="color: black; font-weight: 500px;">ID Permintaan</label>
                                <input type="text" class="form-control form-control-user"
                                    style="color: black; font-weight: 500px;" id="id_permintaan" name="id_permintaan"
                                    placeholder="" value="{{ $kode }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <label for="nama_barang" style="color: black; font-weight: 500px;">Nama Barang</label>
                                <select name="id_barang" class="form-control form-control-user" id="id_barang">
                                    <option value="pilih">Pilih Nama Barang</option>
                                    @foreach ($barangs as $barang)
                                        <option value="{{ $barang->barang_id }}">{{ $barang->nama_barang }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <label for="jumlah_permintaan" style="color: black; font-weight: 500px;">Jumlah
                                    Permintaan</label>
                                <input type="text" class="form-control form-control-user" id="jumlah_permintaan"
                                    style="color: black; font-weight: 500px;" name="jumlah_permintaan"
                                    onkeypress="InputNumbers(event)" placeholder="Contoh : 50" required>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center m-0">
                            <div class="col-sm-3">
                                <a href="{{ route('cancel.create.permintaan') }}" class="btn btn-secondary"><i
                                        class="fas fa-window-close"></i><span>&nbsp;Batal</span></a>
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addModal"><i
                                        class="fas fa-plus-circle"></i><span>&nbsp;Tambah</span></a>
                            </div>
                        </div>
                </div>

                <!-- Add Modal-->
                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Apakah siap untuk ditambahkan ?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Pastikan data sudah benar, jika sudah benar pilih "Benar" dan
                                jika belum pilih "Tidak"</div>
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-2 font-weight-bold text-primary">List Data Permintaan</h6>
                    @if (!empty($temporary_permintaans))
                        <a href="" class="btn btn-primary" data-toggle='modal' data-target='#saveModal'><i
                                class="fas fa-save"></i>&nbsp;<span>Simpan</span></a>
                    @endif
                </div>
                <div class="card-body ml-5">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Permintaan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            {{-- <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>ID Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Permintaan</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot> --}}
                            <tbody>
                                @if (!empty($temporary_permintaans))
                                    @foreach ($temporary_permintaans as $kode_session => $temporary_permintaan)
                                        @php
                                            $no++;
                                        @endphp
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $temporary_permintaan['id_barang'] }}</td>
                                            <td title="{{ $temporary_permintaan['nama_barang'] }}">
                                                {{ $temporary_permintaan['nama_barang'] }}</td>
                                            <td>{{ $temporary_permintaan['jumlah_permintaan'] }}</td>
                                            <td> <a href="#" id="delete" class="btn btn-danger" title="Delete"
                                                    data-toggle='modal' data-target='#deleteModal'
                                                    data-id="{{ $kode_session }}"><i class="fas fa-trash"></i></a></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Delete Modal-->
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Anda yakin untuk hapus data ?
                                </h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Pilih iya jika ingin dihapus atau pilih tidak bila tidak ingin
                                dihapus.</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                                <form action="{{ route('destroy.temporary.permintaan') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="kode_session" id="kode_session">
                                    <button type="submit" class="btn btn-primary">Iya</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="saveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Siap untuk disimpan ?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Pastikan data sudah benar, jika sudah benar klik benar dan
                                jika belum klik tidak</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                                <a href="{{ url('/permintaan/store/' . $kode) }}" class="btn btn-primary">Benar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

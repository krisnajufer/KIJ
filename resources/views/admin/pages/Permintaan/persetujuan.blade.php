@extends('admin.layouts.app')

@section('title')
    Persetujuan
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

        function getPersetujuan() {
            var persetujuan = $('#persetujuan').val();
            if (persetujuan == 'Setuju') {
                $('#sumber').removeAttr('disabled');

            } else {
                $('#sumber').attr('disabled', 'disabled')
                $('#id_sumber').attr('disabled', 'disabled')
            }
        }

        function getGudangorCounter() {
            var sumber = $('#sumber').val();
            var id_permintaan = $('#id_permintaan').val();
            $('#id_sumber').removeAttr('disabled');
            if (sumber == 'gudang') {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('get.GudangorCounter') }}',
                    data: {
                        '_token': '<?php echo csrf_token(); ?>',
                        'sumber': sumber
                    },
                    success: function(data) {
                        $('#id_sumber').html("");
                        $.each(data.msg, function(index, value) {
                            $('#id_sumber').append("<option value='" + value.gudang_id + "'>" +
                                value.name + "</option>");
                        })
                    }
                });
            } else if (sumber == 'counter') {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('get.GudangorCounter') }}',
                    data: {
                        '_token': '<?php echo csrf_token(); ?>',
                        'sumber': sumber,
                        'id_permintaan': id_permintaan
                    },
                    success: function(data) {
                        $('#id_sumber').html("");
                        $.each(data.msg, function(index, value) {
                            $('#id_sumber').append("<option value='" + value.counter_id + "'>" +
                                value.name + "</option>");
                        })
                    }
                });
            }
        }
    </script>
@endpush

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Persetujuan</h1>
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
                    <h6 class="m-2 font-weight-bold text-primary">Persetujuan Permintaan Barang</h6>
                </div>
                <div class="card-body ml-5">
                    <form action="{{ route('temporary.persetujuan') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <input type="hidden" name="slug" value="{{ $slug }}">
                                <label for="id_permintaan" style="color: black; font-weight: 500px;">ID permintaan</label>
                                <input type="text" class="form-control form-control-user"
                                    style="color: black; font-weight: 500px;" id="id_permintaan" name="id_permintaan"
                                    placeholder="" value="{{ $permintaan_id }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <label for="id_pengiriman" style="color: black; font-weight: 500px;">ID Pengiriman</label>
                                <input type="text" class="form-control form-control-user"
                                    style="color: black; font-weight: 500px;" id="id_pengiriman" name="id_pengiriman"
                                    placeholder="" value="{{ $kode }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <label for="persetujuan" style="color: black; font-weight: 500px;">Persetujuan</label>
                                <select class="form-control form-control-user" name="persetujuan" id="persetujuan"
                                    onchange="getPersetujuan()">
                                    <option value="pilih">Pilih</option>
                                    <option value="Setuju">Setuju</option>
                                    <option value="Tidak">Tidak Setuju</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <input type="hidden" name="id_barang" value="{{ $details->barang_id }}">
                                <label for="nama_barang" style="color: black; font-weight: 500px;">Nama Barang</label>
                                <input type="text" class="form-control form-control-user"
                                    style="color: black; font-weight: 500px;" id="nama_barang" name="nama_barang"
                                    value="{{ $details->nama_barang }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <label for="nama_counter" style="color: black; font-weight: 500px;">Nama Counter
                                    Request</label>
                                <input type="text" class="form-control form-control-user"
                                    style="color: black; font-weight: 500px;" id="nama_counter" name="nama_counter"
                                    value="{{ $details->name }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <label for="jumlah_pengiriman" style="color: black; font-weight: 500px;">Jumlah
                                    Permintaan</label>
                                <input type="text" class="form-control form-control-user" id="jumlah_pengiriman"
                                    style="color: black; font-weight: 500px;" name="jumlah_pengiriman"
                                    onkeypress="InputNumbers(event)" value="{{ $details->jumlah_permintaan }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <label for="sumber" style="color: black; font-weight: 500px;">Sumber</label>
                                <select name="sumber" id="sumber" class="form-control form-control-user"
                                    onchange="getGudangorCounter()" disabled>
                                    <option value="pilih">Pilih Sumber</option>
                                    <option value="gudang">Gudang</option>
                                    <option value="counter">Counter</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <label for="id_sumber" style="color: black; font-weight: 500px;">Nama Sumber</label>
                                <select name="id_sumber" id="id_sumber" class="form-control form-control-user" disabled>
                                    <option value="pilih">Pilih Nama Sumber</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center m-0">
                            <div class="col-sm-4 text-right">
                            </div>
                            <div class="col-sm-4">
                                <a href="{{ url('/permintaan/show/' . $details->slug) }}" class="btn btn-secondary"><i
                                        class="fas fa-window-close"></i><span>&nbsp;Batal</span></a>
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#saveModal"><i
                                        class="fas fa-save"></i><span>&nbsp;Simpan</span></a>
                            </div>
                            <div class="col-sm-4">
                            </div>
                        </div>

                        <!-- Save Modal-->
                        <div class="modal fade" id="saveModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Apakah siap untuk disimpan ?</h5>
                                        <button class="close" type="button" data-dismiss="modal"
                                            aria-label="Close">
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
    </div>
@endsection

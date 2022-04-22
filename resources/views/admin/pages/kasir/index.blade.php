@extends('admin.layouts.app')

@section('title')
    Kasir
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
        $(document).on('click', '#add', function() {
            let slug = $(this).attr('data-id');
            $('#slug').val(slug);
        });

        $(document).on('click', '#delete', function() {
            let slug_delete = $(this).attr('data-id');
            $('#slug_delete').val(slug_delete);
        });

        function InputNumbers(evt) {

            var key = String.fromCharCode(evt.which);

            if (!(/[0-9]/.test(key))) {
                evt.preventDefault();
            }
        };
        $(document).ready(function() {
            $('#tableKasir').DataTable();
            $('#tableKeranjang').DataTable();
        });
    </script>
@endpush

@php
$no_kasir = 0;
$no_keranjang = 0;
$total = 0;
@endphp

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kasir</h1>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-2 font-weight-bold text-primary">Kasir {{ $counter_name }}</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tableKasir" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Barang</th>
                                    <th>Stok</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Barang</th>
                                    <th>Stok</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($temporary_barang_counters as $kode_session => $temporary_barang_counter)
                                    @php
                                        $no_kasir++;
                                    @endphp
                                    <tr>
                                        <td>{{ $no_kasir }}</td>
                                        <td>{{ $temporary_barang_counter['nama_barang'] }}</td>
                                        <td>{{ $temporary_barang_counter['harga_barang'] }}</td>
                                        <td>{{ $temporary_barang_counter['barang_counter_stok'] }}</td>
                                        <td><a href="#" id="add" class="btn btn-primary" data-toggle='modal'
                                                data-target='#addModal'
                                                data-id="{{ $temporary_barang_counter['slug'] }}"><i
                                                    class="fas fa-plus-circle"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Add Modal-->
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin menambahkan barang?
                            </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Masukkan jumlah pembelian yang akan dibeli dan tekan "Iya" jika ingin menambahkan, pilih
                                "Batal" bila ingin membatalkan</p>
                            <form action="{{ route('temporary.keranjang') }}" method="post">
                                @csrf
                                <input type="hidden" name="slug" id="slug">
                                <label for="qty_penjualan">Jumlah Pembelian</label>
                                <input type="text" class="form-control" name="qty_penjualan" id="qty_penjualan"
                                    onkeypress="InputNumbers(event)">
                        </div>
                        <div class="modal-footer">

                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row justify-content-between m-0">
                        <h6 class="m-2 font-weight-bold text-primary">Transaksi {{ $kode }}</h6>
                        @if (!empty($temporary_keranjang_counters))
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#saveModal"><i
                                    class="fas fa-save"></i><span>&nbsp;Simpan</span></a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tableKeranjang" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Barang</th>
                                    <th>Jumlah Pembelian</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Barang</th>
                                    <th>Jumlah Pembelian</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @if (!empty($temporary_keranjang_counters))
                                    @foreach ($temporary_keranjang_counters as $kode_session => $temporary_keranjang_counter)
                                        @php
                                            $no_keranjang++;
                                            $total = $total + $temporary_keranjang_counter['harga_barang'] * $temporary_keranjang_counter['barang_counter_stok'];
                                        @endphp
                                        <tr>
                                            <td>{{ $no_keranjang }}</td>
                                            <td>{{ $temporary_keranjang_counter['nama_barang'] }}</td>
                                            <td>{{ $temporary_keranjang_counter['harga_barang'] }}</td>
                                            <td>{{ $temporary_keranjang_counter['barang_counter_stok'] }}</td>
                                            <td><a href="#" id="delete" class="btn btn-danger" data-toggle='modal'
                                                    data-target='#deleteModal'
                                                    data-id="{{ $temporary_keranjang_counter['slug'] }}"><i
                                                        class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <h5 class="text-dark text-center text-bold">Grand Total Rp {{ $total }}</h5>
                    </div>
                </div>
            </div>

            <!-- Delete Modal-->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Anda yakin untuk hapus dari keranjang ?
                            </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Pilih iya jika ingin dihapus atau pilih tidak bila tidak ingin dihapus.
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                            <form action="{{ route('destroy.temporary.keranjang') }}" method="post">
                                @csrf
                                <input type="hidden" name="slug_delete" id="slug_delete">
                                <button type="submit" class="btn btn-primary">Iya</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Save Modal-->
            <div class="modal fade" id="saveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Anda yakin untuk hapus dari keranjang ?
                            </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Pilih iya jika ingin dihapus atau pilih tidak bila tidak ingin dihapus.
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                            <a href="{{ route('store.transaksi') }}" class="btn btn-primary">Iya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

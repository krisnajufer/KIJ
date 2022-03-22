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
        $('input[name=options]').each((i, el) => {
            $(el).on('change', (e) => {
                const sumber = $(e.target).val();
                if (sumber == 'gudang') {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('get.gudang') }}',
                        data: {
                            '_token': '<?php echo csrf_token(); ?>',
                            'sumber': sumber,
                        },
                        success: function(data) {
                            var len = 0;
                            var table = $('#dataTable').DataTable();
                            table.clear().draw();
                            len = data['barang'].length;
                            var role = "<?php echo Auth::guard('admin')->user()->role; ?>"
                            console.log(role);
                            if (len > 0) {
                                if (role == 'gudang') {
                                    $('#tambah').show();
                                    for (var i = 0; i < len; i++) {
                                        var id = data['barang'][i].barang_id;
                                        var slug = data['barang'][i].slug;
                                        var nama = data['barang'][i].nama_barang;
                                        var stok = data['barang'][i].stok_barang;
                                        var harga = data['barang'][i].harga_barang;

                                        var href = "<?php if(Auth::guard('admin')->user()->role == 'gudang'){ ?>" +
                                            "<div class='row justify-content-between'><a href='/laporan/klasifikasi/detail/" +
                                            slug +
                                            "'" +
                                            " class='btn btn-info ml-2'><i class='fas fa-edit'></i><Span>&nbsp;Edit</Span><a/>" +
                                            "<a href='#'" +
                                            "'" +
                                            " class='btn btn-danger mr-1' data-toggle='modal' data-target='#deleteModal'><i class='fas fa-trash'></i><Span>&nbsp;Delete</Span><a/>" +
                                            "</div>" +
                                            "<div class='modal fade' id='deleteModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>" +
                                            "<div class='modal-dialog' role='document'>" +
                                            "<div class='modal-content'>" +
                                            "<div class='modal-header'>" +
                                            "<h5 class='modal-title' id='exampleModalLabel'>Anda yakin untuk hapus data?</h5>" +
                                            "<button class='close' type='button' data-dismiss='modal' aria-label='Close'>" +
                                            "<span aria-hidden='true'>×</span>" +
                                            "</button>" +
                                            "</div>" +
                                            "<div class='modal-body'>Pilih iya jika ingin dihapus atau pilih tidak bila tidak ingin dihapus.</div>" +
                                            "<div class='modal-footer'>" +
                                            "<button class='btn btn-secondary' type='button' data-dismiss='modal'>Cancel</button>" +
                                            "<a href='<?php echo url('/barang/destroy/" + slug +"'); ?>" +
                                            "'" +
                                            " class='btn btn-primary mr-1'><Span>&nbsp;Iya</Span><a/>" +
                                            "</div>" +
                                            "</div>" +
                                            "</div>" +
                                            "</div>" +
                                            " <?php } ?>";

                                        table.row.add([
                                            (i + 1),
                                            id,
                                            nama,
                                            stok,
                                            harga,
                                            href

                                        ]).draw(false);
                                    }
                                } else {
                                    var table = $('#dataTable').DataTable();
                                    table.columns(5).visible(false);
                                    table.clear().draw();
                                    for (var i = 0; i < len; i++) {
                                        var id = data['barang'][i].barang_id;
                                        var slug = data['barang'][i].slug;
                                        var nama = data['barang'][i].nama_barang;
                                        var stok = data['barang'][i].stok_barang;
                                        var harga = data['barang'][i].harga_barang;

                                        var href = "none";

                                        table.row.add([
                                            (i + 1),
                                            id,
                                            nama,
                                            stok,
                                            harga,
                                            href

                                        ]).draw(false);
                                    }
                                }
                            } else {
                                table.clear().draw();
                            }
                        }
                    });
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('get.counter') }}',
                        data: {
                            '_token': '<?php echo csrf_token(); ?>',
                            'sumber': sumber,
                        },
                        success: function(data) {
                            var len = 0;
                            $('#tambah').hide();
                            $('#dataTable').DataTable().clear().destroy();
                            $('#dataTable').DataTable({
                                columns: [{
                                        title: "No"
                                    },
                                    {
                                        title: "ID Barang"
                                    },
                                    {
                                        title: "Nama Barang"
                                    },
                                    {
                                        title: "Stok"
                                    },
                                    {
                                        title: "Harga"
                                    },
                                    {
                                        title: "Counter"
                                    }
                                ]
                            });
                            var table = $('#dataTable').DataTable();
                            table.clear().draw();
                            len = data['barang'].length;
                            if (len > 0) {
                                for (var i = 0; i < len; i++) {
                                    var id = data['barang'][i].barang_counter_id;
                                    var nama = data['barang'][i].nama_barang;
                                    var stok = data['barang'][i].barang_counter_stok;
                                    var harga = data['barang'][i].harga_barang;
                                    var counter = data['barang'][i].name;

                                    table.row.add([
                                        (i + 1),
                                        id,
                                        nama,
                                        stok,
                                        harga,
                                        counter

                                    ]).draw(false);
                                }
                            } else {
                                table.clear().draw();
                            }
                        }
                    });
                }
            });
        });
    </script>
@endpush

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Barang</h1>
    </div>

    @if (session()->has('success'))
        <div class="row">
            <div class="col-md-12">

                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
            </div>
        </div>
    @endif

    @if (session()->has('info'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info alert-dismissible fade show text-center" role="alert">
                    <strong>{{ session('info') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
            </div>
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row m-0">
                <div class="col-md-4">
                    <h6 class="m-2 font-weight-bold text-primary">Data Barang</h6>
                </div>
                <div class="col-md-4 d-flex justify-content-center">
                    @if (Auth::guard('admin')->user()->role == 'gudang' or Auth::guard('admin')->user()->role == 'owner')
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="options" id="options" value="gudang" autocomplete="off"><i
                                    class="fas fa-warehouse"></i> &nbsp;<span>Gudang</span>
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="options" id="options" value="counter" autocomplete="off"><i
                                    class="fas fa-store"></i>
                                &nbsp;<span>Counter</span>
                            </label>
                        </div>
                    @endif
                </div>
                <div class="col-md-4 d-flex justify-content-end">
                    @if (Auth::guard('admin')->user()->role == 'gudang')
                        <a href="{{ route('tambah.barang') }}" class="btn btn-primary" id="tambah"
                            style="display: none;"><i class="fas fa-plus-circle"></i><span>&nbsp;Tambah</span></a>
                    @endif
                </div>

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
                            @if (Auth::guard('admin')->user()->role == 'gudang' or Auth::guard('admin')->user()->role == 'owner')
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>ID Barang</th>
                            <th>Nama Barang</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            @if (Auth::guard('admin')->user()->role == 'gudang' or Auth::guard('admin')->user()->role == 'owner')
                                <th>Action</th>
                            @endif
                        </tr>
                    </tfoot>
                    <tbody>
                        @if (Auth::guard('admin')->user()->role == 'counter')
                            @foreach ($barangs as $no => $barang)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $barang->barang_counter_id }}</td>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td>{{ $barang->stok_barang }}</td>
                                    <td>{{ $barang->harga_barang }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Confirm Delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Anda yakin untuk hapus data?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih iya jika ingin dihapus atau pilih tidak bila tidak ingin dihapus.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('auth.logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

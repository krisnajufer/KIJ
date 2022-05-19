@extends('admin.layouts.app')

@section('title')
    Laporan Klasifikasi
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script>
        $('input[name=options]').each((i, el) => {
            $(el).on('change', (e) => {
                const sumber = $(e.target).val();
                if (sumber == 'gudang') {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('get.klasifikasi.gudang') }}',
                        data: {
                            '_token': '<?php echo csrf_token(); ?>',
                            'sumber': sumber,
                        },
                        success: function(data) {
                            var len = 0;
                            var table = $('#dataTable').DataTable();
                            table.clear().draw();
                            len = data['klasifikasi'].length;
                            var role = "<?php echo Auth::guard('admin')->user()->role; ?>"
                            console.log(role);
                            if (len > 0) {
                                for (var i = 0; i < len; i++) {
                                    var id = data['klasifikasi'][i].klasifikasi_id;
                                    var slug = data['klasifikasi'][i].slug;
                                    var name = data['klasifikasi'][i].name;
                                    var start_date = data['klasifikasi'][i]
                                        .tgl_mulai_klasifikasi;
                                    var end_date = data['klasifikasi'][i]
                                        .tgl_akhir_klasifikasi;
                                    var total = data['klasifikasi'][i].total_biaya_pertahun;

                                    var tanggal_mulai = moment(start_date).format(
                                        'MMMM YYYY');
                                    var tanggal_akhir = moment(end_date).format(
                                        'MMMM YYYY');
                                    var currency = total.toLocaleString("id-ID", {
                                        style: "currency",
                                        currency: "IDR"
                                    });

                                    var href = "<?php if(Auth::guard('admin')->user()->role == 'gudang'){ ?>" +
                                        "<div class='row justify-content-between'><a href='<?php echo url('/laporan/klasifikasi/detail/" +
                                                                                    slug +
                                                                                    "'); ?>'" +
                                        " class='btn btn-info ml-2'><i class='fas fa-info-circle'></i><Span>&nbsp;Detail</Span><a/>" +
                                        "</div>" +
                                        " <?php } ?>";

                                    table.row.add([
                                        (i + 1),
                                        id,
                                        name,
                                        tanggal_mulai,
                                        tanggal_akhir,
                                        currency,
                                        href

                                    ]).draw(false);
                                }
                            } else {
                                table.clear().draw();
                            }
                        }
                    });
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('get.klasifikasi.counter') }}',
                        data: {
                            '_token': '<?php echo csrf_token(); ?>',
                            'sumber': sumber,
                        },
                        success: function(data) {
                            var len = 0;
                            var table = $('#dataTable').DataTable();
                            table.clear().draw();
                            len = data['klasifikasi'].length;
                            if (len > 0) {
                                for (var i = 0; i < len; i++) {
                                    var id = data['klasifikasi'][i].klasifikasi_id;
                                    var slug = data['klasifikasi'][i].slug;
                                    var name = data['klasifikasi'][i].name;
                                    var start_date = data['klasifikasi'][i]
                                        .tgl_mulai_klasifikasi;
                                    var end_date = data['klasifikasi'][i]
                                        .tgl_akhir_klasifikasi;
                                    var total = data['klasifikasi'][i].total_biaya_pertahun;

                                    var tanggal_mulai = moment(start_date).format(
                                        'MMMM YYYY');
                                    var tanggal_akhir = moment(end_date).format(
                                        'MMMM YYYY');
                                    var currency = total.toLocaleString("id-ID", {
                                        style: "currency",
                                        currency: "IDR"
                                    });

                                    var href = "<?php if(Auth::guard('admin')->user()->role == 'gudang'){ ?>" +
                                        "<div class='row justify-content-between'><a href='<?php echo url('/laporan/klasifikasi/detail/" +
                                                                                    slug +
                                                                                    "'); ?>'" +
                                        " class='btn btn-info ml-2'><i class='fas fa-info-circle'></i><Span>&nbsp;Detail</Span><a/>" +
                                        "</div>" +
                                        " <?php } ?>";

                                    table.row.add([
                                        (i + 1),
                                        id,
                                        name,
                                        tanggal_mulai,
                                        tanggal_akhir,
                                        currency,
                                        href

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
        <h1 class="h3 mb-0 text-gray-800">Laporan Klasifikasi</h1>
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
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-2 font-weight-bold text-primary">Laporan Klasifikasi</h6>
        </div>
        <div class="card-body">

            @if (Auth::guard('admin')->user()->role == 'gudang' or Auth::guard('admin')->user()->role == 'owner')
                <div class="d-flex justify-content-center">
                    <div class="row justify-content-start">
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
                    </div>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Klasifikasi</th>
                            <th>Sumber</th>
                            <th>Bulan Mulai Klasifikasi</th>
                            <th>Bulan Akhir Klasifikasi</th>
                            <th>Total Pendapatan Pertahun</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    {{-- <tfoot>
                        <tr>
                            <th>No</th>
                            <th>ID Klasifikasi</th>
                            <th>Sumber</th>
                            <th>Tanggal Mulai Klasifikasi</th>
                            <th>Tanggal Akhir Klasifikasi</th>
                            <th>Total Biaya Pertahun</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot> --}}
                    <tbody>
                        @if (Auth::guard('admin')->user()->role == 'counter')
                            @foreach ($klasifikasis as $no => $klasifikasi)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $klasifikasi->klasifikasi_id }}</td>
                                    <td>{{ $klasifikasi->name }}</td>
                                    <td>
                                        @php
                                            $date_start = date_create($klasifikasi->tgl_mulai_klasifikasi);
                                            $tanggal_awal = date_format($date_start, 'F Y');
                                            echo $tanggal_awal;
                                        @endphp
                                    </td>
                                    <td>
                                        @php
                                            $date_end = date_create($klasifikasi->tgl_akhir_klasifikasi);
                                            $tanggal_akhir = date_format($date_end, 'F Y');
                                            echo $tanggal_akhir;
                                        @endphp
                                    </td>
                                    <td>
                                        @php
                                            $rupiah = number_format($klasifikasi->total_biaya_pertahun, 0, ',', '.');
                                            echo 'Rp ' . $rupiah;
                                        @endphp
                                    </td>
                                    <td>
                                        <a href="{{ url('/laporan/klasifikasi/detail/' . $klasifikasi->slug) }}"
                                            class="btn btn-info">
                                            <i class="fas fa-info-circle"></i>&nbsp;<span>Detail</span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

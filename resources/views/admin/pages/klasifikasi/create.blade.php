@extends('admin.layouts.app')

@section('title')
    Tambah Klasifikasi
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
        $('#dataTable').dataTable({
            "order": [],
        });
    </script>
@endpush

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Klasifikasi</h1>
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
            <h6 class="m-2 font-weight-bold text-primary">Tambah Klasifikasi</h6>
            @if ($counts > 0)
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#saveModal"><i
                        class="fas fa-save"></i><span>&nbsp;Simpan</span></a>
            @endif
        </div>
        <form action="{{ route('store.klasifikasi') }}" method="post">
            @csrf
            @if ($counts > 0)
                <input type="hidden" name="aftersub" value="{{ $afterSub }}">
                <input type="hidden" name="date" value="{{ $date }}">
            @endif
            <!-- Save Modal-->
            <div class="modal fade" id="saveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Apakah siap untuk disimpan ?</h5>
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
        <div class="card-body">
            <form action="{{ route('create.sample.klasifikasi') }}" method="post">
                <div class="row justify-content-start">
                    @csrf
                    <div class="col-2">
                        <div class="form-group">
                            <label for="yearpicker">Tahun Klasifikasi</label>
                            <input type="month" name="thn_klasifikasi" id="yearpicker" class="form-control">
                        </div>
                    </div>
                    <div class="col" style="margin-top: 32px;">
                        <input type="submit" name="proses" value="Klasifikasi" class="btn btn-success">
                    </div>
            </form>
        </div>
        <div class="table-responsive">
            @if ($counts > 0)
                <h5 class="mt-3 mb-3">Klasifikasi
                    <br>
                    <span class="text-primary">
                        @php
                            $tahunAwal = date_create($afterSub);
                            $tahun_awal = date_format($tahunAwal, 'F Y');
                            echo $tahun_awal;
                        @endphp
                    </span>
                    sampai
                    <span class="text-primary">
                        @php
                            $tahunAkhir = date_create($date);
                            $tahun_akhir = date_format($tahunAkhir, 'F Y');
                            echo $tahun_akhir;
                        @endphp
                    </span>
                </h5>
            @endif
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>(Permintaan tahunan
                            × cost/unit)/Total
                            (%)</th>
                        <th>Persentase Kumulatif</th>
                        <th>Klasifikasi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nama Barang</th>
                        <th>(Permintaan tahunan
                            × cost/unit)/Total
                            (%)</th>
                        <th>Persentase Kumulatif</th>
                        <th>Klasifikasi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @if ($counts > 0)
                        @php
                            $hasil = 0;
                            $total = 0;
                            foreach ($samples as $sample) {
                                $total += $sample->costxpertahun;
                            }
                        @endphp
                        @foreach ($samples as $sample)
                            <tr>

                                <td>{{ $sample->nama_barang }}</td>
                                <td>
                                    @php
                                        $decimal = round(($sample->costxpertahun / $total) * 100, 2);
                                        echo $decimal . ' %';
                                    @endphp
                                </td>
                                <td>
                                    @php
                                        $hasil += $decimal;
                                        echo $hasil . ' %';
                                    @endphp
                                </td>
                                <td>
                                    @if ($hasil <= 75.0)
                                        A
                                    @elseif ($hasil <= 95.0)
                                        B
                                    @else
                                        C
                                    @endif
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

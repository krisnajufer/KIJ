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
    <script>
        $(document).on('click', '#delete', function() {
            let slug = $(this).attr('data-id');
            $('#slug').val(slug);
        });
    </script>
@endpush

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Counter</h1>
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
            <div class="row justify-content-between m-0">
                <h6 class="m-2 font-weight-bold text-primary">Data Counter</h6>
                @if (Auth::guard('admin')->user()->role == 'gudang')
                    <a href="{{ route('create.counter') }}" class="btn btn-primary"><i
                            class="fas fa-plus-circle"></i><span>&nbsp;Tambah</span></a>
                @endif
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Counter</th>
                            <th>Nama Counter</th>
                            <th>Alamat</th>
                            <th>Username</th>
                            @if (Auth::guard('admin')->user()->role == 'gudang')
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    {{-- <tfoot>
                        <tr>
                            <th>No</th>
                            <th>ID Counter</th>
                            <th>Nama Counter</th>
                            <th>Alamat</th>
                            <th>Username</th>
                            @if (Auth::guard('admin')->user()->role == 'gudang')
                                <th>Action</th>
                            @endif
                        </tr>
                    </tfoot> --}}
                    <tbody>
                        @foreach ($counters as $no => $counter)
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>{{ $counter->counter_id }}</td>
                                <td>{{ $counter->name }}</td>
                                <td>{{ $counter->alamat_counter }}</td>
                                <td>{{ $counter->username }}</td>
                                @if (Auth::guard('admin')->user()->role == 'gudang')
                                    <td>
                                        <a href="{{ url('/counter/edit/' . $counter->slug) }}" class="btn btn-info"><i
                                                class="fas fa-edit"></i><Span>&nbsp;Edit</Span></a>
                                        <a href="#" id="delete" class="btn btn-danger" data-toggle='modal'
                                            data-target='#deleteModal' data-id="{{ $counter->slug }}"><i
                                                class="fas fa-trash"></i></i><Span>&nbsp;Delete</Span></a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Anda yakin untuk hapus data?
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Iya" jika ingin dihapus atau pilih "Tidak" bila tidak ingin dihapus.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                    <form action="{{ route('destroy.counter') }}" method="post">
                        @csrf
                        <input type="hidden" name="slug" id="slug">
                        <button type="submit" class="btn btn-primary">Iya</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

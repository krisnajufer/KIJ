<!DOCTYPE html>
<html lang="en">

<head>

    {{-- Start of Including Meta --}}
    @include('admin.includes.meta')
    {{-- End of Including Meta --}}

    <title>KIJ - @yield('title')</title>

    {{-- Start of Including Style / CSS --}}
    @stack('before-style')
    @include('admin.includes.style')
    @stack('after-style')
    {{-- End of Including Style / CSS --}}

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        {{-- Start of Including Sidebar --}}
        @include('admin.includes.sidebar')
        {{-- End of Including Sidebar --}}

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                {{-- Start of Including Navbar --}}
                @include('admin.includes.navbar')
                {{-- End of Including Navbar --}}

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            {{-- Start of Including Footer --}}
            @include('admin.includes.footer')
            {{-- End of Including Footer --}}

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
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

    {{-- Start of Including Script / Javascript --}}
    @stack('before-script')
    @include('admin.includes.script')
    @stack('after-script')
    {{-- End of Including Script / Javascript --}}

</body>

</html>

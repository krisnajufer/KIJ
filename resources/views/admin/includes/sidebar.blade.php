<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">YMS <sup>SBY</sup></div>
    </a>

    {{-- <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master Data
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('barang') }}">
            <i class="fa fa-archive"></i>
            <span>Barang</span></a>
    </li>
    @if (Auth::guard('admin')->user()->role == 'gudang' or Auth::guard('admin')->user()->role == 'owner')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('gudang') }}">
                <i class="fas fa-warehouse"></i>
                <span>Gudang</span></a>
        </li>
    @endif

    <li class="nav-item">
        <a class="nav-link" href="{{ route('counter') }}">
            <i class="fas fa-store"></i>
            <span>Counter</span></a>
    </li>



    <!-- Nav Item - Pages Collapse Menu -->
    @if (Auth::guard('admin')->user()->role == 'counter' or Auth::guard('admin')->user()->role == 'gudang')
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Transaksi
        </div>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('permintaan') }}" aria-expanded="true">
                <i class="fa fa-cube" aria-hidden="true"></i>
                <span>
                    @if (Auth::guard('admin')->user()->role == 'gudang')
                        Permintaan dari Counter
                    @elseif (Auth::guard('admin')->user()->role == 'counter')
                        Permintaan ke Gudang
                    @endif
                </span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('pengiriman') }}" aria-expanded="true">
                <i class="fas fa-truck"></i>
                <span>
                    @if (Auth::guard('admin')->user()->role == 'gudang')
                        Pengiriman ke Counter
                    @elseif (Auth::guard('admin')->user()->role == 'counter')
                        Pengiriman dari Gudang
                    @endif
                </span>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('penerimaan') }}">
                <i class="fas fa-truck-loading"></i>
                <span>Penerimaan</span></a>
        </li> --}}
    @endif

    @if (Auth::guard('admin')->user()->role == 'counter')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('kasir') }}">
                <i class="fas fa-calculator"></i>
                <span>Kasir</span></a>
        </li>
    @endif

    @if (Auth::guard('admin')->user()->role == 'counter' or Auth::guard('admin')->user()->role == 'gudang')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('index.transaksi') }}">
                <i class="fas fa-book"></i>
                <span>Transaksi Penjualan</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('klasifikasi') }}">
                <i class="fas fa-fax"></i>
                <span>Klasifikasi</span></a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Heading -->
    <div class="sidebar-heading">
        Laporan
    </div>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport" aria-expanded="true"
            aria-controls="collapseUtilities">
            <i class="fas fa-file-archive"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseReport" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Laporan</h6>
                <a class="collapse-item" href="{{ route('laporan.penjualan') }}">Transaksi Penjualan</a>
                <a class="collapse-item" href="{{ route('laporan.klasifikasi') }}">Klasifikasi</a>
            </div>
        </div>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

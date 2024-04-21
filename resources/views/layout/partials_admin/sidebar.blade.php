<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Kamar</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('kamar') }}">
                        <i class="bi bi-circle"></i><span>Daftar Kamar</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('pelanggan') }}">
                <i class="bi bi-grid"></i>
                <span>Pelanggan</span>
            </a>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('transaksi') }}">
                <i class="bi bi-grid"></i>
                <span>Transaksi</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            {{-- <a class="nav-link" href="{{ route('transaction') }}">
                <i class="bi bi-grid"></i>
                <span>Transaction</span>
            </a> --}}
        </li><!-- Transaction Nav -->
    </ul>
</aside>
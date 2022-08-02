<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="{{ route('home') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">Administrasi</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('bulan.index') }}">
                                <span data-key="t-calendar">Laporan Bulanan</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span data-key="t-calendar">Berkas Rapat</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <span data-key="t-email">Regulasi</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="#" data-key="t-inbox">Berita Terkini</a></li>
                                <li><a href="#" data-key="t-read-email">Info Kesehatan</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <span data-key="t-email">PKRS</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="#" data-key="t-inbox">E-Poster</a></li>
                                <li><a href="#" data-key="t-read-email">Mutiara Hikmah</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('dashboard2/assets/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('page_title')</title>

    <meta name="description" content="" />


    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('dashboard2/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('dashboard2/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard2/assets/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('dashboard2/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('dashboard2/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="{{ asset('dashboard2/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard2/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/sass/style.scss'])
    <!-- Helpers -->
    <script src="{{ asset('dashboard2/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('dashboard2/assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme"
                style="background: linear-gradient(to bottom, #32CD32, #228B22);">
                <div class="main-sidebar sidebar-style-2">
                    <a href="dashboard" class="app-brand-link">
                        <span class="app-brand-logo demo"
                            style="display: flex; flex-direction: column; align-items: center;">
                            <img src="{{ asset('dashboard2/assets/img/icons/logocime.png') }}"
                                style="width: 200px; height: auto; margin-top: 20px; margin-left: 30px;" />
                            <hr>

                        </span>
                    </a>
                    <div style="margin-top: 30px;"></div>

                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>
                {{-- <div class="menu-inner-shadow"></div> --}}
                <ul class="menu-inner py-1">
                    <li class="menu-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admindashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home"></i>
                            <div data-i18n="Analytics" class="larger-text">Dashboard</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('admin/all-satuan*') ? 'active' : '' }}">
                        <a href="{{ route('allsatuan') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-table"></i>
                            <div data-i18n="Basic" class="larger-text">Daftar Satuan</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('admin/all-type*') ? 'active' : '' }}">
                        <a href="{{ route('alltype') }}" class="menu-link">
                            <i class='menu-icon tf-icons bx bx-package'></i>
                            <div data-i18n="Basic" class="larger-text">Daftar Jenis Barang</div>
                        </a>

                    </li>
                    <li class="menu-item {{ request()->is('admin/all-item*') ? 'active' : '' }}">
                        <a href="{{ route('allitems') }}" class="menu-link">
                            <i class='menu-icon tf-icons bx bx-shopping-bag'></i>
                            <div data-i18n="Basic" class="larger-text">Daftar Barang</div>
                        </a>
                    </li>

                    <li class="menu-item {{ request()->is('admin/all-produk*') ? 'active' : '' }}">
                        <a href="{{ route('allproduk') }}" class="menu-link">
                            <i class='menu-icon tf-icons bx bx-shopping-bag'></i>
                            <div data-i18n="Basic" class="larger-text">Daftar Produk</div>
                        </a>
                    </li>

                    <li class="menu-item {{ request()->is('admin/daftar-supplier*') ? 'active' : '' }}">
                        <a href="{{ route('allsuppliers') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-store"></i>
                            <div data-i18n="Basic" class="larger-text">Data Supplier</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('admin/all-customer*') ? 'active' : '' }}">
                        <a href="{{ route('allcustomer') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-table"></i>
                            <div data-i18n="Basic" class="larger-text">Daftar Customer</div>
                        </a>
                    </li>

                    <li
                        class="menu-item {{ request()->is('admin/all-laporan*') || request()->is('admin/laporan-transaksi') ? 'active' : '' }}">
                        <a href="{{ route('alllaporan') }}" class="menu-link">
                            <i class='menu-icon tf-icons bx bx-shopping-bag'></i>
                            <div data-i18n="Basic" class="larger-text">Laporan</div>
                    
                    <li class="menu-item {{ request()->is('admin/all-transaksi*') ? 'active' : '' }}">
                        <a href="{{ route('alltransaksi') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-collection"></i>
                            <div data-i18n="Basic" class="larger-text">Data Transaksi</div>
                        </a>
                    </li>

                    <li class="menu-item {{ request()->is('admin/admin-profile*') ? 'active' : '' }}">
                        <a href="{{ route('profile') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div data-i18n="Basic" class="larger-text">Profil</div>
                        </a>
                    </li>
                    <!-- <div class="koi-image-container">
                        <img src="{{ asset('assets/images/koi1.png') }}"
                            style="opacity: 0.5; margin-top: 70px; width: 230px; height: auto;" />
                    </div> -->
                </ul>
                <style>
                    /* Mengubah warna teks menu menjadi putih terang dan bold */
                    #layout-menu .menu-item .menu-link {
                        overflow-y: auto;
                        /* Enable scrolling */
                        max-height: 100vh;
                        /* Limit sidebar height to the viewport */
                        color: #ffffff !important;
                        /* Warna putih terang */
                        font-weight: bold !important;
                        /* Tebal */
                    }

                    .larger-text {
                        font-size: 1.2rem;
                        /* Sesuaikan ukuran sesuai kebutuhan */
                        font-weight: bold;
                        /* Opsional untuk membuat teks lebih tegas */
                    }


                    #layout-menu .menu-header .menu-header-text {
                        color: #ffffff !important;
                        /* Warna putih terang untuk header */
                        font-weight: bold !important;
                        /* Tebal */
                    }

                    /* Mengubah warna teks menu menjadi putih terang dan bold untuk item yang aktif */
                    #layout-menu .menu-item.active .menu-link {
                        overflow-y: auto;
                        /* Enable scrolling */
                        max-height: 100vh;
                        /* Limit sidebar height to the viewport */
                        color: #ffffff !important;
                        font-weight: bold !important;
                        background-color: transparent !important;
                        /* Menjaga latar belakang tetap seperti sebelumnya */
                    }


                    /* Mengubah warna teks menu menjadi putih terang dan bold pada hover, jika perlu */
                    #layout-menu .menu-item .menu-link:hover {
                        overflow-y: auto;
                        /* Enable scrolling */
                        max-height: 100vh;
                        /* Limit sidebar height to the viewport */
                        color: #ffffff !important;
                        background-color: rgba(0, 0, 0, 0.1) !important;
                        /* Ubah efek hover sesuai kebutuhan */
                    }




                    /* Jika Anda ingin mengubah latar belakang item menu aktif */
                    #layout-menu .menu-item.active {
                        background-color: rgba(0, 0, 0, 0.2) !important;
                        /* Sesuaikan warna latar belakang aktif */
                    }
                </style>

            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">

                <!-- Navbar -->
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar" style="background: linear-gradient(135deg, #28a745, #0e6b2f);">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        @yield('search')

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('uploads/users/' . Auth::user()->img) }}" alt="user-avatar"
                                            class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ asset('uploads/users/' . Auth::user()->img) }}"
                                                            alt="user-avatar" class="d-block rounded" height="100"
                                                            width="100" id="uploadedAvatar" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    @auth
                                                        <span class="fw-medium d-block">{{ Auth::user()->f_name }}</span>
                                                    @endauth
                                                    <small class="text-muted">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('adminlogout') }}">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>
                <!-- / Navbar -->


                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="{{ asset('dashboard2/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('dashboard2/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('dashboard2/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('dashboard2/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('dashboard2/assets/vendor/js/menu.js') }}"></script>
    @yield('js')
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('dashboard2/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('dashboard2/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('dashboard2/assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
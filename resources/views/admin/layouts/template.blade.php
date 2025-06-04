<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('dashboard2/assets/') }}" data-template="vertical-menu-template-free">
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('dashboard2/assets/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>@yield('page_title')</title>

    <meta name="description" content="" />


   <link rel="shortcut icon" href="{{ asset('dashboard2/assets/img/icons/logocime.png') }}" type="image/png" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('dashboard2/assets/vendor/fonts/boxicons.css') }}" />

    <link rel="stylesheet" href="{{ asset('dashboard2/assets/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('dashboard2/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('dashboard2/assets/css/demo.css') }}" />

    <link rel="stylesheet"
        href="{{ asset('dashboard2/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard2/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/sass/style.scss'])
    <script src="{{ asset('dashboard2/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('dashboard2/assets/js/config.js') }}"></script>

    {{-- Kustom CSS untuk Layout dan Scrolling --}}
    <style>
        html, body {
            height: 100%;
            margin: 0;
            
            
            /* overflow: hidden; Dihapus karena bisa mengunci scroll global */
        }
        .layout-wrapper {
            display: flex;
            flex-direction: column;
            height: 100vh;
            /* overflow: hidden; Dihapus untuk memberikan kesempatan scroll pada body jika perlu */
        }
        .layout-container {
            display: flex;
            flex-grow: 1; /* Memungkinkan kontainer mengambil sisa ruang vertikal */
            /* overflow: hidden; Dihapus */
        }
        .layout-page {
            display: flex;
            flex-direction: column; /* Menumpuk navbar dan content-wrapper secara vertikal */
            flex-grow: 1; /* Memungkinkan halaman mengambil sisa ruang horizontal */
            /* overflow: hidden; Dihapus */
        }
        .layout-navbar {
            flex-shrink: 0; /* Pastikan navbar tidak menyusut */
            /* Anda mungkin perlu menyesuaikan nilai height ini jika navbar Anda memiliki tinggi yang berbeda */
            height: 65px; /* Contoh tinggi navbar, bisa diukur dengan Inspect Element */
            z-index: 10; /* Pastikan navbar tetap di atas konten */
            position: sticky; /* Coba sticky jika fixed membuat masalah */
            top: 0; /* Penting untuk sticky/fixed */
            width: 100%; /* Penting untuk sticky/fixed */
        }
        .content-wrapper {
            flex-grow: 1; /* PENTING: Memungkinkan content-wrapper mengambil sisa tinggi */
            overflow-y: auto; /* AKTIFKAN SCROLL VERTIKAL DI SINI */
            -webkit-overflow-scrolling: touch; /* Untuk iOS */
            padding-bottom: 20px; /* Tambahkan sedikit padding di bawah untuk spasi */
            /* Padding atas untuk mengimbangi tinggi navbar */
            box-sizing: border-box; /* Pastikan padding tidak menambah total tinggi */
        }

        /* Override padding bawaan Bootstrap/Theme pada container-p-y */
        .container-xxl.container-p-y {
            padding-top: 0 !important; /* Hapus padding-top bawaan agar tidak double */
            padding-bottom: 0 !important; /* Hapus padding-bottom bawaan */
            padding-left: var(--bs-gutter-x, 1.5rem); /* Pertahankan padding horizontal */
            padding-right: var(--bs-gutter-x, 1.5rem);
        }

        /* --- Perbaikan CSS Sidebar --- */
        #layout-menu {
            display: flex; /* Aktifkan Flexbox untuk sidebar */
            flex-direction: column; /* Susun item secara vertikal */
            height: 100vh; /* Sidebar mengambil tinggi penuh viewport */
            background-color: #f0f4f8;
            box-shadow: 2px 0 5px rgba(0,0,0,0.05);
            /* Pastikan tidak ada overflow-y: auto; di inline style pada tag aside */
        }

        #layout-menu .menu-inner {
            flex-grow: 1; /* Memungkinkan daftar menu mengambil sisa ruang */
            overflow-y: auto; /* Scrollbar hanya pada daftar menu */
            padding-left: 10px;
            padding-right: 10px;
        }

        /* Tombol Logout */
        #layout-menu .menu-item.mt-auto {
            padding: 0 20px;
            margin-top: auto; /* Dorong ke bawah dalam flex container */
        }

        /* Scrollbar styling untuk sidebar (terapkan pada .menu-inner) */
        #layout-menu .menu-inner::-webkit-scrollbar {
            width: 6px;
        }
        #layout-menu .menu-inner::-webkit-scrollbar-track {
            background: transparent;
        }
        #layout-menu .menu-inner::-webkit-scrollbar-thumb {
            background-color: rgba(0, 123, 255, 0.3);
            border-radius: 10px;
        }

        /* Menu link style (tetap) */
        #layout-menu .menu-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #333 !important;
            font-weight: 600;
            border-radius: 8px;
            transition: background-color 0.3s ease, color 0.3s ease;
            font-size: 1rem;
        }
        #layout-menu .menu-link i {
            margin-right: 12px;
            font-size: 1.25rem;
        }
        #layout-menu .menu-item.active .menu-link {
            background-color: #d0e7ff;
            color: #007bff !important;
            box-shadow: 0 0 8px rgba(0,123,255,0.4);
        }
        #layout-menu .menu-link:hover {
            background-color: #e8f4fd;
            color: #007bff !important;
            text-decoration: none;
        }
        #layout-menu .menu-inner li {
            margin-bottom: 8px;
        }

        /* Brand logo (tetap) */
        .app-brand-link img {
            border-radius: 8px;
            transition: transform 0.3s ease;
        }
        .app-brand-link img:hover {
            transform: scale(1.05);
        }
        @keyframes zoomOut {
            0% {
                transform: scale(1);
            }
            100% {
                transform: scale(0.8);
            }
        }
        .logo-zoom-out {
            animation: zoomOut 1.5s ease-in-out infinite alternate;
        }
        
    </style>
</head>
<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" style="background-color: #f0f4f8; box-shadow: 2px 0 5px rgba(0,0,0,0.05); height: 100vh;">
                <div class="main-sidebar sidebar-style-2" style="padding: 20px; display: flex; justify-content: center; border-bottom: 1px solid #d1d9e6;">
                    <a href="http://127.0.0.1:8000" class="app-brand-link" style="display: flex; justify-content: center; width: 100%;">
                        <img
                            src="{{ asset('dashboard2/assets/img/icons/logocime.png') }}"
                            alt="Logo"
                            class="logo-zoom-out"
                            style="width: 140px; height: auto; border-radius: 8px;"
                        />
                    </a>
                </div>

  <ul class="menu-inner py-3" style="padding-left: 10px; padding-right: 10px;">
    <li class="menu-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
      <a href="{{ route('admindashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home"></i>
        <div>Dashboard</div>
      </a>
    </li>
   <li class="menu-item {{ request()->is('admin/all-satuan*') || request()->is('admin/edit-satuan*') || request()->is('admin/add-satuan') ? 'active' : '' }}">
      <a href="{{ route('allsatuan') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-table"></i>
        <div>Daftar Satuan</div>
      </a>
    </li>
    <li class="menu-item {{ request()->is('admin/all-type*') || request()->is('admin/edit-type*') || request()->is('admin/add-type') ? 'active' : '' }}">
      <a href="{{ route('alltype') }}" class="menu-link">
        <i class='menu-icon tf-icons bx bx-package'></i>
        <div>Daftar Jenis Barang</div>
      </a>
    </li>
    <li class="menu-item {{ request()->is('admin/all-ukuran*') || request()->is('admin/edit-ukuran*') || request()->is('admin/add-ukuran') ? 'active' : '' }}">
      <a href="{{ route('allukuran') }}" class="menu-link">
        <i class='menu-icon tf-icons bx bx-ruler'></i>
        <div>Daftar Ukuran</div>
      </a>
    </li>
   <li class="menu-item {{ request()->is('admin/all-item*') || request()->is('admin/add-items*') || request()->is('admin/keluar-barang') || request()->is('admin/edit-item*') ? 'active' : '' }}">
      <a href="{{ route('allitems') }}" class="menu-link">
        <i class='menu-icon tf-icons bx bx-box'></i>
        <div>Daftar Barang</div>
      </a>
    </li>
    <li class="menu-item {{ request()->is('admin/all-produk*') || request()->is('admin/add-produk*') || request()->is('admin/edit-produk') ? 'active' : '' }}">
      <a href="{{ route('allproduk') }}" class="menu-link">
        <i class='menu-icon tf-icons bx bx-package'></i>
        <div>Daftar Produk</div>
      </a>
    </li>
    <li class="menu-item {{ request()->is('admin/daftar-supplier*') || request()->is('admin/add-supplier*') || request()->is('admin/edit-supplier') ? 'active' : '' }}">
      <a href="{{ route('allsuppliers') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-store"></i>
        <div>Data Supplier</div>
      </a>
    </li>
   <li class="menu-item {{ request()->is('admin/daftar-customer*') ? 'active' : '' }}">
      <a href="{{ route('allcustomer') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-table"></i>
        <div>Daftar Customer</div>
      </a>
    </li>
    <li class="menu-item {{ request()->is('admin/all-transaksi*') ? 'active' : '' }}">
      <a href="{{ route('alltransaksi') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-collection"></i>
        <div>Data Transaksi</div>
      </a>
    </li>
     <li class="menu-item {{ request()->is('admin/forecast*') ? 'active' : '' }}">
      <a href="{{ route('forecast.form') }}"class="menu-link">
        <i class='menu-icon tf-icons bx bx-line-chart'></i>
        <div>Forecasting</div>
      </a>
    </li>
    
  </ul>
 <!-- Tombol Logout di bagian bawah sidebar -->
<div style="position: absolute; bottom: 20px; left: 0; width: 100%; padding: 0 20px;">
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <a href="#" onclick="confirmLogout()"
        style="display: block; width: 100%; background-color: #2f80ed; color: white; text-align: center; border-radius: 8px; padding: 12px; font-weight: bold; font-size: 16px; text-decoration: none;">
        Logout
    </a>
</div>

<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Apakah kamu yakin ingin keluar?',
            text: "Kamu akan keluar dari sesi ini.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, keluar!',
            cancelButtonText: 'Tidak',
            customClass: {
                confirmButton: 'btn btn-outline-primary',
                cancelButton: 'btn btn-outline-danger'
            },
            buttonsStyling: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        })
    }
</script>
</aside>

            <div class="layout-page" style="background-color: rgb(240, 246, 250);">

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar" style="background: linear-gradient(135deg,rgb(255, 255, 255),rgb(255, 255, 255));">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <div class="dropdown">
                            <a class="nav-item nav-link px-0 me-xl-4 dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown">
                                <i class="bx bx-menu bx-sm"></i>
                            </a>
                        </div>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        @yield('search')

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ Auth::user() ? asset('uploads/users/' . Auth::user()->img) : asset('dashboard2/assets/img/avatars/default-avatar.png') }}" alt="user-avatar"
                                            class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile') }}">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ Auth::user() ? asset('uploads/users/' . Auth::user()->img) : asset('dashboard2/assets/img/avatars/default-avatar.png') }}"
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
                                </ul>
                            </li>
                            </ul>
                    </div>
                </nav>

                <div class="content-wrapper">
                    @yield('content')
                </div>
                </div>
            </div>

        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <script src="jquery.js"></script>
    <script src="popper.js"></script>
    <script src="bootstrap.js"></script>
    <script src="{{ asset('dashboard2/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('dashboard2/assets/vendor/js/menu.js') }}"></script>
    @yield('js')

    <script src="{{ asset('dashboard2/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <script src="{{ asset('dashboard2/assets/js/main.js') }}"></script>

    <script src="{{ asset('dashboard2/assets/js/dashboards-analytics.js') }}"></script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>
    @stack('scripts')
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('path/to/bootstrap.bundle.min.js') }}"></script>




</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title') | Toko Percetakan</title>

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/toko.css') }}" />

        
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Tambah CSS custom jika perlu -->
    <style>
        .navbar {
            background: linear-gradient(90deg, #f5f8ff);
            border-bottom: 1px solid #828282;
        }

        .navbar-brand, .nav-link, footer {
            color: white !important;
        }

        footer {
            background-color: #343a40;
            padding: 1rem;
            text-align: center;
            margin-top: 50px;
            color: white;
        }

        .nav-link {
            color: #4318ff !important;
            font-size: 0.95rem;
        }

        /* Padding untuk body agar konten tidak tertutup navbar */
        
        body {
        background-color: #f5f8ff !important;
    }
    </style>
</head>
<body>
<nav class="navbar fixed-top py-3" style="background: rgba(255, 255, 255, 0.9); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); backdrop-filter: blur(6px); z-index: 1030;">
  <div class="container-fluid px-4 d-flex align-items-center justify-content-between flex-wrap">

     <!-- Logo -->
      <div class="d-flex align-items-center me-4" style="margin-left: 30px;">
        <img src="{{ asset('dashboard2/assets/img/icons/logocime.png') }}" alt="Logo" width="120" class="me-2">
      </div>
        <!-- Search Bar -->
      <form class="flex-grow-1 me-4" style="max-width: 600px;" action="{{ route('tokodashboard') }}" method="GET">
          <div style="position: relative;">
            <input type="text"
                  name="search"
                  class="form-control"
                  placeholder="Cari Produk"
                  style="height: 50px; padding-right: 40px; border-radius: 50px; border: 1px solid #cfd8dc; background-color: white; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);">
            <i class="bi bi-search"
              style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #c2185b;"></i>
          </div>
    </form>


    <!-- Menu Navigasi -->
    <div class="d-none d-lg-block me-4">
      <ul class="navbar-nav flex-row gap-3">
        <li class="nav-item"><a class="nav-link text-primary fw-semibold" href="{{ route('tokodashboard') }}">Beranda</a></li>
        <li class="nav-item"><a class="nav-link text-primary fw-semibold" href="{{ route('katalog') }}">Katalog Produk</a></li>
        <li class="nav-item"><a class="nav-link text-primary fw-semibold" href="{{ route('faq') }}">FAQ</a></li>
        <li class="nav-item"><a class="nav-link text-primary fw-semibold" href="{{ route('lacak') }}">Lacak Pesanan</a></li>
        <li class="nav-item"><a class="nav-link text-primary fw-semibold" href="{{ route('kontak') }}">Kontak Kami</a></li>
      </ul>
    </div>

    <!-- Icons -->
    <div class="d-flex align-items-center gap-3" style="margin-right: 40px;">
      <!-- <a href="#" class="text-muted fs-5"><i class="bi bi-bell"></i></a>
      <a href="#" class="text-muted fs-5"><i class="bi bi-envelope"></i></a>
      <a href="#" class="text-muted fs-5"><i class="bi bi-heart"></i></a> -->
      <img src="https://i.pravatar.cc/40" alt="Profile" class="rounded-circle" width="40" height="40">
    </div>

  </div>
</nav>



    <!-- Content -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

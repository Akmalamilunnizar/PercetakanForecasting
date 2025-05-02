<!DOCTYPE html>
<html class="no-js" lang="en">


<head>
  <meta charset="utf-8" />

  <title>CIME | Website Percetakan</title>
  <meta name="description" content="A SaaS landing page template." />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('dashboard2/assets/img/icons/logocime.png') }}" type="image/png" />

  <!-- CSS Files -->
  <link rel="stylesheet" href="{{ asset('css/animate.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/tiny-slider.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/glightbox.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="https://cdn.lineicons.com/3.0/lineicons.css">

  <!-- Link CSS Bootstrap -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

  <!-- Script JS Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

  <div class="preloader">
    <div class="loader">
      <div class="spinner">
        <div class="spinner-container">
          <div class="spinner-rotator">
            <div class="spinner-left">
              <div class="spinner-circle"></div>
            </div>
            <div class="spinner-right">
              <div class="spinner-circle"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <header class="header-area">
    <div class="navbar-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg">
              <a class="navbar-brand" href="{{ url('/') }}" style="margin-left: 25px;">
                <img src="{{ asset('dashboard2/assets/img/icons/logocime.png') }}" alt="Logo" />
              </a>

              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="toggler-icon"> </span>
                <span class="toggler-icon"> </span>
                <span class="toggler-icon"> </span>
              </button>
              <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                <ul id="nav" class="navbar-nav ms-auto">
                  <li class="nav-item">
                    <a class="page-scroll active" href="#home">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="page-scroll active" href="#catalog">Catalog</a>
                  </li>
                  <li class="nav-item">
                    <a class="page-scroll" href="#features">Features</a>
                  </li>
                  <li class="nav-item">
                    <a class="page-scroll" href="#about">About</a>
                  </li>
                  <li class="nav-item">
                    <a class="page-scroll" href="#facts">Why</a>
                  </li>
                  
                </ul>
              </div>

              <a href="{{ url('/login')}}" class="main-btn wow fadeInUp" data-wow-duration="1s"
                style="margin-right: 10px;">
                Login
              </a>
              <div class="navbar-btn d-none d-sm-inline-block">
                <a href="{{ url('/register')}}" class="main-btn wow fadeInUp" data-wow-duration="1s">
                  Register
                </a>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div id="home" class="header-hero bg_cover" style="background-image: url(assets/images/header/headerr222.svg)">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-10">
            <div class="header-hero-content text-center">
              <h2 class="header-title wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.5s"
                style="font-size: 35px;">
                Optimasi Manajemen Stok di Industri Percetakan Menggunakan Prediksi Penjualan
              </h2>
              <p class="text wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.8s" style="font-size: 20px;">
              Sistem prediksi penjualan untuk mengoptimalkan pengelolaan stok bahan di industri percetakan  
              </p>
            </div>

          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="header-hero-image text-center wow fadeIn" data-wow-duration="1.3s" data-wow-delay="1.4s">
              <img src="{{ asset('dashboard2/assets/img/imgtoko/print2.png') }}" alt="print" />
            </div>

          </div>
        </div>

      </div>

      <div id="particles-1" class="particles"></div>
    </div>

  </header>

  <section id="catalog" class="about-area pt-120">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="section-title text-center pb-40">
          <div class="line m-auto"></div>
          <h3 class="title">
            Katalog <span> Produk</span>
          </h3>
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-end mb-3">
      <a href="{{ route('tokodashboard') }}" class="btn btn-sm" style="color: #4318FF; font-size: 20px;">
        Lihat Semua
      </a>
    </div>

    <div class="position-relative">
      {{-- Tombol Panah --}}
      <button id="prev" class="position-absolute" style="left: -30px; top: 45%; z-index: 10; background: none; border: none; font-size: 2rem; color: #4318FF;">&#8249;</button>
      <button id="next" class="position-absolute" style="right: -30px; top: 45%; z-index: 10; background: none; border: none; font-size: 2rem; color: #4318FF;">&#8250;</button>

      {{-- Carousel --}}
      <div id="carousel" class="d-flex overflow-hidden" style="gap: 20px; scroll-behavior: smooth; max-width: 100%;">
        @foreach ($produk->take(7) as $item)
          <div class="card shadow-sm border-0 p-3 flex-shrink-0"
               style="min-width: 310px; max-width: 320px; background-color: #ffffff; border-radius: 15px;">
            <img src="{{ asset('dashboard2/assets/img/imgtoko/banner.jpg') }}" class="img-fluid mb-3"
                 style="height: 200px; width: 100%; object-fit: cover; border-radius: 12px;" alt="Product Image">
            <h5 class="fw-bold" style="color: #2B3674;">{{ $item->NamaProduk }}</h5>
            <p class="text-muted mb-1">Digital Printing</p>
            <div class="d-flex justify-content-between align-items-center mt-2">
              <span class="fw-bold" style="color: #4318FF;">Rp {{ number_format($item->HargaProduk, 0, ',', '.') }}</span>
              <a href="#" class="btn btn-sm" style="background-color: #1D1E94; color: white; border-radius: 20px; padding: 5px 15px;">Pesan</a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>


  <section id="features" class="services-area pt-120">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="section-title text-center pb-40">
          <div class="line m-auto"></div>
          <h3 class="title">
            Keunggulan Utama <span> dari Sistem CIME - Citra Media</span>
          </h3>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <!-- Pemesanan Online yang Praktis -->
      <div class="col-lg-2 col-md-4 col-sm-6"> <!-- Ubah dari col-lg-3 menjadi col-lg-2 untuk 5 kolom -->
        <div class="single-services text-center mt-30 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
          <div class="services-icon">
            <img class="shape" src="{{ asset('assets/images/services/services-shape.svg') }}" alt="shape" />
            <img class="shape-1" src="{{ asset('assets/images/services/services-shape-1.svg') }}" alt="shape" />
            <i class="lni lni-cart"></i>
          </div>
          <div class="services-content mt-30">
            <h4 class="services-title"style="font-size: 19px;">Pemesanan Online yang Praktis</h4>
            <p class="text" style="font-size: 16px;">Pelanggan dapat memesan produk percetakan kapan saja dan di mana saja melalui website</p>
          </div>
        </div>
      </div>

      <!-- Katalog Produk Lengkap & Terupdate -->
      <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="single-services text-center mt-30 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
          <div class="services-icon">
            <img class="shape" src="{{ asset('assets/images/services/services-shape.svg') }}" alt="shape" />
            <img class="shape-1" src="{{ asset('assets/images/services/services-shape-2.svg') }}" alt="shape" />
            <i class="lni lni-package"></i>
          </div>
          <div class="services-content mt-30">
            <h4 class="services-title"style="font-size: 19px;">Katalog Produk Lengkap & Terupdate</h4>
            <p class="text"style="font-size: 16px;">Menampilkan berbagai produk percetakan dengan informasi harga dan deskripsi yang jelas.</p>
          </div>
        </div>
      </div>

      <!-- Status Pesanan Real-time -->
      <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="single-services text-center mt-30 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.8s">
          <div class="services-icon">
            <img class="shape" src="{{ asset('assets/images/services/services-shape.svg') }}" alt="shape" />
            <img class="shape-1" src="{{ asset('assets/images/services/services-shape-3.svg') }}" alt="shape" />
            <i class="lni lni-checkmark-circle"></i>
          </div>
          <div class="services-content mt-30">
            <h4 class="services-title" style="font-size: 19px;">Status Pesanan Real-time</h4>
            <p class="text" style="font-size: 16px;">Pelanggan bisa memantau status pesanan secara langsung, mulai dari proses desain hingga cetak dan pengiriman</p>
          </div>
        </div>
      </div>

      <!-- Manajemen Admin yang Efisien -->
      <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="single-services text-center mt-30 wow fadeIn" data-wow-duration="1s" data-wow-delay="1.1s">
          <div class="services-icon">
            <img class="shape" src="{{ asset('assets/images/services/services-shape.svg') }}" alt="shape" />
            <img class="shape-1" src="{{ asset('assets/images/services/services-shape-3.svg') }}" alt="shape" />
            <i class="lni lni-cog"></i>
          </div>
          <div class="services-content mt-30">
            <h4 class="services-title" style="font-size: 19px;">Manajemen Admin yang Efisien</h4>
            <p class="text" style="font-size: 16px;">Admin dapat dengan mudah mengelola pesanan, produk, stok, dan data pelanggan</p>
          </div>
        </div>
      </div>

      <!-- Antarmuka Ramah Pengguna -->
      <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="single-services text-center mt-30 wow fadeIn" data-wow-duration="1s" data-wow-delay="1.4s">
          <div class="services-icon">
            <img class="shape" src="{{ asset('assets/images/services/services-shape.svg') }}" alt="shape" />
            <img class="shape-1" src="{{ asset('assets/images/services/services-shape-2.svg') }}" alt="shape" />
            <i class="lni lni-android"></i>
          </div>
          <div class="services-content mt-30">
            <h4 class="services-title" style="font-size: 19px;">Antarmuka Ramah Pengguna</h4>
            <p class="text" style="font-size: 16px;">Tampilan sistem yang responsif dan mudah digunakan dapat memudahkan semua kalangan pelanggan</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



  <section id="about">
    <div class="about-area pt-70">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="about-content mt-50 wow fadeInLeftBig" data-wow-duration="1s" data-wow-delay="0.5s">
              <div class="section-title">
                <div class="line"></div>
                <h3 class="title">
                  Mengenal Sistem Cerdas <span>Pengelolaan Pesanan dan Produksi Percetakan Berbasis Digital</span>
                </h3>
              </div>
              <p class="text">
              Sistem Cerdas Pengelolaan Pesanan dan Produksi Percetakan Berbasis Digital adalah sistem yang mengintegrasikan 
              teknologi untuk mengelola dan memonitor pesanan serta proses produksi percetakan secara otomatis. 
              Sistem ini dapat mengoptimalkan alur kerja dari pemesanan produk percetakan, pengaturan jadwal produksi,
               hingga pengiriman, dengan pemantauan status pesanan secara real-time. Selain itu, sistem ini juga memberikan 
               peringatan jika ada masalah atau keterlambatan dalam produksi, serta memungkinkan pengaturan stok dan bahan baku secara efisien.
              </p>
              <!-- Tombol untuk membuka modal -->
              <a href="#" class="main-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">Selengkapnya</a>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="about-image text-center mt-50 wow fadeInRightBig" data-wow-duration="1s" data-wow-delay="0.5s">
              <img src="{{ asset('assets/images/about/about1.svg') }}" alt="about" />
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Informasi Lengkap</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Tambahkan konten lengkap di sini -->
            Intellegence System Kontrol Kualitas Air Pada Kolam Ikan Koi Berbasis IoT adalah sistem yang memanfaatkan
            teknologi Internet of Things (IoT) untuk mengontrol serta memonitor dan mengendalikan kualitas air secara
            otomatis di kolam ikan koi. Sistem ini dapat mengukur parameter seperti suhu, pH, kadar oksigen, dan tingkat
            kekeruhan air secara real-time, serta memberikan peringatan atau melakukan tindakan otomatis untuk menjaga
            kondisi ideal bagi ikan koi. Dengan fitur ini, pengguna dapat lebih mudah mengelola kualitas air dan
            kesehatan ikan koi mereka.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>

    <div class="about-shape-1">
      <img src="{{ asset('assets/images/about/about-shape-1.svg') }}" alt="shape" />
    </div>
    </div>


    <div class="about-area pt-70">
      <div class="about-shape-2">
        <img src="{{ asset('assets/images/about/about-shape-2.svg') }}" alt="shape" />
      </div>
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 order-lg-last">
            <div class="about-content ms-lg-auto mt-50 wow fadeInLeftBig" data-wow-duration="1s" data-wow-delay="0.5s">
              <div class="section-title">
                <div class="line"></div>
                <h3 class="title">
                  Lokasi Kami <span> - The Genks Koi 99 Farm (Sentral Ikan Koi)</span>
                </h3>
              </div>

              <p class="text">
                The GenKs Koi 99 Farm terletak di lokasi yang mudah diakses dan menjadi pusat budidaya
                serta penjualan ikan koi berkualitas unggul dengan berbagai jenis dan ukuran. Kami berfokus pada
                memberikan layanan terbaik bagi para penghobi koi, termasuk konsultasi mengenai perawatan ikan dan
                pengelolaan kolam. Dengan demikian, pelanggan dapat merasakan pengalaman optimal dalam merawat dan
                menikmati keindahan koi mereka
                <br><br>
                Gumuksari, Tegal Besar, Kaliwates, Jember Regency, East Java 68131, Indonesia
                Kabupaten Jember, Jawa Timur, 68131
              </p>
              <a href="https://maps.app.goo.gl/DuKjA14h9GYk25sM7" target="_blank" class="main-btn">Temukan Lokasi
                Kami</a>

            </div>

          </div>
          <div class="col-lg-6 order-lg-first">
            <div class="about-image text-center mt-50 wow fadeInRightBig" data-wow-duration="1s" data-wow-delay="0.5s">
              <img src="{{ asset('assets/images/about/genksKoi.svg') }}" alt="about" />
            </div>

          </div>
        </div>

      </div>

    </div>


    <div class="about-area pt-70">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="about-content mt-50 wow fadeInLeftBig" data-wow-duration="1s" data-wow-delay="0.5s">
              <div class="section-title">
                <div class="line"></div>
                <h3 class="title">
                  <span>Mobile Dirancang untuk</span> Monitoring Kualitas Air Ikan Koi
                </h3>
              </div>

              <p class="text">
                Aplikasi mobile ini dirancang khusus untuk membantu Anda memantau kualitas air di kolam ikan koi Anda
                dengan mudah.
                Anda dapat memeriksa parameter penting seperti pH, suhu, oksigen, amonia, dan lainnya secara real-time,
                sehingga Anda selalu dapat memastikan kesehatan ikan koi Anda.
                Memberikan kemudahan akses informasi langsung di perangkat Anda.

              </p>
              <a href="javascript:void(0)" class="main-btn">Unduh Aplikasi</a>
            </div>

          </div>
          <div class="col-lg-6">
            <div class="about-image text-center mt-50 wow fadeInRightBig" data-wow-duration="1s" data-wow-delay="0.5s">
              <img src="{{ asset('assets/images/about/handphone2.svg') }}" alt="about" />
            </div>

          </div>
        </div>

      </div>

      <div class="about-shape-1">
        <img src="{{ asset('assets/images/about/about-shape-1.svg') }}" alt="shape" />
      </div>
    </div>

  </section>

  <section id="facts" class="video-counter pt-70">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 order-lg-last">
          <div class="counter-wrapper mt-50 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.8s">
            <div class="counter-content">
              <div class="section-title">
                <div class="line"></div>
                <h3 class="title">Tonton Video Tutorial <span> tentang Sistem Informasi ini</span></h3>

              </div>

              <p class="text">
                Dengan Sistem Informasi SANKE, Anda dapat mengakses video tutorial yang menjelaskan cara
                menggunakan fitur monitoring kualitas air untuk ikan koi. Pelajari cara mengatur kran
                kolam otomatis dan memantau parameter penting seperti pH, suhu, dan amonia secara efektif.
              </p>
            </div>

            <div class="row no-gutters">
              <div class="col-4">
                <div class="
                      single-counter
                      counter-color-1
                      d-flex
                      align-items-center
                      justify-content-center
                    ">
                  <div class="counter-items text-center">
                    <span class="count countup text-uppercase" cup-end="125"></span>

                  </div>
                </div>

              </div>
              <div class="col-4">
                <div class="
                      single-counter
                      counter-color-2
                      d-flex
                      align-items-center
                      justify-content-center
                    ">
                  <div class="counter-items text-center">
                    <span class="count countup text-uppercase" cup-end="87"></span>
                    <p class="text">Active Users</p>
                  </div>
                </div>

              </div>
              <div class="col-4">
                <div class="
                      single-counter
                      counter-color-3
                      d-flex
                      align-items-center
                      justify-content-center
                    ">
                  <div class="counter-items text-center">
                    <span class="count countup text-uppercase" cup-end="59"></span>
                    <p class="text">User Rating</p>
                  </div>
                </div>

              </div>
            </div>

          </div>

        </div>
        <div class="col-lg-6">
          <div class="video-content mt-50 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
            <img class="dots" src="{{ asset('assets/images/video/dots.svg') }}" alt="dots" />
            <div class="video-wrapper">
              <div class="video-image">
                <img src="{{ asset('assets/images/video/video.png') }}" alt="video" />
              </div>
              <div class="video-icon">
                <a href="https://www.youtube.com/watch?v=r44RKWyfcFw" class="video-popup glightbox">
                  <i class="fas fa-play"> </i>
                </a>
              </div>
            </div>

          </div>

        </div>
      </div>

    </div>

  </section>

  <footer id="footer" class="footer-area pt-100">
    <div class="container">
      <div class="subscribe-area wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
        <div class="row">
          <div class="col-lg-6">
            <div class="subscribe-content mt-45">

            </div>
          </div>
          <div class="col-lg-6">
            <div class="subscribe-form mt-45">

            </div>
          </div>
        </div>

      </div>

      <div class="footer-widget pb-100">
        <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-8">
            <div class="footer-about mt-50 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
              <a class="logo" href="javascript:void(0)">
                <img src="{{ asset('dashboard2/assets/img/icons/logocime.png') }}}" alt="logo" />
              </a>
              <p class="text">
                The Genks Koi 99 Farm adalah komunitas pencinta koi di Jember yang berdiri pada
                tanggal 10 Oktober 2019. Komunitas ini terdiri dari lima anggota dan memiliki kemitraan
                dengan petani di wilayah Jember. The Genks Koi 99 Farm bertujuan untuk memajukan dunia perkoian di
                Jember.
              </p>
              <ul class="social">
                <li>
                  <a href="https://www.instagram.com/genks.the/">
                    <i class="lni lni-facebook-filled"> </i>
                  </a>
                </li>
                <li>
                  <a href="https://www.instagram.com/genks.the/">
                    <i class="lni lni-twitter-filled"> </i>
                  </a>
                </li>
                <li>
                  <a href="https://www.instagram.com/genks.the/">
                    <i class="lni lni-instagram-filled"> </i>
                  </a>
                </li>
                <li>
                  <a href="https://www.instagram.com/genks.the/">
                    <i class="lni lni-linkedin-original"> </i>
                  </a>
                </li>
              </ul>
            </div>

          </div>

          <div class="col-lg-3 col-md-5 col-sm-12">
            <div class="footer-contact mt-50 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.8s">
              <div class="footer-title">
                <h4 class="title">Contact Us</h4>
              </div>
              <ul class="contact">
                <li>0811-3662-488</li>
                <li>
                <li>genkskoi99@gmail.com</li>
                <li>www.genks99.com</li>
                <li>
                  Gumuksari, Tegal Besar, Kec. Kaliwates,<br />
                  Kabupaten Jember, Jawa Timur 68131
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="footer-copyright">
        <div class="row">
          <div class="col-lg-12">
            <div class="copyright d-sm-flex justify-content-between">
              <div class="copyright-content">
                <p class="text">
                  The Genk's Koi 99 Farm |
                  <a href="" rel="nofollow">Kabupaten Jember</a>
                </p>
              </div>

            </div>

          </div>
        </div>

      </div>

    </div>

    <div id="particles-2"></div>
  </footer>


  <a href="#" class="back-to-top"> <i class="lni lni-chevron-up"> </i> </a>


  <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/wow.min.js') }}"></script>
  <script src="{{ asset('js/glightbox.min.js') }}"></script>
  <script src="{{ asset('js/tiny-slider.js') }}"></script>
  <script src="{{ asset('js/count-up.min.js') }}"></script>
  <script src="{{ asset('js/particles.min.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  <script>
    (function () {
      function c() {
        var b = a.contentDocument || a.contentWindow.document;
        if (b) {
          var d = b.createElement('script');
          d.innerHTML = "window.__CF$cv$params={r:'8d17ebe3beab5fe5',t:'MTcyODc0NDgyOC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/js/maind41d.js';document.getElementsByTagName('head')[0].appendChild(a);";
          b.getElementsByTagName('head')[0].appendChild(d);
        }
      }
      if (document.body) {
        var a = document.createElement('iframe');
        a.height = 1;
        a.width = 1;
        a.style.position = 'absolute';
        a.style.top = 0;
        a.style.left = 0;
        a.style.border = 'none';
        a.style.visibility = 'hidden';
        document.body.appendChild(a);
        if ('loading' !== document.readyState) c();
        else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c);
        else {
          var e = document.onreadystatechange || function () { };
          document.onreadystatechange = function (b) {
            e(b);
            'loading' !== document.readyState && (document.onreadystatechange = e, c());
          };
        }
      }
    })();
  </script>
  <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"
    integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ=="
    data-cf-beacon='{"rayId":"8d17ebe3beab5fe5","version":"2024.10.1","r":1,"serverTiming":{"name":{"cfExtPri":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"token":"9a6015d415bb4773a0bff22543062d3b","b":1}'
    crossorigin="anonymous"></script>
  <script src="{{ asset('js/maind41d.js') }}"></script>

  <script>
  const carousel = document.getElementById('carousel');
  const nextBtn = document.getElementById('next');
  const prevBtn = document.getElementById('prev');

  const cardWidth = 320; // 300 + gap/margin
  let scrollDirection = 1;

  // Manual controls
  nextBtn.addEventListener('click', () => {
    carousel.scrollBy({ left: cardWidth, behavior: 'smooth' });
  });

  prevBtn.addEventListener('click', () => {
    carousel.scrollBy({ left: -cardWidth, behavior: 'smooth' });
  });

  // Auto scroll bolak-balik setiap 0.3 detik
  setInterval(() => {
    const maxScrollLeft = carousel.scrollWidth - carousel.clientWidth;

    if (carousel.scrollLeft >= maxScrollLeft) {
      scrollDirection = -1;
    } else if (carousel.scrollLeft <= 0) {
      scrollDirection = 1;
    }

    carousel.scrollBy({ left: scrollDirection * cardWidth, behavior: 'smooth' });
  }, 5000);
</script>


</body>

</html>

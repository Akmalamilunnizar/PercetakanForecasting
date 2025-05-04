@extends('toko.layouts.template')

@section('page_title')
    CIME | Dashboard Toko Online
@endsection

@section('js')
    <script src="{{ asset('assets/apexcharts/dist/apexcharts.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/apexcharts/dist/apexcharts.css') }}" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('dashboard2/assets/img/icons/logocime.png') }}" type="image/png" />

    {{--
    <link rel="stylesheet" href="{{ URL::asset('assets/apexcharts/dist/apexcharts.css') }}"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.35.0/dist/apexcharts.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.41.0/apexcharts.min.js"
        integrity="sha512-bp/xZXR0Wn5q5TgPtz7EbgZlRrIU3tsqoROPe9sLwdY6Z+0p6XRzr7/JzqQUfTSD3rWanL6WUVW7peD4zSY/vQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.41.0/apexcharts.min.css"
        integrity="sha512-5k2n0KtbytaKmxjJVf3we8oDR34XEaWP2pibUtul47dDvz+BGAhoktxn7SJRQCHNT5aJXlxzVd45BxMDlCgtcA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ URL('assets/apexcharts/dist/apexcharts.min.js') }}"></script> 
    --}}

    <link href="css/toko.css" rel="stylesheet">
@endsection

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Container Tambahan dengan Background Ungu -->
        <div class="container-fluid py-3"
            style="background-image: url('{{ asset('dashboard2/assets/img/imgtoko/backgroundimg2.png') }}');
                   background-size: cover;
                   background-position: center;
                   color: white;
                   min-height: 280px;
                   border-radius: 15px;">
            <!-- Konten di sini -->
        </div>

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12 mb-12 order-0 mb-4">
                    <div class="card">
                        <div class="d-flex align-items-center row">
                            <!-- Logo di kiri -->
                            <div class="col-sm-5 text-center text-sm-left">
                                <!-- Kosong -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- / Content -->

    <!-- Section: Product Terlaris -->
    <div class="container mt-4">
        <h3 class="mb-4 fw-bold" style="color: #2B3674; font-size: 23px;">Product Terlaris</h3>
        <div class="row">

            <!-- Produk 1 -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 p-4" style="background-color: #ffffff; border-radius: 15px;">
                    <img src="{{ asset('dashboard2/assets/img/imgtoko/certificate.jpg') }}" class="img-fluid" alt="Print Banner"
                    style="height: 280px; width: 100%; object-fit: cover; border-radius: 15px;">
                    <div class="card-body" style="padding: 15px;">
                        <h5 class="fw-bold mb-1" style="color: #2B3674;">Sertifikat</h5>
                        <p class="text-muted mb-2">Digital Printing</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="fw-bold" style="color: #4318FF;">Rp 5.000</span>
                            <a href="#" class="btn" style="background-color: #1D1E94; color: white; border-radius: 30px; padding: 5px 20px;">Pesan</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Produk 2 -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 p-4" style="background-color: #ffffff; border-radius: 15px;">
                    <img src="{{ asset('dashboard2/assets/img/imgtoko/calender2.jpg') }}" class="img-fluid" alt="Print Banner"
                    style="height: 280px; width: 100%; object-fit: cover; border-radius: 15px;">
                    <div class="card-body" style="padding: 15px;">
                        <h5 class="fw-bold mb-1" style="color: #2B3674;">Kalender Dinding</h5>
                        <p class="text-muted mb-2">Digital Printing</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="fw-bold" style="color: #4318FF;">Rp 28.000</span>
                            <a href="#" class="btn" style="background-color: #1D1E94; color: white; border-radius: 30px; padding: 5px 20px;">Pesan</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Produk 3 -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 p-4" style="background-color: #ffffff; border-radius: 15px;">
                    <img src="{{ asset('dashboard2/assets/img/imgtoko/calender3.jpg') }}" class="img-fluid" alt="Print Banner"
                    style="height: 280px; width: 100%; object-fit: cover; border-radius: 15px;">
                    <div class="card-body" style="padding: 15px;">
                        <h5 class="fw-bold mb-1" style="color: #2B3674;">Kalender Meja</h5>
                        <p class="text-muted mb-2">Digital Printing</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="fw-bold" style="color: #4318FF;">Rp 25.000</span>
                            <a href="#" class="btn" style="background-color: #1D1E94; color: white; border-radius: 30px; padding: 5px 20px;">Pesan</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Section: Semua Product -->
    <div class="container mt-4">
        <h3 class="mb-4 fw-bold" style="color: #2B3674; font-size: 23px;">Semua Product</h3>
        <div class="row">
        @foreach ($produk as $item)
            <!-- Produk  -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 p-4" style="background-color: #ffffff; border-radius: 15px;">
                <img src="{{ asset('storage/' . $item->Img) }}" class="img-fluid" alt="Foto Produk"
                    style="height: 280px; width: 100%; object-fit: cover; border-radius: 15px;">
                    <div class="card-body" style="padding: 15px;">
                        <h5 class="fw-bold mb-1" style="color: #2B3674;">{{$item->NamaProduk}}</h5>
                        <p class="text-muted mb-2">Digital Printing</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="fw-bold" style="color: #4318FF;">Rp {{number_format($item->HargaProduk, 0, ',', '.')}}</span>
                            <a href="#" class="btn" style="background-color: #1D1E94; color: white; border-radius: 30px; padding: 5px 20px;">Pesan</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
           
        </div>
    </div>
@endsection

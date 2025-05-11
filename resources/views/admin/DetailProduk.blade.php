@extends('admin.layouts.template')
@section('page_title')
    SANKE | Halaman detail produk Admin
@endsection

@section('search')
    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            <form method="GET" action="{{ route('searchusers') }}" class="d-inline-block ms-2">
                <input type="text" name="search" class="form-control border-0 shadow-none ps-2"
                    placeholder="Pencarian ID atau nama..." value="{{ isset($search) ? $search : '' }}" />
            </form>
        </div>
    </div>
@endsection

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
</head>
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y" style="overflow-x: auto;">
            <div class="row">
                <div class="col-md-6">
                    <div class="product-image-container">
                        <img src="{{ asset('storage/' . $produk->Img) }}" alt="{{ $produk->NamaProduk }}"
                            class="product-image" id="main-image">
                    </div>
                    <div class="thumbnail-scroll-wrapper mt-3" id="thumbnailScrollWrapper">
                        <div class="thumbnail-scroll" id="thumbnail-scroll">
                            @foreach (['banner.jpg', 'banner.jpg', 'banner.jpg', 'banner.jpg', 'banner.jpg', 'banner.jpg',  'banner.jpg', 'banner.jpg', 'banner.jpg',] as $img)
                                <a href="#">
                                    <div class="img-thumb-wrapper" style="margin-right: 5px;">
                                        <img src="{{ asset('assets/images/' . $img) }}" alt="Gambar"
                                            class="img-fluid img-thumb">
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="d-flex align-items-center">
                            <h5><b>Pilih Rating</b></h5>
                            <div class="ms-3">
                                <span class="star-filter" data-rating="1"
                                    style="cursor: pointer; font-size: 1.5em; color: #ccc; transition: color 0.2s ease;"
                                    onclick="highlightStars(this)">&#9733;</span>
                                <span class="star-filter" data-rating="2"
                                    style="cursor: pointer; font-size: 1.5em; color: #ccc; transition: color 0.2s ease;"
                                    onclick="highlightStars(this)">&#9733;</span>
                                <span class="star-filter" data-rating="3"
                                    style="cursor: pointer; font-size: 1.5em; color: #ccc; transition: color 0.2s ease;"
                                    onclick="highlightStars(this)">&#9733;</span>
                                <span class="star-filter" data-rating="4"
                                    style="cursor: pointer; font-size: 1.5em; color: #ccc; transition: color 0.2s ease;"
                                    onclick="highlightStars(this)">&#9733;</span>
                                <span class="star-filter" data-rating="5"
                                    style="cursor: pointer; font-size: 1.5em; color: #ccc; transition: color 0.2s ease;"
                                    onclick="highlightStars(this)">&#9733;</span>
                            </div>
                        </div>
                        <div class="review-summary mt-3 d-flex align-items-start">
                            <div class="left-column me-3">
                                <div class="overall-rating">
                                    <span class="star">&#9733;</span>
                                    <span class="rating-value">5.0</span> <span class="out-of">/ 5.0</span>
                                </div>
                                <div class="satisfaction">
                                    <span>100%</span> pembeli merasa puas
                                </div>
                                <div class="rating-count">
                                    <span>9</span> rating, <span>3</span> ulasan
                                </div>
                            </div>
                            <div class="right-column d-flex">
                                <div class="rating-bars-left">
                                    <div class="rating-bar">
                                        <span class="star">&#9733;</span> 5
                                        <div class="bar-container">
                                            <div class="bar" style="width: 100%; background-color:rgb(0, 151, 50);"></div>
                                        </div>
                                        <span class="count">(5)</span>
                                    </div>
                                    <div class="rating-bar">
                                        <span class="star">&#9733;</span> 4
                                        <div class="bar-container">
                                            <div class="bar" style="width: 0%; background-color: #6c757d;"></div>
                                        </div>
                                        <span class="count">(0)</span>
                                    </div>
                                    <div class="rating-bar">
                                        <span class="star">&#9733;</span> 3
                                        <div class="bar-container">
                                            <div class="bar" style="width: 0%; background-color: #6c757d;"></div>
                                        </div>
                                        <span class="count">(0)</span>
                                    </div>
                                </div>
                                <div class="rating-bars-right ms-auto">
                                    <div class="rating-bar">
                                        <span class="star">&#9733;</span> 2
                                        <div class="bar-container">
                                            <div class="bar" style="width: 0%; background-color: #ffc107;"></div>
                                        </div>
                                        <span class="count">(2)</span>
                                    </div>
                                    <div class="rating-bar">
                                        <span class="star">&#9733;</span> 1
                                        <div class="bar-container">
                                            <div class="bar" style="width: 0%; background-color: #dc3545;"></div>
                                        </div>
                                        <span class="count">(2)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="user-reviews mt-3">
                            <div class="user-review">
                                <div class="user-info d-flex align-items-center mb-2">
                                    <img src="{{ asset('assets/images/orang1.jpeg') }}" alt="Foto Profil Sayiful Adham"
                                        class="rounded-circle me-2" style="width: 30px; height: 30px; object-fit: cover;">
                                    <div class="user-details">
                                        <span class="fw-bold">Sayiful Adham Gaming</span>
                                        <div class="rating-stars">
                                            <span class="star" style="color: gold;">&#9733;</span>
                                            <span class="star" style="color: gold;">&#9733;</span>
                                            <span class="star" style="color: gold;">&#9733;</span>
                                            <span class="star" style="color: gold;">&#9733;</span>
                                            <span class="star" style="color: gold;">&#9733;</span>
                                        </div>
                                    </div>
                                    <small class="ms-auto text-muted">2 Hari yang lalu</small>
                                </div>
                                <div class="review-images mb-2">
                                    <a href="{{ asset('assets/images/poster1.jpeg') }}" data-lightbox="review-1">
                                        <img src="{{ asset('assets/images/poster1.jpeg') }}" style="margin-right: 10px;"
                                            alt="Gambar Ulasan 1" ...>
                                    </a>
                                    <a href="{{ asset('assets/images/poster2.jpg') }}" data-lightbox="review-1">
                                        <img src="{{ asset('assets/images/poster2.jpg') }}" style="margin-right: 10px;"
                                            alt="Gambar Ulasan 2" ...>
                                    </a>
                                    <a href="{{ asset('assets/images/poster3.webp') }}" data-lightbox="review-1">
                                        <img src="{{ asset('assets/images/poster3.webp') }}" style="margin-right: 10px;"
                                            alt="Gambar Ulasan 3" ...>
                                    </a>
                                </div>
                                <p class="review-text">merk masker ini sih uda affordable hrgnya, bahannya jg ga bikin engep
                                    makany
                                    sukak bgt.. semoga makin bny variant masker lg dr onerneda ya.. utk packaging
                                    aman bgt krn dil... <a href="#"
                                        style="color: blue; text-decoration: none;">Selengkapnya</a>
                                </p>
                                <hr class="my-2">
                            </div>

                            <div class="user-review">
                                <div class="user-info d-flex align-items-center mb-2">
                                    <img src="{{ asset('assets/images/orang2.jpeg') }}" alt="Foto Profil Adham Syaiful"
                                        class="rounded-circle me-2" style="width: 30px; height: 30px; object-fit: cover;">
                                    <div class="user-details">
                                        <span class="fw-bold">Adham Syaiful</span>
                                        <div class="rating-stars">
                                            <span class="star" style="color: gold;">&#9733;</span>
                                            <span class="star" style="color: gold;">&#9733;</span>
                                            <span class="star" style="color: gold;">&#9733;</span>
                                            <span class="star" style="color: gold;">&#9733;</span>
                                            <span class="star" style="color: #ccc;">&#9733;</span>
                                        </div>
                                    </div>
                                    <small class="ms-auto text-muted">2 Hari yang lalu</small>
                                </div>
                                <div class="review-images mb-2">
                                    <a href="{{ asset('assets/images/poster1.jpeg') }}" data-lightbox="review-1">
                                        <img src="{{ asset('assets/images/poster1.jpeg') }}" style="margin-right: 10px;"
                                            alt="Gambar Ulasan 1" ...>
                                    </a>
                                    <a href="{{ asset('assets/images/poster2.jpg') }}" data-lightbox="review-1">
                                        <img src="{{ asset('assets/images/poster2.jpg') }}" style="margin-right: 10px;"
                                            alt="Gambar Ulasan 2" ...>
                                    </a>
                                    <a href="{{ asset('assets/images/poster3.webp') }}" data-lightbox="review-1">
                                        <img src="{{ asset('assets/images/poster3.webp') }}" style="margin-right: 10px;"
                                            alt="Gambar Ulasan 3" ...>
                                    </a>
                                </div>
                                <p class="review-text">merk masker ini sih uda affordable hrgnya, bahannya jg ga bikin engep
                                    makany
                                    sukak bgt.. semoga makin bny variant masker lg dr onerneda ya.. utk packaging
                                    aman bgt krn dil... <a href="#"
                                        style="color: blue; text-decoration: none;">Selengkapnya</a>
                                </p>
                                <hr class="my-2">
                            </div>
                            <div class="user-review">
                                <div class="user-info d-flex align-items-center mb-2">
                                    <img src="{{ asset('assets/images/orang2.jpeg') }}" alt="Foto Profil Adham Syaiful"
                                        class="rounded-circle me-2" style="width: 30px; height: 30px; object-fit: cover;">
                                    <div class="user-details">
                                        <span class="fw-bold">Adham Syaiful</span>
                                        <div class="rating-stars">
                                            <span class="star" style="color: gold;">&#9733;</span>
                                            <span class="star" style="color: gold;">&#9733;</span>
                                            <span class="star" style="color: gold;">&#9733;</span>
                                            <span class="star" style="color: gold;">&#9733;</span>
                                            <span class="star" style="color: #ccc;">&#9733;</span>
                                        </div>
                                    </div>
                                    <small class="ms-auto text-muted">2 Hari yang lalu</small>
                                </div>
                                <div class="review-images mb-2">
                                    <a href="{{ asset('assets/images/poster1.jpeg') }}" data-lightbox="review-1">
                                        <img src="{{ asset('assets/images/poster1.jpeg') }}" style="margin-right: 10px;"
                                            alt="Gambar Ulasan 1" ...>
                                    </a>
                                    <a href="{{ asset('assets/images/poster2.jpg') }}" data-lightbox="review-1">
                                        <img src="{{ asset('assets/images/poster2.jpg') }}" style="margin-right: 10px;"
                                            alt="Gambar Ulasan 2" ...>
                                    </a>
                                    <a href="{{ asset('assets/images/poster3.webp') }}" data-lightbox="review-1">
                                        <img src="{{ asset('assets/images/poster3.webp') }}" style="margin-right: 10px;"
                                            alt="Gambar Ulasan 3" ...>
                                    </a>
                                </div>
                                <p class="review-text">merk masker ini sih uda affordable hrgnya, bahannya jg ga bikin engep
                                    makany
                                    sukak bgt.. semoga makin bny variant masker lg dr onerneda ya.. utk packaging
                                    aman bgt krn dil... <a href="#"
                                        style="color: blue; text-decoration: none;">Selengkapnya</a>
                                </p>
                                <hr class="my-2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
    </div>
@endsection


<style>
    .product-image-container {
        width: 100%;
        /* Mengisi lebar parent (misalnya, col-md-4) */
        height: 550px;
        /* Tinggi yang Anda inginkan (sesuaikan!) */
        overflow: hidden;
        /* Potong gambar jika melebihi container */
        display: flex;
        /* Untuk centering gambar */
        align-items: center;
        /* Vertikal center gambar */
        justify-content: center;
        /* Horizontal center gambar */
    }

    .product-image {
        width: 100%;
        /* Gambar mengisi lebar container */
        height: 100%;
        /* Gambar mengisi tinggi container */
        object-fit: cover;
        /* Penting: Gambar memotong agar mengisi */
        display: block;
        /* Pastikan gambar block-level */
        border-radius: 8px;
        /* Jika Anda ingin sudut bulat */
    }

    /*ukuran bintang di sebelah teks ulasan*/
    .star-filter {
        cursor: pointer;
        font-size: 2em;
        /* Atau ukuran lain yang Anda inginkan */
    }

    /* CSS Anda yang sudah ada */
    .jarakHarga {
        margin-top: 30px;
    }

    /*Fitur pemesanan*/
    .pemesanan-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, auto));
        gap: 15px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, auto));
        gap: 15px;
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 8px;
        margin-top: 20px;
        border: 1px solid #ced4da;
    }

    .form-label {
        font-size: 0.9em;
        color: #495057;
        margin-bottom: 5px;
        display: block;
    }

    .form-select,
    .form-control {
        font-size: 0.9em;
    }

    .input-group-text {
        font-size: 0.9em;
        border: 1px solid #ced4da;
    }

    .form-label {
        font-size: 0.9em;
        color: #495057;
        margin-bottom: 5px;
        display: block;
    }

    .form-select,
    .form-control {
        font-size: 0.9em;
    }

    .input-group-text {
        font-size: 0.9em;
    }

    .jumlah-container {
        margin-right: 20px;
    }

    .jumlah-container label {
        display: block;
        margin-bottom: 5px;
        font-size: 0.9em;
        color: #495057;
    }

    .input-jumlah {
        display: flex;
        align-items: center;
    }

    .btn-jumlah {
        background: none;
        border: 1px solid #ced4da;
        color: #495057;
        width: 30px;
        height: 30px;
        border-radius: 4px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        font-size: 1em;
        transition: background-color 0.2s ease;
    }

    .btn-jumlah:hover {
        background-color: #e9ecef;
    }

    .input-jumlah input[type="number"] {
        width: 50px;
        height: 30px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        text-align: center;
        margin: 0 5px;
        -moz-appearance: textfield;
        /* Firefox */
    }

    .input-jumlah input[type="number"]::-webkit-outer-spin-button,
    .input-jumlah input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .stok-total {
        display: block;
        margin-top: 5px;
        font-size: 0.8em;
        color: #6c757d;
    }

    .subtotal-container {
        margin-right: auto;
        /* Dorong tombol ke kanan */
        text-align: right;
    }

    .subtotal-label {
        font-size: 0.9em;
        color: #495057;
        margin-bottom: 3px;
    }

    .subtotal-harga {
        font-size: 1.2em;
        font-weight: bold;
        color: #212529;
    }

    .tombol-container {
        display: flex;
        gap: 10px;
    }

    .btn-keranjang {
        background-color: #6f42c1;
        /* Warna ungu mirip pada gambar */
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 0.9em;
        transition: background-color 0.2s ease;
    }

    .btn-keranjang:hover {
        background-color: #563d7c;
    }

    .btn-beli {
        background-color: #e0f7fa;
        /* Warna biru muda mirip pada gambar */
        color: #00bcd4;
        /* Warna teks biru tosca */
        border: 1px solid #00bcd4;
        padding: 10px 15px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 0.9em;
        transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease;
    }

    .btn-beli:hover {
        background-color: #b2ebf2;
        color: #008ba3;
        border-color: #008ba3;
    }

    /*--------------------------*/
    /* CSS Tambahan untuk Desain Pemesanan yang Lebih Menarik */
    .card {
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        margin-bottom: 15px;
    }

    .card-body {
        padding: 1.5rem;
        border: 1px solid #555;
        border-radius: 8px;
    }

    .form-label {
        font-size: 0.95rem;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .form-control,
    .form-select {
        font-size: 0.9rem;
        border-radius: 5px;
        border: 1px solid #ced4da;
    }

    .input-group-text {
        font-size: 0.9rem;
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
        border-radius: 5px;
    }

    .btn-outline-secondary {
        border-radius: 5px;
    }

    .card-title {
        font-size: 1.1rem;
        margin-bottom: 1rem;
    }

    .text-primary {
        font-size: 1.05rem;
    }

    .shadow-sm {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
    }
    /* CSS Tambahan untuk Desain Pemesanan yang Lebih Menarik */
    .card {
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        margin-bottom: 15px;
    }

    .card-body {
        padding: 1.5rem;
        border: 1px solid #555;
        border-radius: 8px;
    }

    .form-label {
        font-size: 0.95rem;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .form-control,
    .form-select {
        font-size: 0.9rem;
        border-radius: 5px;
        border: 1px solid #ced4da;
    }

    .input-group-text {
        font-size: 0.9rem;
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
        border-radius: 5px;
    }

    .btn-outline-secondary {
        border-radius: 5px;
    }

    .card-title {
        font-size: 1.1rem;
        margin-bottom: 1rem;
    }

    .text-primary {
        font-size: 1.05rem;
    }

    .shadow-sm {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
    }

    /*untuk button detail dan info penting*/
    .nav-link:hover {
        background-color: lightpurple;
        /* Warna latar belakang saat kursor diarahkan */
        color: black;
        /* Anda mungkin ingin mengubah warna teks agar tetap terlihat */
    }


    .img-outline {
        width: 100%;
        height: auto;
        border: 10px solid white;
        padding: 2px;
        border-radius: 15px;
        object-fit: contain;
    }

    .img-outline-thin {
        border-width: 3px !important;
        border-radius: 10px;
    }

    .img-thumb-wrapper {
        flex: 0 0 auto;
        width: 70px;
        height: 70px;
        border: 2px solid #ddd;
        border-radius: 8px;
        padding: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #fff;
        margin-left: 10px;
        cursor: pointer;
        /* Menambahkan indikasi bahwa elemen bisa diklik */
        transition: transform 0.3s ease-in-out;
        /* Animasi transisi */
        transform-origin: center center;
        /* Mengatur titik pusat transformasi */
    }

    .img-thumb-wrapper:hover {
        transform: scale(1.2);
        /* Skala 1.2 kali ukuran semula saat dihover */
    }

    .img-thumb {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .thumbnail-scroll-wrapper {
        overflow-x: hidden;
        /* Sembunyikan konten yang melebihi lebar */
        padding-bottom: 10px;

    }

    .thumbnail-scroll {
        display: flex;
        flex-wrap: nowrap;
        /* Hitung lebar maksimum untuk 9 thumbnail (lebar thumbnail + margin) */
        max-width: calc(9 * (70px + 5px));
        /* Contoh: 70px lebar thumb, 5px margin */
        margin-top: 10px;
    }

    /*rate ulasan pembeli*/
    .review-summary {
        padding: 15px;
        border: 1px solid #555;
        /* Garis outlane warna hitam*/
        border-radius: 8px;
        background-color: #f9f9f9;
    }

    .overall-rating {
        display: flex;
        align-items: center;
        margin-bottom: 5px;
        font-size: 1.2em;
    }

    .overall-rating .star {
        color: gold;
        margin-right: 5px;
    }

    .rating-value {
        font-weight: bold;
    }

    .out-of {
        color: #777;
    }

    .satisfaction {
        color: #28a745;
        margin-bottom: 5px;
        font-size: 0.9em;
    }

    .rating-count {
        color: #555;
        font-size: 0.9em;
        margin-bottom: 10px;
    }

    .rating-bars {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .rating-bar {
        display: flex;
        align-items: center;
        font-size: 0.9em;
        margin-right: 25px;
    }

    .rating-bar .star {
        color: gold;
        margin-right: 10px;
        font-size: 1em;
    }

    .rating-bar .bar-container {
        background-color: #ddd;
        border-radius: 5px;
        height: 8px;
        width: 100px;
        /* Sesuaikan lebar sesuai kebutuhan */
        margin-left: 10px;
        margin-right: 10px;
        overflow: hidden;
    }

    .rating-bar .bar {
        background-color: rgb(5, 122, 248);
        /* Warna bar */
        height: 100%;
        border-radius: 5px;
    }

    .rating-bar .count {
        color: #777;
        margin-left: 5px;
    }

    /* Style untuk Modal */
    .modal {
        display: none;
        /* Tersembunyi secara default */
        position: fixed;
        /* Tetap di posisinya meskipun di-scroll */
        z-index: 1;
        /* Lapisan di atas elemen lain */
        left: 0;
        top: 0;
        width: 100%;
        /* Lebar penuh layar */
        height: 100%;
        /* Tinggi penuh layar */
        overflow: auto;
        /* Aktifkan scroll jika konten modal melebihi layar */
        background-color: rgba(0, 0, 0, 0.4);
        /* Latar belakang semi-transparan */
        display: flex;
        /* Mengaktifkan flexbox untuk pemosisian anak elemen */
        justify-content: center;
        /* Membuat anak elemen berada di tengah horizontal */
        align-items: center;
        /* Membuat anak elemen berada di tengah vertikal */
    }

    /* Style untuk Konten Modal (kotak putih) */
    .modal-content {
        background-color: #fefefe;
        padding: 20px;
        border: 1px solid #888;
        border-radius: 8px;
        position: relative;
        /* Untuk memposisikan elemen di dalamnya */
        width: auto;
        /* Lebar menyesuaikan konten */
        max-width: 1000px;
        /* Lebar maksimum agar tidak terlalu lebar */
    }

    .modal-content .product-image {
        /* Lebih spesifik */
        max-width: 150px;
        /* Sesuaikan dengan lebar yang Anda inginkan */
        max-height: 150px;
        /* Sesuaikan dengan tinggi yang Anda inginkan */
        width: auto;
        /* Biarkan lebar menyesuaikan proporsi */
        height: auto;
        /* Biarkan tinggi menyesuaikan proporsi */
        object-fit: contain;
        /* Jaga proporsi gambar */
    }

    .modal-content #main-image {
        /* Jika Anda menggunakan ID */
        max-width: 100px;
        /* Sesuaikan dengan lebar yang Anda inginkan */
        max-height: 100px;
        /* Sesuaikan dengan tinggi yang Anda inginkan */
        width: auto;
        /* Biarkan lebar menyesuaikan proporsi */
        height: auto;
        /* Biarkan tinggi menyesuaikan proporsi */
        object-fit: contain;
        /* Jaga proporsi gambar */
    }

    .modal.show {
        display: flex !important;
    }


    .close-button {
        color: #aaa;
        font-size: 28px;
        font-weight: bold;
        position: absolute;
        /* Tambahkan properti position */
        top: 10px;
        /* Atur jarak dari atas */
        right: 15px;
        /* Atur jarak dari kanan */
        cursor: pointer;
        /* Tambahkan cursor agar terlihat bisa diklik */
    }

    .close-button:hover,
    .close-button:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-actions {
        margin-top: 20px;
        text-align: right;
        /* Atau left jika tombol ingin di kiri */
        display: flex;
        /* Agar tombol berdampingan */
        justify-content: flex-end;
        /* Atau flex-start jika tombol ingin di kiri */
        gap: 10px;
        /* Jarak antar tombol */
    }


    .modal-actions button {
        /* Style untuk tombol (warna, padding, dll. bisa disesuaikan) */
    }

    /* Style untuk Konfirmasi Pembelian yang Baru */
    .konfirmasi-detail {
        margin-top: 20px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
    }

    .konfirmasi-produk {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .produk-thumbnail {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 6px;
        margin-right: 15px;
        border: 1px solid #eee;
    }

    .produk-info {
        flex-grow: 1;
    }

    .produk-nama {
        font-size: 1.1em;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }

    .konfirmasi-harga {
        margin-top: 10px;
    }

    .harga-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 0.95em;
        color: #555;
    }

    .harga-item.total {
        font-weight: bold;
        color: #28a745;
        /* Or any other prominent color */
        border-top: 1px solid #eee;
        padding-top: 10px;
        margin-top: 10px;
    }

    .harga-item.diskon {
        color: #dc3545;
        /* Red color for discount */
    }

    .modal-actions {
        margin-top: 25px;
        text-align: right;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .modal-actions button {
        padding: 10px 20px;
        border-radius: 6px;
        font-size: 0.95em;
        cursor: pointer;
        transition: opacity 0.2s ease-in-out;
    }

    .modal-actions button:hover {
        opacity: 0.8;
    }

    .modal-actions .btn-secondary {
        background-color: #6c757d;
        color: white;
        border: none;
    }

    .modal-actions .btn-primary {
        background-color: #007bff;
        color: white;
        border: none;
    }

    .review-images {
        display: flex;
        flex-direction: row;
        overflow-x: auto;
        /* Aktifkan horizontal scroll jika konten meluap */
        white-space: nowrap;
        /* Mencegah gambar turun ke baris baru */
        margin-bottom: 10px;
        /* Berikan sedikit jarak di bawah area gambar */
        padding-bottom: 5px;
        /* Opsional: ruang di bawah gambar untuk scrollbar */
    }

    .review-images img {
        width: 70px;
        height: 100px;
        object-fit: cover;
        border-radius: 5px;
        margin-right: 10px;
        /* Jarak antar gambar */
        flex-shrink: 0;
        /* Mencegah gambar mengecil */
    }

    .review-images img:last-child {
        margin-right: 0;
        /* Hilangkan margin kanan pada gambar terakhir */
    }

    .user-reviews {
        margin-top: 15px;
        max-height: 680px;
        /* Sesuaikan tinggi maksimal sesuai kebutuhan Anda (misalnya, tinggi 3 ulasan + sedikit ruang) */
        overflow-y: auto;
        /* Aktifkan vertical scroll jika konten meluap */
        padding-right: 10px;
        /* Opsional: ruang untuk scrollbar */
    }

    .user-review {
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }

    .user-info .rating-stars .star {
        color: gold;
        font-size: 1em;
        margin-right: 2px;
    }

    .user-info .rating-stars .star-empty {
        color: #ccc;
        font-size: 1em;
        margin-right: 2px;
    }

    .review-content {
        display: flex;
        align-items: flex-start;
    }

    .review-images {
        display: flex;
        flex-direction: row;
        overflow-x: auto;
        white-space: nowrap;
        margin-bottom: 10px;
        padding-bottom: 5px;
    }

    .review-images img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 5px;
        margin-right: 5px;
        flex-shrink: 0;
    }

    .review-images img:last-child {
        margin-right: 0;
    }

    .review-text {
        margin-top: 0;
    }

    .review-text a {
        font-weight: bold;
    }
</style>





<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mainImage = document.getElementById('main-image');
        const thumbnailScrollWrapper = document.getElementById('thumbnailScrollWrapper');
        const beliSekarangBtn = document.getElementById('beliSekarangBtn');
        const beliSekarangModal = document.getElementById('beliSekarangModal');
        const closeButton = document.querySelector('.close-button');
        const batalBeliBtn = document.getElementById('batalBeliBtn');

        if (mainImage && thumbnailScrollWrapper) {
            const mainImageWidth = mainImage.offsetWidth;
            thumbnailScrollWrapper.style.maxWidth = mainImageWidth + 'px';
            thumbnailScrollWrapper.style.overflowX = 'auto';
        }

        // Ubah display modal dengan menambah/menghapus class "show"
        beliSekarangBtn.addEventListener('click', function () {
            beliSekarangModal.classList.add("show");
        });

        closeButton.addEventListener('click', function () {
            beliSekarangModal.classList.remove("show");
        });

        batalBeliBtn.addEventListener('click', function () {
            beliSekarangModal.classList.remove("show");
        });

        window.addEventListener('click', function (event) {
            if (event.target === beliSekarangModal) {
                beliSekarangModal.classList.remove("show");
            }
        });
    });

</script>

<script>
    function highlightStars(selectedStar) {
        const stars = document.querySelectorAll('.star-filter');
        const rating = parseInt(selectedStar.getAttribute('data-rating'));

        stars.forEach(star => {
            const starRating = parseInt(star.getAttribute('data-rating'));
            if (starRating <= rating) {
                star.style.color = 'gold'; // Warna emas yang lebih pekat adalah default
            } else {
                star.style.color = '#ccc';
            }
        });
    }
            thumbnailScrollWrapper.style.overflowX = 'auto';
        }

        // Ubah display modal dengan menambah/menghapus class "show"
        beliSekarangBtn.addEventListener('click', function () {
            beliSekarangModal.classList.add("show");
        });

        closeButton.addEventListener('click', function () {
            beliSekarangModal.classList.remove("show");
        });

        batalBeliBtn.addEventListener('click', function () {
            beliSekarangModal.classList.remove("show");
        });

        window.addEventListener('click', function (event) {
            if (event.target === beliSekarangModal) {
                beliSekarangModal.classList.remove("show");
            }
        });
    });

</script>

<script>
    function highlightStars(selectedStar) {
        const stars = document.querySelectorAll('.star-filter');
        const rating = parseInt(selectedStar.getAttribute('data-rating'));

        stars.forEach(star => {
            const starRating = parseInt(star.getAttribute('data-rating'));
            if (starRating <= rating) {
                star.style.color = 'gold'; // Warna emas yang lebih pekat adalah default
            } else {
                star.style.color = '#ccc';
            }
        });
    }
</script>
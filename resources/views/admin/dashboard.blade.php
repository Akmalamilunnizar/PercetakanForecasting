@extends('admin.layouts.template')
@section('page_title')
SANKE | Halaman Dashboard Admin
@endsection
@section('js')
<script src="{{ asset('assets/apexcharts/dist/apexcharts.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/apexcharts/dist/apexcharts.css') }}" />
<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('assets/images/logo/logo4.png') }}" type="image/png" />
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endsection

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Welcome Card -->
            <div class="col-lg-12 mb-12 order-0 mb-4">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title" style="color: black; font-weight: bold;">
                                    Selamat datang {{ Auth::user()->f_name }}! 🎉
                                </h5>
                                <p class="mb-4">
                                    <span class="fw-bold">"Citra Media Digital Printing</span> Citra Media Digital Printing merupakan perusahaan yang bergerak di bidang layanan percetakan digital yang berbasis teknologi. Perusahaan ini menyediakan berbagai layanan cetak seperti banner, brosur, stiker, undangan, buku, dan produk cetak lainnya dengan mengedepankan kualitas, ketepatan waktu, dan pelayanan profesional. Dalam rangka meningkatkan efisiensi dan akurasi pengelolaan operasional, Citra Media menerapkan sistem pemesanan online serta integrasi kecerdasan buatan (AI) untuk analisis penjualan dan optimalisasi stok bahan baku. Citra Media berkomitmen untuk menjadi mitra percetakan terpercaya bagi masyarakat umum, pelaku usaha, maupun instansi dengan menyediakan solusi cetak yang inovatif, efektif, dan berorientasi pada kepuasan pelanggan."
                                </p>
                                <a href="{{ route('profile') }}" class="btn btn-sm btn-outline-primary"
                                    style="background: linear-gradient(to right, #32CD32, #228B22); color: white; border: none;">
                                    Lihat Profil
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('dashboard2/assets/img/illustrations/image-removebg-preview (40).png') }}"
                                    height="220" alt="View Badge User"
                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="col-lg-12 mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Barang</h5>
                                <h2 class="mb-0">{{ $totalItems }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Barang Stok Rendah</h5>
                                <h2 class="mb-0">{{ $lowStockItems->count() }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Jenis Barang</h5>
                                <h2 class="mb-0">{{ $itemsByType->count() }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="col-lg-8 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Top 5 Barang dengan Stok Tertinggi</h5>
                        <div id="topStockChart"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Distribusi Jenis Barang</h5>
                        <div id="itemsByTypeChart"></div>
                    </div>
                </div>
            </div>

            
            
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Top Stock Items Chart
    var topStockOptions = {
        series: [{
            name: 'Stok',
            data: {!! json_encode($topStockItems->pluck('JumlahStok')) !!}
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                horizontal: false,
            }
        },
        dataLabels: {
            enabled: false
        },
        xaxis: {
            categories: {!! json_encode($topStockItems->pluck('NamaBarang')) !!},
        },
        colors: ['#32CD32']
    };

    var topStockChart = new ApexCharts(document.querySelector("#topStockChart"), topStockOptions);
    topStockChart.render();

    // Items by Type Chart
    var itemsByTypeOptions = {
        series: {!! json_encode($itemsByType->pluck('total')) !!},
        chart: {
            type: 'pie',
            height: 350
        },
        labels: {!! json_encode($itemsByType->map(function($item) {
            return $item->jenisBarang->JenisBarang ?? 'Unknown';
        })) !!},
        colors: ['#32CD32', '#228B22', '#006400', '#90EE90', '#98FB98'],
        legend: {
            position: 'bottom'
        }
    };

    var itemsByTypeChart = new ApexCharts(document.querySelector("#itemsByTypeChart"), itemsByTypeOptions);
    itemsByTypeChart.render();
</script>
@endpush
@endsection

@extends('admin.layouts.template')
@section('page_title')
CIME | Halaman Dashboard
@endsection
@section('js')
<script src="{{ asset('assets/apexcharts/dist/apexcharts.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/apexcharts/dist/apexcharts.css') }}" />

<!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('dashboard2/assets/img/icons/logocime.png') }}" type="image/png" />

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endsection

@section('content')
<!-- Content wrapper -->

<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            

            <!-- Summary Cards -->
            <div class="col-lg-12 mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title" style="text-align: center;">Total Barang</h5>
                                <h2 class="mb-0" style="text-align: center;">{{ $totalItems }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title" style="text-align: center;">Barang Stok Rendah</h5>
                                <h2 class="mb-0" style="text-align: center;">{{ $lowStockItems->count() }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                               <h5 class="card-title" style="text-align: center;">Jenis Barang</h5>
                                <h2 class="mb-0" style="text-align: center;">{{ $itemsByType->count() }}</h2>
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
                        <h5 class="card-title" style="text-align: center;">Distribusi Jenis Barang</h5>

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
                distributed: true // aktifkan agar tiap batang bisa warna beda
            }
        },
        dataLabels: {
            enabled: false
        },
        xaxis: {
            categories: {!! json_encode($topStockItems->pluck('NamaBarang')) !!}
        },
        colors: ['#FF0000', '#33C1FF', '#FFC300', '#75FF33', '#DA33FF', '#FF33A8', '#33FFF0'] // warna beda antar barang
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
        colors: ['#FF0000', '#33C1FF', '#FFC300', '#75FF33', '#DA33FF', '#FF33A8', '#33FFF0'], // warna beda antar jenis
        legend: {
            position: 'bottom'
        }
    };

    var itemsByTypeChart = new ApexCharts(document.querySelector("#itemsByTypeChart"), itemsByTypeOptions);
    itemsByTypeChart.render();
</script>
@endpush


@endsection

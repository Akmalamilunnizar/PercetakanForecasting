@extends('admin.layouts.template')
@section('page_title')
SANKE | Halaman Dashboard Admin
@endsection
@section('js')
<script src="{{ asset('assets/apexcharts/dist/apexcharts.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/apexcharts/dist/apexcharts.css') }}" />
<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('assets/images/logo/logo4.png') }}" type="image/png" />

{{--
<link rel="stylesheet" href="{{ URL::asset('assets/apexcharts/dist/apexcharts.css') }}"> --}}
{{--
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.35.0/dist/apexcharts.css"> --}}
{{--
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.41.0/apexcharts.min.js"
    integrity="sha512-bp/xZXR0Wn5q5TgPtz7EbgZlRrIU3tsqoROPe9sLwdY6Z+0p6XRzr7/JzqQUfTSD3rWanL6WUVW7peD4zSY/vQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.41.0/apexcharts.min.css"
    integrity="sha512-5k2n0KtbytaKmxjJVf3we8oDR34XEaWP2pibUtul47dDvz+BGAhoktxn7SJRQCHNT5aJXlxzVd45BxMDlCgtcA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
{{--
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="{{ URL('assets/apexcharts/dist/apexcharts.min.js') }}"></script> --}}
{{--
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-12 order-0 mb-4">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title" style="color: black; font-weight: bold;">
                                    Selamat datang {{ Auth::user()->f_name }}! 🎉
                                </h5>
                                <p class="mb-4">
                                    <span class="fw-bold">"The genks koi 99 farm</span> Adalah teman2 pencinta koi
                                    di jember yg berdiri tgl 10-10-2019 dgn keanggotaan 5 orang dan mempunya kemitraan
                                    dgn petani di area Jember. The genks koi 99 farm hanya ingin memajukan perkoian di
                                    Jember"
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
            <div class="card">
                <h5 class="card-header">Barang Yang Tersedia</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>Id</th>
                                <th>Nama Barang</th>
                                <th>Jenis Barang</th>
                                <th>Jumlah Stok</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">

                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->IdBarang }}</td>
                                    <td>{{ $item->NamaBarang }}</td>
                                    <td>{{ $item->jenisBarang->JenisBarang }}</td>

                                    {{-- <td>{{ $jml_ikan }}</td> --}}
                                    <td>{{ $item->JumlahStok }} {{ $item->satuan->Satuan }}</td>
                                    {{-- <td>{{ $item->updated_at }}</td> --}}
                                    <td>
                                        <a href="{{ route('edititem', $item->IdBarang) }}" class="btn btn-primary">Edit</a>
                                        <a href="{{ route('deleteitem', $item->IdBarang) }}" class="btn btn-warning">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Bootstrap Table with Header - Light -->
        </div>

            <!-- Bootstrap Table with Header - Light -->
        </div>
            <div class="col-12 col-lg-4 col-md-8 order-2 order-md-2">
                <div class="row">
                    <div class="col-md-8 col-lg-12 col-xl-12 order-0 mb-4">
                        <div class="card">
                            <div class="card-body">
                                {{-- <div class="fw-bold text-dark mb-2">Keterangan</div> --}}
                                <div id="pieChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-12 col-md-12 col-sm-12 order-3 order-md-4">
                <div class="row">
                    <div class="col-2 mb-4 card-body pb-0 px-0 px-md-4">
                        <div class="card">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                <div class="card-title d-flex align-items-center justify-content-center flex-column">
                                    <div class="avatar flex-shrink-0 text-center">
                                        <img src="{{ asset('dashboard2/assets/img/icons/unicons/ph-balance.png') }}"
                                            alt="Credit Card" class="rounded" />
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-2 mb-4 card-body pb-0 px-0 px-md-4">
                        <div class="card">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                <div class="card-title d-flex align-items-center justify-content-center flex-column">
                                    <div class="avatar flex-shrink-0 text-center">
                                        <img src="{{ asset('dashboard2/assets/img/icons/unicons/thermometer.png') }}"
                                            alt="Credit Card" class="rounded" />
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-2 mb-4 card-body pb-0 px-0 px-md-4">
                        <div class="card">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                <div class="card-title d-flex align-items-center justify-content-center flex-column">
                                    <div class="avatar flex-shrink-0 text-center">
                                        <img src="{{ asset('dashboard2/assets/img/icons/unicons/dissolved-oxygen-monitor.png') }}"
                                            alt="Credit Card" class="rounded" />
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- / Content -->
@endsection


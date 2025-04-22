@extends('admin.layouts.template')
@section('page_title')
    SANKE | Halaman Semua Barang Koi
@endsection
@section('search')
    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            {{-- <form method="GET" action={{ route('searchitems') }}>
                <input type="text" name="search" class="form-control border-0 shadow-none ps-1 ps-sm-2 w-100"
                    placeholder="Pencarian id atau nama..." value="{{ isset($search) ? $search : '' }}"
                    aria-label="Pencarian..." style="600px" />
            </form> --}}
        </div>
    </div>
@endsection
@section('content')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/sass/style.scss'])
    <div class="layout-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <a href="{{ route('additems') }}" class="btn btn-success ms-auto mb-3"
                style="background: linear-gradient(45deg, #28a745, #34d058);">
                + Tambah Barang
            </a>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="card ">
                <h5 class="card-header d-flex flex-wrap justify-content-between">Barang Yang Tersedia
                    {{-- <a href="{{ route('manageitems') }}" class="btn rounded-pill btn-primary"><span --}}
                            class="tf-icons bx bx-cog"></span>&nbsp; Kelola Barang</a>
                </h5>
                <div class="row m-0 p-4">
                    <div class="col-12 p-2 d-flex mb-2 br5">
                        <div class="card h-500 p-6 position-relative"> <!-- Make the card container relative -->
                            @foreach ($items as $item)
                                <div class="position-relative">
                                    <div class="box vintage">
                                        <img class="card-img-top" src="/uploads/{{ $item->img }}" alt="Card image cap">
                                        <h2 class="mb-0 text-white" style="font-weight: 700">{{ $item->name }}</h2>
                                        <p>28°C & Volume {{ $item->volume }}</p>
                                        <dd class="col-sm-3">Id Barang = {{ $item->id }}</dd>
                                        <dt class="col-sm-9">Volume Barang = {{ $item->volume }}</dt>
                                        {{-- <!-- Menampilkan Jumlah Ikan -->
                                        <dd class="col-sm-3">Jumlah Ikan =
                                            {{ $jml_ikan->where('item_id', $item->id)->first()->jml_ikan ?? 'Data tidak tersedia' }}
                                        </dd> --}}
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                    <dl class="row mt-2">
                                        {{-- <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                        <input type="radio" class="btn-check" name="btnradio" id="btnradio1" checked
                                            autocomplete="off" />
                                        <label class="btn btn-outline-primary" for="btnradio1"><span
                                                class="tf-icons bx bx-power-off"></span>&nbsp; Keran Hidup</label>
                                        <input type="radio" class="btn-check" name="btnradio" id="btnradio2"
                                            autocomplete="off" />
                                        <label class="btn btn-outline-primary" for="btnradio2"><span
                                                class="tf-icons bx bx-power-off"></span>&nbsp; Keran Mati</label>
                                    </div> --}}
                                    </dl>
                                    </p>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!--/ Card layout -->
            </div>
        </div>
    </div>
    <!-- Bootstrap Table with Header - Light -->
    </div>
@endsection

@extends('admin.layouts.template')

@section('page_title')
    Laporan - Citra Media
@endsection

@section('search')
    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            {{-- <form method="GET" action="#"> --}}
                <input type="text" name="search" class="form-control border-0 shadow-none ps-1 ps-sm-2 w-100"
                    placeholder="Pencarian nama barang..." value="{{ isset($search) ? $search : '' }}"
                    aria-label="Pencarian..." style="600px" />
                {{--
            </form> --}}
        </div>
    </div>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Judul Laporan -->
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Halaman /</span> Laporan Barang</h4>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <!-- KIRI: Dropdown Pilihan Halaman -->
            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Pilih Laporan
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="{{ route('alllaporan') }}">📄 Laporan Barang</a></li>
                    <li><a class="dropdown-item" href="{{ route('laporan-transaksi') }}">📊 Laporan Transaksi</a></li>
                </ul>
            </div>

            <!-- KANAN: Export PDF -->
            <a href="" class="btn btn-danger" style="background: linear-gradient(45deg, #dc3545, #ff6b6b);">
                <i class='bx bxs-file-pdf'></i> Export PDF
            </a>
        </div>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="card">
            <h5 class="card-header">Data Laporan</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Id</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Tanggal Pengeluaran</th>
                            <th>Keterangan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($laporans as $laporan)
                            <tr>
                                <td>{{ $laporan->id }}</td>
                                <td>{{ $laporan->nama_barang }}</td>
                                <td>{{ $laporan->jumlah }}</td>
                                <td>{{ $laporan->tanggal_pengeluaran }}</td>
                                <td>{{ $laporan->keterangan ?? '-' }}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary">Detail</a>
                                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data laporan.</td>
                            </tr>
                        @endforelse


                        <script
                            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
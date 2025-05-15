@extends('admin.layouts.template')

@section('page_title')
    Laporan Transaksi - Citra Media
@endsection

@section('search')
    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            <input type="text" name="search" class="form-control border-0 shadow-none ps-1 ps-sm-2 w-100"
                placeholder="Pencarian nama pelanggan..." value="{{ isset($search) ? $search : '' }}"
                aria-label="Pencarian..." style="600px" />
        </div>
    </div>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Judul Laporan -->
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Halaman /</span> Laporan Transaksi</h4>

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
            <h5 class="card-header">Data Laporan Transaksi</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Id</th>
                            <th>Kode Transaksi</th>
                            <th>Nama Pelanggan</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Tanggal Transaksi</th>
                            <th>Status Pembayaran</th>
                            <th>Keterangan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($laporantransaksis as $transaksi)
                            <tr>
                                <td>{{ $transaksi->id }}</td>
                                <td>{{ $transaksi->kode_transaksi }}</td>
                                <td>{{ $transaksi->nama_pelanggan }}</td>
                                <td>{{ $transaksi->produk }}</td>
                                <td>{{ $transaksi->jumlah }}</td>
                                <td>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                                <td>{{ $transaksi->tanggal_transaksi }}</td>
                                <td>
                                    @if ($transaksi->status_pembayaran == 'Lunas')
                                        <span class="badge bg-success">Lunas</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Belum Lunas</span>
                                    @endif
                                </td>
                                <td>{{ $transaksi->keterangan ?? '-' }}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary">Detail</a>
                                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">Tidak ada data transaksi.</td>
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
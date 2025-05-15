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
            <li><a class="dropdown-item" href="{{ route('laporanbarang') }}">📄 Laporan Barang</a></li>
            <li><a class="dropdown-item" href="{{ route('laporan-transaksi') }}">📊 Laporan Transaksi</a></li>
        </ul>
    </div>

    <!-- KANAN: Semua Filter & Tombol di sini -->
        <div class="d-flex align-items-center gap-2">
                <form method="GET" action="{{ route('laporanbarang') }}" class="d-flex align-items-center gap-2">
                    <!-- Pilih Bulan -->
                    <select name="bulan" class="form-select" style="width: 140px;">
                        <option value="">Pilih Bulan</option>
                        @foreach ([
                            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
                            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
                            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                        ] as $key => $value)
                            <option value="{{ $key }}" {{ request('bulan') == $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>

                    <!-- Pilih Tahun -->
                    <select name="tahun" class="form-select" style="width: 100px;">
                        <option value="">Tahun</option>
                        @for ($tahun = 2020; $tahun <= date('Y'); $tahun++)
                            <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                        @endfor
                    </select>

                    <!-- Tombol Filter -->
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>

                <!-- Tombol Export PDF -->
                <a href="" class="btn btn-danger" style="background: linear-gradient(45deg, #dc3545, #ff6b6b);">
                    <i class='bx bxs-printer me-2'></i> Print
                </a>
            </div>
        </div>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="card">
    <h5 class="card-header">Data Laporan</h5>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive text-nowrap">
        <table class="table">
    <thead class="table-light">
        <tr>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Nama Supplier</th>
            <th>Qty Masuk</th>
            <th>Qty Keluar</th>
            <th>Sisa Stok</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody class="table-border-bottom-0">
         @if($laporanbarang->count() > 0)
            @foreach ($laporanbarang as $laporan)
                <tr>
                    <td>{{ $laporan->IdLaporan }}</td>
                    <td>{{ $laporan->databarang->NamaBarang ?? 'N/A' }}</td>
                    <td>{{ $laporan->supplier->NamaSupplier ?? 'N/A' }}</td>
                    <td>{{ $laporan->detailBarangMasuk->Jumlah ?? 0 }}</td>
                    <td>{{ $laporan->detailBarangKeluar->Jumlah ?? 0 }}</td>
                    <td>{{ $laporan->barangmasuk->Jumlah ?? 0 }}</td>
                    <td>{{ $laporan->barangkeluar->Jumlah ?? 0 }}</td>
                    <td>
                        <form action="{{ route('laporanbarang.destroy', $laporan->IdLaporan) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
               @else
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data !</td>
                    </tr>
                @endif
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"></script>
    </tbody>
</table>

    </div>
</div>

    </div>
@endsection
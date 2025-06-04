@extends('admin.layouts.template')
@section('page_title')
    CIME | Halaman Daftar Barang
@endsection
@section('search')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fonadmin.layouts.templatet-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            {{-- <form method="GET" action={{ route('searchitem') }}> --}}
                <input type="text" name="search" class="form-control border-0 shadow-none ps-1 ps-sm-2 w-100"
                    placeholder="Pencarian id atau nama..." value="{{ isset($search) ? $search : '' }}"
                    aria-label="Pencarian..." style="600px" />
            </form>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 py-1">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Halaman/</span> Semua Barang</h4>
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('additems') }}" class="btn btn-primary" style="border-radius: 8px;">
                    + Tambah Barang
                </a>
                <a href="{{ route('exititems') }}" class="btn btn-danger" style="border-radius: 8px;">
                    + Barang Keluar
                </a>
            </div>
        </div>

        <div class="card">
            <h5 class="card-header">Filter Barang</h5>
            <div class="card-body">
                <form method="GET" action="{{ route('allitems') }}" class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                    {{-- Filter Jenis Barang --}}
                    <div class="d-flex align-items-center gap-2">
                        <label for="jenis_barang" class="form-label mb-0">Jenis Barang:</label>
                        <select name="jenis_barang" id="jenis_barang" class="form-select" style="width: 160px; border-radius: 8px;">
                            <option value="">Semua Jenis</option>
                            @foreach($jenisBarang as $jenis)
                                <option value="{{ $jenis->IdJenisBarang }}" {{ request('jenis_barang') == $jenis->IdJenisBarang ? 'selected' : '' }}>
                                    {{ $jenis->JenisBarang }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Filter Bulan & Tahun --}}
                    <div class="d-flex align-items-center gap-2 mt-2 mt-md-0">
                        <label for="bulan" class="form-label mb-0">Bulan:</label>
                        <select name="bulan" id="bulan" class="form-select" style="width: 160px; border-radius: 8px;">
                            <option value="">Semua Bulan</option>
                            @foreach ([
                                '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
                                '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
                                '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                            ] as $key => $value)
                                <option value="{{ $key }}" {{ request('bulan') == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                        <label for="tahun" class="form-label mb-0">Tahun:</label>
                        <select name="tahun" id="tahun" class="form-select" style="width: 120px; border-radius: 8px;">
                            <option value="">Semua Tahun</option>
                            @for ($year = 2020; $year <= date('Y'); $year++)
                                <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endfor
                        </select>
                    </div>

                    {{-- Search Input --}}
                    <div class="d-flex align-items-center gap-2">
                        <label for="search" class="form-label mb-0">Cari:</label>
                        <input type="text" name="search" id="search" class="form-control"
                            placeholder="ID atau Nama Barang" value="{{ request('search') }}" style="width: 200px; border-radius: 8px;">
                    </div>

                    {{-- Filter Button --}}
                    <button type="submit" class="btn btn-outline-primary" style="border-radius: 8px; border-width: 2px; transition: all 0.3s ease;">
                        <i class='bx bx-filter-outline me-1'></i> Filter
                    </button>

                    {{-- Print Button --}}
                    <a href="{{ route('allitems.exportpdf', [
                        'bulan' => request('bulan'),
                        'tahun' => request('tahun'),
                        'jenis_barang' => request('jenis_barang'),
                        'search' => request('search')
                    ]) }}"
                        class="btn btn-danger"
                        style="background: linear-gradient(45deg, #dc3545, #ff6b6b); border-radius: 8px;"
                        target="_blank">
                        <i class='bx bxs-printer me-2'></i> Print Laporan
                    </a>
                </form>
            </div>
        </div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="card">
            <h5 class="card-header">Barang Yang Tersedia</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th class="fw-bold text-center">Id Masuk </th>
                            <th class="fw-bold text-center">Tanggal Masuk</th>
                            <th class="fw-bold text-center">Nama Supplier </th>
                            <th class="fw-bold text-center">Qty Masuk </th>
                            <th class="fw-bold text-center">Harga Satuan </th>
                            <th class="fw-bold text-center">Sub Total </th>
                            <th class="fw-bold text-center">Nama Barang</th>
                            <th class="fw-bold text-center">JenisBarang</th>
                            <th class="fw-bold text-center">Jumlah Stok</th>
                            <th class="fw-bold text-center">Id Keluar </th>
                            <th class="fw-bold text-center">Tanggal Keluar</th>
                            <th class="fw-bold text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                        @foreach ($items as $item)
                            <tr>
                                <td class="text-center">{{ $item->latestDetailMasuk?->IdMasuk ?? '-' }}</td>
                                <td class="text-center">{{ $item->latestDetailMasuk ? \Carbon\Carbon::parse($item->latestDetailMasuk->created_at)->format('d-m-Y H:i') : '-' }}</td>
                                <td class="text-center">{{ $item->latestDetailMasuk?->supplier?->NamaSupplier ?? '-' }}</td>
                                <td class="text-center">{{ $item->latestDetailMasuk?->QtyMasuk ?? '-' }}</td>
                                <td class="text-center">{{ $item->latestDetailMasuk?->HargaSatuan ?? '-' }}</td>
                                <td class="text-center">{{ $item->latestDetailMasuk?->SubTotal ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#tambahQtyModal{{ $item->IdBarang }}">
                                        {{ $item->NamaBarang }}
                                    </a>

                                    <div class="modal fade" id="tambahQtyModal{{ $item->IdBarang }}" tabindex="-1"
                                        aria-labelledby="tambahQtyLabel{{ $item->IdBarang }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('barang.tambahQty') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="IdBarang" value="{{ $item->IdBarang }}">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="tambahQtyLabel{{ $item->IdBarang }}">Tambah
                                                            Qty - {{ $item->NamaBarang }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Tutup"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="QtyMasuk" class="form-label">Qty Masuk</label>
                                                            <input type="number" name="QtyMasuk" class="form-control" min="1"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">{{ $item->jenisBarang->JenisBarang }}</td>
                                <td class="text-center">{{ $item->JumlahStok }} {{ $item->satuan->Satuan }}</td>
                                <td class="text-center">{{ $item->latestDetailKeluar?->IdKeluar ?? '-' }}</td>
                                <td class="text-center">{{ $item->latestDetailKeluar ? \Carbon\Carbon::parse($item->latestDetailKeluar->created_at)->format('d-m-Y H:i') : '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.detail_allitems', $item->IdBarang) }}" class="btn btn-info" style="border-radius: 8px;">
                                        <i class="fas fa-info-circle me-1"></i> Detail
                                    </a>
                                    <a href="{{ route('edititem', $item->IdBarang) }}" class="btn btn-warning" style="border-radius: 8px;">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <a href="{{ route('deleteitem', $item->IdBarang) }}" class="btn btn-danger"
                                        onclick="return confirm('Yakin ingin hapus data ini?')">
                                        <i class="fas fa-trash-alt me-1"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        {{-- Start Riwayat Penambahan Stok --}}
        <h5 class="mt-5 mb-3">Riwayat Penambahan Stok</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-bordered">
                <thead class="table-secondary">
                    <tr>
                        <th>ID Masuk</th>
                        <th>Nama Barang</th>
                        <th>Qty Masuk</th>
                        <th>Tanggal Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayatStok as $log)
                        <tr>
                            <td>{{ $log->IdMasuk }}</td>
                            <td>{{ $log->NamaBarang }}</td>
                            <td>{{ $log->QtyMasuk }}</td>
                            <td>{{ \Carbon\Carbon::parse($log->tanggal_masuk)->format('d-m-Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada riwayat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- End Riwayat Penambahan Stok --}}

        {{-- Start Riwayat Pengeluaran Stok --}}
        <h5 class="mt-5 mb-3">Riwayat Pengeluaran Stok</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-bordered">
                <thead class="table-secondary">
                    <tr>
                        <th>ID Keluar</th>
                        <th>Nama Barang</th>
                        <th>Qty Keluar</th>
                        <th>Tanggal Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayatKeluar as $log)
                        <tr>
                            <td>{{ $log->IdKeluar }}</td>
                            <td>{{ $log->NamaBarang }}</td>
                            <td>{{ $log->QtyKeluar }}</td>
                            <td>{{ \Carbon\Carbon::parse($log->tanggal_keluar)->format('d-m-Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada riwayat pengeluaran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- End Riwayat Pengeluaran Stok --}}
    </div>
    {{-- Pastikan ini tetap ada jika diperlukan oleh Bootstrap atau komponen lain --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
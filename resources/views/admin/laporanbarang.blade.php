@extends('admin.layouts.template')

@section('page_title')
CIME | Halaman Laporan Barang
@endsection

@section('search')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            <input type="text" name="search" class="form-control border-0 shadow-none ps-1 ps-sm-2 w-100"
                placeholder="Pencarian nama barang..." value="{{ isset($search) ? $search : '' }}"
                aria-label="Pencarian..." style="600px" />
        </div>
    </div>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Halaman /</span> Laporan Barang</h4>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center gap-2"> {{-- Ini div pembungkus baru --}}
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Pilih Laporan
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="{{ route('laporanbarang') }}">📄 Laporan Barang</a></li>
                        <li><a class="dropdown-item" href="{{ route('laporantransaksi') }}">📊 Laporan Transaksi</a></li>
                    </ul>
                </div>

                {{-- Tombol Prediksi Penjualan baru --}}
                <a href="{{ route('forecast.form') }}" class="btn btn-outline-primary"> {{-- Sesuaikan route ini --}}
                    <i class="fas fa-chart-line me-2"></i> Forecasting
                </a>
            </div>

            <div class="d-flex align-items-center gap-2">
                <form method="GET" action="{{ route('laporanbarang') }}" class="d-flex align-items-center gap-2">
                    <select name="bulan" class="form-select" style="width: 160px;">
                        <option value="">Pilih Bulan</option>
                        @foreach ([
                            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
                            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
                            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                        ] as $key => $value)
                        <option value="{{ $key }}" {{ request('bulan') == $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                    <select name="tahun" class="form-select" style="width: 120px;">
                        <option value="">Tahun</option>
                        @for ($tahun = 2020; $tahun <= date('Y'); $tahun++)
                        <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                        @endfor
                    </select>
                    <button type="submit" class="btn btn-outline-primary">
                        Filter
                    </button>
                </form>

                <a href="{{ route('laporanbarang.exportpdf', ['bulan' => request('bulan'), 'tahun' => request('tahun')]) }}"
                    class="btn btn-danger"
                    style="background: linear-gradient(45deg, #dc3545, #ff6b6b);"
                    target="_blank">
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
            <h5 class="card-header fw-bold">Data Laporan</h5>

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
                <table class="table table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th style="text-align: center; font-weight: bold;">No</th>
                            <th style="text-align: center; font-weight: bold;">Nama Barang</th>
                            <th style="text-align: center; font-weight: bold;">Nama Supplier</th>
                            <th style="text-align: center; font-weight: bold;">Qty Masuk</th>
                            <th style="text-align: center; font-weight: bold;">Qty Keluar</th>
                            <th style="text-align: center; font-weight: bold;">Sisa Stok</th>
                            <th style="text-align: center; font-weight: bold;">Aksi</th>
                        </tr>
                    </thead>
                    @php
                        use Carbon\Carbon;
                    @endphp
                    <tbody>
                        @if($laporanbarang->count() > 0)
                            @foreach ($laporanbarang as $laporan)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ optional($laporan->databarang)->NamaBarang }}</td>
                                    <td class="text-center">{{ optional($laporan->supplier)->NamaSupplier }}</td>
                                    <td class="text-center">{{ optional($laporan->detailBarangMasuk)->QtyMasuk ?? 0 }}</td>
                                    <td class="text-center">{{ optional($laporan->detailBarangKeluar)->QtyKeluar ?? 0 }}</td>
                                    <td class="text-center">
                                        {{ optional($laporan->databarang)->JumlahStok ?? 0 }}
                                        {{ optional($laporan->databarang?->satuan)->Satuan ?? '' }}
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center" role="group" aria-label="Basic example">
                                            <a href="{{ route('admin.detaillaporanbarang', $laporan->IdLaporan) }}"
                                                class="btn btn-warning">
                                                <i class="fas fa-edit me-1"></i> Detail
                                            </a>
                                            <form action="{{ route('laporanbarang.destroy', $laporan->IdLaporan) }}" method="POST" class="p-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-danger mx-1 delete-confirm" {{-- Tambahkan class ini --}}
                                                    style="background: linear-gradient(45deg, #dc3545, #ff6b6b); min-width: 100px;">
                                                    <i class="fas fa-trash-alt me-2"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>

{{-- SweetAlert2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Script untuk pop-up konfirmasi delete
    document.querySelectorAll('.delete-confirm').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah form disubmit langsung

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan bisa mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.closest('form').submit(); // Submit form jika dikonfirmasi
                }
            });
        });
    });

    // Skrip SweetAlert bawaan Anda untuk session 'Sukses' dan 'Gagal'
    @if(session('Sukses'))
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: "{{ session('Sukses') }}",
            timer: 3000,
            showConfirmButton: false
        });
    @endif

    @if(session('Gagal'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: "{{ session('Gagal') }}",
            timer: 3000,
            showConfirmButton: false
        });
    @endif
</script>

{{-- Pastikan ini tetap ada jika diperlukan oleh Bootstrap atau komponen lain --}}
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"></script>
<style>
.form-select {
    border-radius: 0.5rem;
    box-shadow: 0 0 5px rgba(0,0,0,0.08);
}
.btn-filter { /* Perhatikan: class ini tidak digunakan di HTML yang baru */
    border-radius: 0.5rem;
    box-shadow: 0 0 5px rgba(0,0,0,0.08);
}
</style>
@endsection
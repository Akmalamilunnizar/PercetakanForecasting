@extends('admin.layouts.template')

@section('page_title')
    CIME | Daftar Transaksi
@endsection

@section('search')
    {{-- Form pencarian sekarang terintegrasi dengan filter bulan/tahun dan status di bagian content --}}
    {{-- Ini dihapus dari search section karena akan digabungkan di bagian content --}}
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Halaman</span> Daftar Transaksi</h4>

    {{-- Pesan sukses atau error --}}
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    <div class="card">
        <h5 class="card-header">Filter Transaksi</h5>
        <div class="card-body">
            <form method="GET" action="{{ route('alltransaksi') }}" class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                {{-- Filter Status --}}
                <div class="d-flex align-items-center gap-2">
                    <label for="status_pesanan" class="form-label mb-0">Status:</label>
                    <select name="status_pesanan" id="status_pesanan" class="form-select" style="width: 160px; border-radius: 8px;">
                        <option value="">Semua Status</option>
                        <option value="Pending" {{ request('status_pesanan') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="MENUNGGU KONFIRMASI" {{ request('status_pesanan') == 'MENUNGGU KONFIRMASI' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                        <option value="Diterima" {{ request('status_pesanan') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="Ditolak" {{ request('status_pesanan') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
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
                        placeholder="ID atau Nama Customer" value="{{ request('search') }}" style="width: 200px; border-radius: 8px;">
                </div>

                {{-- Filter Button --}}
                <button type="submit" class="btn btn-outline-primary" style="border-radius: 8px; border-width: 2px; transition: all 0.3s ease;">
                    <i class='bx bx-filter-outline me-1'></i> Filter
                </button>

                {{-- Print Button (dengan mempertahankan filter) --}}
                <a href="{{ route('alltransaksi.exportpdf', [
                    'bulan' => request('bulan'),
                    'tahun' => request('tahun'),
                    'status_pesanan' => request('status_pesanan'), // Tambahkan status_pesanan ke PDF export
                    'search' => request('search') // Tambahkan search ke PDF export
                ]) }}"
                    class="btn btn-danger"
                    style="background: linear-gradient(45deg, #dc3545, #ff6b6b); border-radius: 8px;"
                    target="_blank">
                    <i class='bx bxs-printer me-2'></i> Print Laporan
                </a>
            </form>
        </div>
    </div>

    <div class="card mt-4"> {{-- Margin top untuk memisahkan filter dengan tabel --}}
        <h5 class="card-header">Daftar Transaksi</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <th style="text-align: center; font-weight: bold;">Id Transaksi</th>
                        <th style="text-align: center; font-weight: bold;">Tanggal Transaksi</th>
                        <th style="text-align: center; font-weight: bold;">Nama Customer</th>
                        <th style="text-align: center; font-weight: bold;">Total Grand</th>
                        <th style="text-align: center; font-weight: bold;">Jumlah yang dibayarkan</th>
                        <th style="text-align: center; font-weight: bold;">Actions</th>
                        <th style="text-align: center; font-weight: bold;">Status Orderan</th>
                        <th style="text-align: center; font-weight: bold;">Jenis Pembayaran</th>
                        <th style="text-align: center; font-weight: bold;">Status Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $item)
                        <tr>
                            <td style="text-align: center;">
                                <a href="{{ route('vieworder', $item->IdTransaksi) }}" class="text-primary">
                                    {{ $item->IdTransaksi }}
                                </a>
                            </td>
                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($item->tglTransaksi)->format('d-m-Y H:i') }}
                            </td>
                            <td class="text-center">
                                {{ $item->detail->f_name ?? 'N/A' }}
                            </td>
                            <td class="text-center">Rp. {{ number_format($item->GrandTotal, 0, ',', '.') }}</td>
                            <td class="text-center">Rp. {{ number_format($item->Bayar, 0, ',', '.') }}</td>
                            <td class="text-center">
                                {{-- KONDISIONAL UNTUK TOMBOL AKSI --}}
                                @if ($item->StatusPesanan == 'menunggu konfirmasi' || $item->StatusPesanan == 'MENUNGGU KONFIRMASI')
                                    {{-- FORM UNTUK TOMBOL TERIMA --}}
                                    <form id="terimaForm{{ $item->IdTransaksi }}" action="{{ route('terimaOrderan', $item->IdTransaksi) }}" method="POST" style="display:inline;">
                                        @csrf {{-- Penting: Laravel CSRF Token --}}
                                        <button type="button" class="btn btn-success btn-sm mx-1"
                                            onclick="confirmAction('terima', 'terimaForm{{ $item->IdTransaksi }}');">
                                            <i class="fas fa-check me-1"></i> Terima
                                        </button>
                                    </form>

                                    {{-- FORM UNTUK TOMBOL TOLAK --}}
                                    <form id="tolakForm{{ $item->IdTransaksi }}" action="{{ route('tolakOrderan', $item->IdTransaksi) }}" method="POST" style="display:inline;">
                                        @csrf {{-- Penting: Laravel CSRF Token --}}
                                        <button type="button" class="btn btn-danger btn-sm mx-1"
                                            onclick="confirmAction('tolak', 'tolakForm{{ $item->IdTransaksi }}');">
                                            <i class="fas fa-times me-1"></i> Tolak
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted">Aksi Selesai</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($item->StatusPesanan == 'Pending' || $item->StatusPesanan == 'MENUNGGU KONFIRMASI')
                                    <span class="badge bg-warning me-1">{{ $item->StatusPesanan }}</span>
                                @elseif ($item->StatusPesanan == 'Diterima')
                                    <span class="badge bg-success me-1">{{ $item->StatusPesanan }}</span>
                                @elseif ($item->StatusPesanan == 'Ditolak')
                                    <span class="badge bg-danger me-1">{{ $item->StatusPesanan }}</span>
                                @else
                                    <span class="badge bg-secondary me-1">{{ $item->StatusPesanan }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmAction(type, formId) { // Mengubah parameter menjadi formId
        let title, text, confirmButtonText, iconType;

        if (type === 'terima') {
            title = 'Konfirmasi Penerimaan Orderan';
            text = 'Apakah Anda yakin akan menerima orderan ini? Status pesanan akan berubah menjadi "Diterima".';
            confirmButtonText = 'Ya, Terima!';
            iconType = 'question';
        } else if (type === 'tolak') {
            title = 'Konfirmasi Penolakan Orderan';
            text = 'Apakah Anda yakin akan menolak orderan ini? Status pesanan akan berubah menjadi "Ditolak".';
            confirmButtonText = 'Ya, Tolak!';
            iconType = 'warning';
        }

        Swal.fire({
            title: title,
            text: text,
            icon: iconType,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: confirmButtonText,
            cancelButtonText: 'Tidak',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit form yang sesuai
                document.getElementById(formId).submit();
            }
        });
    }
</script>
@endpush
@endsection
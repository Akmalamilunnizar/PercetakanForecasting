@extends('admin.layouts.template')

@section('page_title')
    CIME | Daftar Transaksi
@endsection

@section('search')
    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            <form method="GET" action="{{ route('searchtransaksi') }}">
                <input type="text" name="search" class="form-control border-0 shadow-none ps-1 ps-sm-2 w-100"
                    placeholder="Pencarian id atau nama..." value="{{ isset($search) ? $search : '' }}" aria-label="Pencarian..."
                    style="600px" />
            </form>
        </div>
    </div>
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Halaman</span> Daftar Transaksi</h4>
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
            <div class="d-flex align-items-center gap-2">
                <select name="status_barang" class="form-select" style="width: 160px; border-radius: 8px;">
                    <option value="">Pilih Status</option>
                    <option value="diterima">Diterima</option>
                    <option value="ditolak">Ditolak</option>
                </select>
            </div>
            <div class="d-flex align-items-center gap-2 mt-2 mt-md-0">
                <form method="GET" action="{{ route('alltransaksi') }}" class="d-flex align-items-center gap-2">
                    <select name="bulan" class="form-select" style="width: 160px; border-radius: 8px;">
                        <option value="">Pilih Bulan</option>
                        @foreach ([
                            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
                            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
                            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                        ] as $key => $value)
                        <option value="{{ $key }}" {{ request('bulan') == $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                    <select name="tahun" class="form-select" style="width: 120px; border-radius: 8px;">
                        <option value="">Tahun</option>
                        @for ($tahun = 2020; $tahun <= date('Y'); $tahun++)
                        <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                        @endfor
                    </select>

                    <button type="submit" class="btn btn-outline-primary" style="border-radius: 8px;">
                        Filter
                    </button>
                </form>
                <a href="{{ route('alltransaksi.exportpdf', ['bulan' => request('bulan'), 'tahun' => request('tahun')]) }}"
                    class="btn btn-danger"
                    style="background: linear-gradient(45deg, #dc3545, #ff6b6b); border-radius: 8px;"
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
    <h5 class="card-header">Daftar Transaksi</h5>
     <div class="table-responsive text-nowrap">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                  <th style="text-align: center; font-weight: bold;">Id</th>
                <th style="text-align: center; font-weight: bold;">Nama Customer</th>
                <th style="text-align: center; font-weight: bold;">Total</th>
                <th style="text-align: center; font-weight: bold;">Jumlah yang dibayarkan</th>
                <th style="text-align: center; font-weight: bold;">Actions</th>
                <th style="text-align: center; font-weight: bold;">Status Orderan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $item)
                   <tr>
                        <td class="text-center">{{ $item->IdTransaksi }}</td>
                        <td class="text-center">
                            <a href="{{ route('customerDetails', $item->detail->id) }}" class="text-primary fw-bold">
                                {{ $item->detail->f_name }}
                            </a>
                        </td>
                        <td class="text-center">{{ $item->Bayar }}</td>
                        <td class="text-center">{{ $item->bayar }}</td>
                       <td class="text-center">
                            <a href="{{ route('terimaOrderan', $item->id) }}" class="btn btn-success btn-sm mx-1">
                                <i class="fas fa-check me-1"></i> Terima
                            </a>
                            <a href="{{ route('tolakOrderan', $item->id) }}" class="btn btn-danger btn-sm mx-1">
                                <i class="fas fa-times me-1"></i> Tolak
                            </a>
                        </td>
                        <td class="text-center">{{ $item->StatusPesanan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

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
        <h5 class="card-header">Daftar Transaksi</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Id Transaksi</th>
                        <th>Nama Customer</th>
                        <th>Jumlah Produk</th>
                        <th>Alamat</th>
                        <th>Jumlah yang dibayarkan</th>
                        <th>Actions</th>
                        <th>Status Orderan</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($transaksi as $item)
                        <tr>
                            <td>{{ $item->IdTransaksi }}</td>
                            <td>{{ $item->detail->f_name ?? 'N/A' }}</td>
                            <td>{{ $item->Bayar }}</td>
                            <td>{{ $item->detail->alamat ?? 'N/A' }}</td>
                            <td>Rp. {{ number_format($item->GrandTotal, 0, ',', '.') }}</td>
                            <td>
                                {{-- KONDISIONAL UNTUK TOMBOL AKSI --}}
                                @if ($item->StatusPesanan == 'Pending')
                                    <a href="#" class="btn btn-success btn-sm"
                                        onclick="confirmAction('terima', '{{ route('terimaOrderan', $item->IdTransaksi) }}');">Terima</a>
                                    <a href="#" class="btn btn-danger btn-sm"
                                        onclick="confirmAction('tolak', '{{ route('tolakOrderan', $item->IdTransaksi) }}');">Tolak</a>
                                @else
                                    {{-- Jika sudah tidak Pending, tampilkan teks atau biarkan kosong --}}
                                    <span class="text-muted">Aksi Selesai</span>
                                @endif
                            </td>
                            <td>
                                @if ($item->StatusPesanan == 'Pending')
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
    function confirmAction(type, url) {
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
                window.location.href = url;
            }
        });
    }
</script>
@endpush
@endsection
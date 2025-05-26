@extends('admin.layouts.template')

@section('page_title')
    Detail Laporan Transaksi - Citra Media
@endsection

@section('search')
    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            <input type="text" name="search" class="form-control border-0 shadow-none ps-1 ps-sm-2 w-100"
                placeholder="Pencarian transaksi..." value="{{ isset($search) ? $search : '' }}" aria-label="Pencarian..."
                style="600px" />
        </div>
    </div>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Judul & Breadcrumb -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Laporan Transaksi /</span> Detail Transaksi</h4>
            <a href="{{ route('laporantransaksi.exportpdf.detail', $laporantransaksi->Idlaporan_transaksi) }}" target="_blank" class="btn btn-danger d-flex align-items-center"
                style="background: linear-gradient(45deg, #dc3545, #ff6b6b);">
                <i class='bx bxs-printer me-2'></i> Print
            </a>
        </div>

        <!-- Card Detail -->
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header text-white" style="background-color:rgb(123, 171, 254);">
                <strong class="fs-4">Detail Transaksi</strong>
            </div>

            <div class="card-body pt-3">
                <div class="row py-3 border-bottom">
                    <div class="col-md-4 fw-semibold">🆔 Id Laporan Transaksi:</div>
                    <div class="col-md-8">{{ $laporantransaksi->Idlaporan_transaksi }}</div>
                </div>
                <div class="row py-3 border-bottom">
                    <div class="col-md-4 fw-semibold">🧾 Nama Produk:</div>
                    <div class="col-md-8">{{ optional($laporantransaksi->produk)->NamaProduk ?? 'N/A' }}</div>
                </div>
                <div class="row py-3 border-bottom">
                    <div class="col-md-4 fw-semibold">📅 Tanggal Transaksi:</div>
                    <div class="col-md-8">{{ optional($laporantransaksi->transaksi)->tglTransaksi }}</div>
                </div>
                <div class="row py-3 border-bottom">
                    <div class="col-md-4 fw-semibold">💰 Total Harga:</div>
                    <div class="col-md-8">Rp {{ number_format(optional($laporantransaksi->transaksi)->GrandTotal, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection

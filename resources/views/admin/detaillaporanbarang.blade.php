@extends('admin.layouts.template')

@section('page_title')
    Detail Laporan Barang - Citra Media
@endsection

@section('search')
    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            <input type="text" name="search" class="form-control border-0 shadow-none ps-1 ps-sm-2 w-100"
                placeholder="Pencarian nama barang..." value="{{ isset($search) ? $search : '' }}" aria-label="Pencarian..."
                style="600px" />
        </div>
    </div>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Judul & Breadcrumb -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Laporan Barang /</span> Detail Barang</h4>
            <a href="" class="btn btn-danger d-flex align-items-center"
                style="background: linear-gradient(45deg, #dc3545, #ff6b6b);">
                <i class='bx bxs-printer me-2'></i> Print
            </a>
        </div>

        <!-- Card Detail -->
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-primary text-white">
                <strong class="fs-4">Detail Barang</strong>
            </div>
            <div class="card-body pt-3">
                <div class="row py-3 border-bottom">
                    <div class="col-md-4 fw-semibold">🆔 Id Barang:</div>
                    <div class="col-md-8">{{ $laporan->id }}</div>
                </div>
                <div class="row py-3 border-bottom">
                    <div class="col-md-4 fw-semibold">📦 Nama Barang:</div>
                    <div class="col-md-8">{{ $laporan->nama_barang }}</div>
                </div>
                <div class="row py-3 border-bottom">
                    <div class="col-md-4 fw-semibold">🔢 Jumlah:</div>
                    <div class="col-md-8">{{ $laporan->jumlah }}</div>
                </div>
                <div class="row py-3 border-bottom">
                    <div class="col-md-4 fw-semibold">📅 Tanggal Pengeluaran:</div>
                    <div class="col-md-8">{{ $laporan->tanggal_pengeluaran }}</div>
                </div>
                <div class="row py-3">
                    <div class="col-md-4 fw-semibold">📝 Keterangan:</div>
                    <div class="col-md-8">{{ $laporan->keterangan ?? '-' }}</div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-start mt-3">
            <a href="{{ route('alllaporan') }}" class="btn btn-secondary">
                <i class="bx bx-arrow-back me-2"></i> Kembali
            </a>
        </div>


    </div>
@endsection
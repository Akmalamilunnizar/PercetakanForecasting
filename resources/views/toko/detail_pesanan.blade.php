<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('page_title')</title>
    <!-- Masukkan CSS Bootstrap dan CSS lain yang dibutuhkan -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
</head>
<body>
@yield('content')
<div class="container mt-4">
    <h3 class="mb-4 fw-bold" style="color: #2B3674; font-size: 23px; letter-spacing: 1.2px;">
        Detail Pesanan #{{ $pesanan->IdTransaksi }}
    </h3>

    <div class="card shadow-sm border-0 rounded-4 p-4 mx-auto" style="max-width: 800px; width: 100%; background-color: #ffffff;">
        <div class="card-body px-4 py-3">
            <div class="row mb-3">
                <div class="col-sm-4 fw-semibold text-secondary">Nama Pembeli</div>
                <div class="col-sm-8">{{ $pesanan->user ? $pesanan->user->f_name : '-' }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4 fw-semibold text-secondary">Username</div>
                <div class="col-sm-8">{{ $pesanan->username }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4 fw-semibold text-secondary">Alamat Pembeli</div>
                <div class="col-sm-8">{{ $pesanan->user ? $pesanan->user->alamat : '-' }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4 fw-semibold text-secondary">Nomor Telepon</div>
                <div class="col-sm-8">{{ $pesanan->user ? $pesanan->user->nomor_telepon : '-' }}</div>
            </div>
            <hr>
            <div class="row mb-3">
                <div class="col-sm-4 fw-semibold text-secondary">Bayar</div>
                <div class="col-sm-8">Rp {{ number_format($pesanan->Bayar, 0, ',', '.') }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4 fw-semibold text-secondary">Sisa Bayar</div>
                <div class="col-sm-8">Rp {{ number_format($pesanan->SisaBayar ?? 0, 0, ',', '.') }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4 fw-semibold text-secondary">Kembalian</div>
                <div class="col-sm-8">Rp {{ number_format($pesanan->Kembali ?? 0, 0, ',', '.') }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4 fw-semibold text-secondary">Grand Total</div>
                <div class="col-sm-8">Rp {{ number_format($pesanan->GrandTotal, 0, ',', '.') }}</div>
            </div>
            <hr>
            <div class="row mb-3">
                <div class="col-sm-4 fw-semibold text-secondary">Tanggal Transaksi</div>
                <div class="col-sm-8">{{ \Carbon\Carbon::parse($pesanan->tglTransaksi)->format('d M Y H:i') }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4 fw-semibold text-secondary">Status Pembayaran</div>
                <div class="col-sm-8">{{ $pesanan->StatusPembayaran }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4 fw-semibold text-secondary">Status Pesanan</div>
                <div class="col-sm-8">{{ $pesanan->StatusPesanan }}</div>
            </div>
            <div class="row">
                <div class="col-sm-4 fw-semibold text-secondary">Tanggal Update</div>
                <div class="col-sm-8">{{ $pesanan->tglUpdate ? \Carbon\Carbon::parse($pesanan->tglUpdate)->format('d M Y H:i') : '-' }}</div>
            </div>
        </div>
    </div>

   <div class="d-flex justify-content-start mt-4">
    <a href="{{ url('/pesanan') }}" class="btn btn-outline-primary px-4">Kembali</a>
</div>

</div>
</body>
</html>
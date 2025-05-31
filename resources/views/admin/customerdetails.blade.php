@extends('admin.layouts.template')

@section('page_title')
CIME | Detail Pelanggan
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Detail</span> Pelanggan</h4>
    <div class="card">
        <h5 class="card-header fw-bold">Informasi Pelanggan</h5>
        <div class="card-body">
            <p><strong>ID Pelanggan:</strong> {{ $customer->id }}</p>
            <p><strong>Nama Lengkap:</strong> {{ $customer->f_name }}</p>
            <p><strong>Email:</strong> {{ $customer->email }}</p>
            <p><strong>Nomor Telepon:</strong> {{ $customer->nomor_telepon }}</p>
            <p><strong>Alamat:</strong> {{ $customer->alamat }}</p>
            {{-- Tambahkan informasi lain yang mungkin ada di model Customer Anda --}}
            {{-- Contoh: --}}
            {{-- <p><strong>Tanggal Bergabung:</strong> {{ $customer->created_at->format('d M Y') }}</p> --}}

            <h6 class="mt-4">Informasi Tambahan untuk Pengiriman:</h6>
            <ul>
                <li>**Catatan Khusus Pengiriman:** {{ $customer->catatan_pengiriman ?? 'Tidak ada' }}</li>
                <li>**Preferensi Waktu Pengiriman:** {{ $customer->preferensi_waktu_pengiriman ?? 'Tidak ada' }}</li>
                <li>**Jenis Bangunan:** {{ $customer->jenis_bangunan ?? 'Tidak ada' }}</li>
                <li>**Instruksi Khusus (misal: "ketuk pintu 3x"):** {{ $customer->instruksi_khusus ?? 'Tidak ada' }}</li>
                {{-- Anda perlu memastikan kolom-kolom ini ada di tabel 'customers' atau tabel terkait lainnya --}}
                {{-- Jika tidak ada, Anda bisa menambahkan kolom baru ke tabel 'customers' melalui migrasi Laravel --}}
            </ul>

            {{-- Jika Anda ingin menampilkan riwayat transaksi pelanggan di sini: --}}
            {{-- @if ($customer->transaksis->isNotEmpty())
                <h6 class="mt-4">Riwayat Transaksi:</h6>
                <table class="table table-bordered mt-2">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Tanggal</th>
                            <th>Grand Total</th>
                            <th>Status Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customer->transaksis as $transaksi)
                            <tr>
                                <td>{{ $transaksi->IdTransaksi }}</td>
                                <td>{{ $transaksi->tglTransaksi->format('d M Y') }}</td>
                                <td>Rp{{ number_format($transaksi->GrandTotal, 0, ',', '.') }}</td>
                                <td>{{ $transaksi->StatusPesanan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="mt-4">Pelanggan ini belum memiliki riwayat transaksi.</p>
            @endif --}}

            <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Kembali ke Daftar Transaksi</a>
        </div>
    </div>
</div>
@endsection

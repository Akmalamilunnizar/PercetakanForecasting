    @extends('toko.layouts.template')

    @section('page_title')
        CIME | Dashboard Toko Online
    @endsection

    @section('content')
    <!-- Section: Daftar Pesanan -->
    <div class="container mt-4">
        <h3 class="mb-4 fw-bold" style="color: #2B3674; font-size: 23px;">Daftar Pesanan</h3>
        <div class="row">
            @forelse ($transaksi as $item)
                <div class="col-md-6 mb-4"> <!-- Bikin card lebih besar, 2 per baris -->
                    <div class="card h-100 shadow border-0 rounded-4 p-4" style="background-color: #ffffff;">
                        <div class="card-body px-4 py-3">
                            <h4 class="fw-bold mb-3" style="color: #2B3674; font-size: 28px; letter-spacing: 1.2px;">
                                ID Transaksi: <span class="text-primary">{{ $item->IdTransaksi }}</span>
                            </h4>
                            <p class="mb-1"><strong>Nama:</strong> {{ $item->user->f_name ?? '-' }}</p>
                            <p class="mb-1"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($item->tglTransaksi)->format('d M Y H:i') }}</p>
                            <p class="mb-1"><strong>Grand Total:</strong> Rp {{ number_format($item->GrandTotal, 0, ',', '.') }}</p>
                            <p class="mb-1"><strong>Status Pembayaran:</strong> {{ $item->StatusPembayaran }}</p>
                            <p class="mb-1"><strong>Status Pesanan:</strong> {{ $item->StatusPesanan }}</p>

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <a href="{{ route('pesanan.detail', $item->IdTransaksi) }}" class="btn btn-primary rounded-pill px-4 py-2">
                                    Detail
                                </a>
                                @if ($item->StatusPesanan == 'Menunggu Konfirmasi')
                                    <button type="button" class="btn btn-success rounded-pill px-4 py-2">
                                        Konfirmasi
                                    </button>
                                @elseif ($item->StatusPesanan == 'Sedang Proses')
                                    <button type="button" class="btn btn-warning rounded-pill px-4 py-2" disabled>
                                        Sedang Proses
                                    </button>
                                @else
                                    <button type="button" class="btn btn-secondary rounded-pill px-4 py-2" disabled>
                                        Selesai
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">Belum ada pesanan.</p>
                </div>
            @endforelse
        </div>
    </div>
    @endsection

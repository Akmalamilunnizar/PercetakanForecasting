<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>CIME | Review Pesanan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="shortcut icon" href="{{ asset('dashboard2/assets/img/icons/logocime.png') }}" type="image/png" />
  <link rel="stylesheet" href="{{ asset('css/order.css') }}" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

  <!-- Stepper -->
  <div class="stepper-wrapper">
    <div class="stepper-item completed" id="step-1">
      <div class="step-counter">1</div>
      <div class="step-name">Cart</div>
    </div>
    <div class="stepper-item completed" id="step-2">
      <div class="step-counter">2</div>
      <div class="step-name">Details</div>
    </div>
    <div class="stepper-item completed" id="step-3">
      <div class="step-counter">3</div>
      <div class="step-name">Shipping</div>
    </div>
    <div class="stepper-item completed" id="step-4">
      <div class="step-counter">4</div>
      <div class="step-name">Payment</div>
    </div>
    <div class="stepper-item active" id="step-5">
      <div class="step-counter">5</div>
      <div class="step-name">Review</div>
    </div>
  </div>

  <div class="container py-4">
    <div class="row">
      <!-- Daftar Produk (Kiri) -->
      <div class="col-lg-8">
        <h4 class="fw-bold mb-4">Review Produk</h4>

        @if(session('cart') && count(session('cart')) > 0)
          @php $total = 0; @endphp
          @foreach(session('cart') as $id => $details)
            @php
              $subtotal = $details['harga'] * $details['quantity'];
              $total += $subtotal;
            @endphp
            <div class="border-bottom pb-4 mb-4 d-flex">
              <div class="me-3">
                <img src="{{ asset('storage/' . $details['img']) }}" alt="{{ $details['nama'] }}" style="width: 220px; height: auto; border-radius: 10px;" />
              </div>
              <div class="flex-grow-1">
                <h5 class="mb-1" style="font-size: 20px; font-weight: bold;">{{ $details['nama'] }}</h5>
                <div class="text-muted small mb-1" style="font-size: 16px;">File: <span class="text-danger">{{ $details['file'] ?? 'buklet.jpg' }}</span></div>
                <div class="text-muted small mb-1" style="font-size: 16px;">Cetak: {{ $details['cetak'] ?? '1 Sisi' }}</div>
                <div class="text-muted small mb-1" style="font-size: 16px;">Tipe: {{ $details['tipe'] ?? 'Standard' }}</div>
                <div class="text-muted small mb-1" style="font-size: 16px;">Finishing: {{ $details['finishing'] ?? '-' }}</div>

                <div class="fw-bold text-primary mt-2" style="font-size: 24px;">
                  Rp {{ number_format($subtotal, 0, ',', '.') }}
                </div>
              </div>
              <div class="text-center ms-4">
                <label class="fw-bold">Jumlah</label>
                <div class="form-control text-center" style="width: 100px; margin: auto;">
                  {{ $details['quantity'] }}
                </div>
              </div>
            </div>
          @endforeach
        @else
          <div class="alert alert-info">
            Keranjang kosong. <a href="{{ route('tokodashboard') }}">Kembali ke Katalog</a>
          </div>
        @endif
      </div>

      <!-- Ringkasan (Kanan) -->
      <div class="col-lg-4">
        <div class="card shadow-sm rounded-4 p-4 sticky-top" style="top: 100px;">
          <h6 class="text-muted mb-2">Subtotal</h6>
          <h4 class="fw-bold">Rp {{ number_format($total ?? 0, 0, ',', '.') }}</h4>
          <hr />
          <div class="mb-3">
            <span class="badge bg-primary">Note</span>
            <small class="text-muted">Tambahkan catatan untuk pesananmu</small>
            <textarea class="form-control mt-2" rows="4" placeholder="Contoh: Mohon dikirim cepat ya..."></textarea>
          </div>

          <div class="d-flex justify-content-between">
            <a href="{{ route('payment') }}" class="btn btn-secondary me-2 w-50">Back</a>
            <a href="{{ route('tokodashboard') }}" class="btn btn-danger w-50">Konfirmasi Pesanan</a>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>

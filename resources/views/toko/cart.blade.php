<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8">
    <title> CIME | Toko Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('dashboard2/assets/img/icons/logocime.png') }}" type="image/png" />
    <link rel="stylesheet" href="{{ asset('css/order.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </head>

  <body>

    <!-- Stepper -->
    <div class="stepper-wrapper">
      <div class="stepper-item active" id="step-1">
        <div class="step-counter">1</div>
        <div class="step-name">Cart</div>
      </div>
      <div class="stepper-item" id="step-2">
        <div class="step-counter">2</div>
        <div class="step-name">Details</div>
      </div>
      <div class="stepper-item" id="step-3">
        <div class="step-counter">3</div>
        <div class="step-name">Shipping</div>
      </div>
      <div class="stepper-item" id="step-4">
        <div class="step-counter">4</div>
        <div class="step-name">Payment</div>
      </div>
      <div class="stepper-item" id="step-5">
        <div class="step-counter">5</div>
        <div class="step-name">Review</div>
      </div>
    </div>

    <!-- Form -->
    <div class="container py-4">
      <div class="row">
        <!-- Kiri: Daftar Produk -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Berhasil!</strong> {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
        @endif

        <div class="col-lg-8">
          <h4 class="fw-bold mb-4">Produk</h4>
          @if(session('cart') && count(session('cart')) > 0)
            {{-- Daftar produk tampil seperti biasa --}}
            @php $total = 0; @endphp
            @foreach (session('cart') as $id => $details)
              {{-- kode yang kamu sudah buat di atas --}}
            @endforeach
          @else
            {{-- Jika keranjang kosong --}}
            <div class="alert alert-info alert-dismissible fade show" role="alert">
              <strong>Keranjang kosong!</strong> Silakan pilih produk terlebih dahulu.
              <a href="{{ route('tokodashboard') }}" class="alert-link">Kembali ke Katalog</a>.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          @php $total = 0; @endphp
          @foreach (session('cart') as $id => $details)
            @php 
              $subtotal = $details['harga'] * $details['quantity']; 
              $total += $subtotal;
            @endphp
            <div class="border-bottom pb-4 mb-4 d-flex">
              <!-- Gambar -->
              <div class="me-3">
                <img src="{{ asset('storage/' . $details['img']) }}" alt="{{ $details['nama'] }}" style="width: 220px; height: auto; border-radius: 10px;">
              </div>

              <!-- Detail Produk -->
              <div class="flex-grow-1">
                <h5 class="mb-1" style="font-size: 20px; font-weight: bold;">{{ $details['nama'] }}</h5>
                <div class="text-muted small mb-1" style="font-size: 16px;">File: <span class="text-danger">{{ $details['file'] ?? ' buklet.jpg' }}</span></div>
                <div class="text-muted small mb-1" style="font-size: 16px;">Cetak: {{ $details['cetak'] ?? '1 Sisi' }}</div>
                <div class="text-muted small mb-1" style="font-size: 16px;">Tipe:  {{ $details['tipe'] ?? 'Standard' }}</div>
                <div class="text-muted small mb-1" style="font-size: 16px;">Finishing: {{ $details['finishing'] ?? '-' }}</div>

                <!-- Harga -->
                <div class="fw-bold text-primary mt-2" style="font-size: 24px;">Rp {{ number_format($details['harga'] * $details['quantity'], 0, ',', '.') }}</div>
              </div>

              <!-- Jumlah & Hapus -->
              <div class="text-center ms-4">
                <label class="fw-bold">Jumlah</label>
                <div class="input-group mb-2" style="width: 100px; margin: auto;">
                  <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex">
                    @csrf
                    <input type="hidden" name="type" value="decrease">
                    <button class="btn btn-outline-secondary btn-sm" type="submit">-</button>
                  </form>

                  <input type="number" class="form-control form-control-sm text-center" value="{{ $details['quantity'] }}" readonly>

                  <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex">
                    @csrf
                    <input type="hidden" name="type" value="increase">
                    <button class="btn btn-outline-secondary btn-sm" type="submit">+</button>
                  </form>
                </div>

                <!-- Trigger button -->
                <button type="button" class="btn btn-link text-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $id }}">
                  ✖ Remove
                </button>

                <!-- Modal -->
                <div class="modal fade" id="confirmDeleteModal{{ $id }}" tabindex="-1" aria-labelledby="confirmDeleteLabel{{ $id }}" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4 shadow-lg border-0">
                      <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title text-danger" id="confirmDeleteLabel{{ $id }}">
                          <i class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Hapus
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                      </div>
                      <div class="modal-body text-center">
                        <i class="bi bi-trash3 display-4 text-danger mb-3"></i>
                        <p class="fs-5">Apakah Anda yakin ingin menghapus produk ini dari keranjang?</p>
                      </div>
                      <div class="modal-footer border-0 d-flex justify-content-between px-4">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                          @csrf
                          <button type="submit" class="btn btn-danger rounded-pill px-4">Hapus</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          @endforeach

         </div>

        <!-- Kanan: Ringkasan -->
        <div class="col-lg-4">
          <div class="card shadow-sm rounded-4 p-4 sticky-top" style="top: 100px;">
            <h6 class="text-muted mb-2">Subtotal</h6>
            <h4 class="fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</h4>
            <hr>
            <div class="mb-3">
              <span class="badge bg-primary">Note</span> <small class="text-muted">Additional comments</small>
              <textarea class="form-control mt-2 border-danger-subtle" rows="4"></textarea>
            </div>
            <a href="{{ route('details') }}" class="btn btn-danger w-100 shadow">
              <i class="bi bi-credit-card me-2"></i> Proses Checkout
            </a>
          </div>
        </div>
      </div>

      <!-- Button Back -->
      <a href="{{ route('tokodashboard') }}" class="btn-back" style="margin-right: 20px;">Back</a>
      <!-- Button Next
      <a href="{{ route('details') }}" class="btn-next">Next</a> -->

    </div>
  </div>

  <script>
    function goToNextStep() {
      // Cek step mana yang aktif
      let activeStep = document.querySelector('.stepper-item.active');

      // Hapus class active dari langkah saat ini
      activeStep.classList.remove('active');

      // Dapatkan langkah berikutnya
      let nextStep = activeStep.nextElementSibling;

      // Jika ada langkah berikutnya, tambahkan class active
      if (nextStep) {
        nextStep.classList.add('active');
      }
    }
  </script>

</body>
</html>

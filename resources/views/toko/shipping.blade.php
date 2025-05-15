<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title> CIME | Toko Online</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="{{ asset('dashboard2/assets/img/icons/logocime.png') }}" type="image/png" />
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="{{ asset('css/order.css') }}" />
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
  <div class="stepper-item active" id="step-3">
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

<div class="row justify-content-center align-items-start g-4">
       <!-- Shipping Selection -->
  <div class="col-lg-5">
    <div class="card shadow-sm">
      <div class="card-body">
        <h5 class="mb-3">Pilih Pengiriman</h5>
        <div class="mb-3">
          <button class="btn btn-outline-secondary me-2">Kurir</button>
          <button class="btn btn-outline-secondary">Self Pickup</button>
        </div>
        <div class="table-responsive">
          <table class="table align-middle">
            <thead class="table-light">
              <tr>
                <th>JENIS PENGIRIMAN</th>
                <th>DURASI</th>
                <th>BIAYA</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Reguler</td>
                <td>2-3 hari</td>
                <td>Rp 20.000</td>
              </tr>
              <tr>
                <td>Express</td>
                <td>1 hari</td>
                <td>Rp 35.000</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="d-flex justify-content-between mt-4">
             <!-- Button Back -->
     <a href="{{ route('details') }}" class="btn-back" style="margin-right: 20px;">Back</a>
    <!-- Button Next
     <a href="{{ route('payment') }}" class="btn-next">Next</a> -->
     <a href="{{ route('payment') }}" class="btn btn-danger w-30 shadow">
                    <i class="bi bi-credit-card me-2"></i> Pilih Pengiriman
                </a>

  
        </div>
      </div>
    </div>
  </div>

  <!-- Kanan: Ringkasan -->
<div class="col-lg-4">
    <div class="card shadow-sm rounded-4 p-4 sticky-top" style="top: 100px;">
        <h5 class="fw-bold mb-3">Order summary</h5>

        @php $total = 0; $total_berat = 0; @endphp
        @foreach (session('cart') as $id => $details)
            @php 
                $subtotal = $details['harga'] * $details['quantity'];
                $total += $subtotal;
                $total_berat += ($details['berat'] ?? 0) * $details['quantity'];   
                @endphp
            <div class="d-flex mb-3 border-bottom pb-2">
                <img src="{{ asset('storage/' . $details['img']) }}" alt="{{ $details['nama'] }}" style="width: 55px; height: 55px; object-fit: cover; border-radius: 8px;" class="me-3">
                <div class="flex-grow-1">
                    <div class="fw-semibold">{{ $details['nama'] }}</div>
                    <div class="text-primary">Rp {{ number_format($details['harga'], 0, ',', '.') }} <span class="text-muted">× {{ $details['quantity'] }}</span></div>
                </div>
            </div>
        @endforeach

        <!-- Total -->
        <div class="mt-4">
            <div class="d-flex justify-content-between">
                <span class="text-muted">Subtotal:</span>
                <span class="fw-semibold">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <div class="d-flex justify-content-between">
                <span class="text-muted">Berat:</span>
                <span>{{ number_format($total_berat / 1000, 2) }} Kg</span> {{-- jika berat gram --}}
            </div>
        </div>
        <hr>
        <!-- Checkout Button -->
        <a href="{{ route('payment') }}" class="btn btn-danger w-100 shadow">
            <i class="bi bi-credit-card me-2"></i> Proses Checkout
        </a>
       <!-- Subtotal Besar di Tengah -->
      <div class="text-center mb-4" style="margin-top: 20px;">
          <span class="fw-bold" style="font-size: 30px;">Rp {{ number_format($total, 0, ',', '.') }}</span>
      </div>  
      </div>

        
      </div>
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

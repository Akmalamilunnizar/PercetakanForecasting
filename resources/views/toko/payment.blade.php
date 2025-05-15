<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title> CIME | Toko Online</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="{{ asset('dashboard2/assets/img/icons/logocime.png') }}" type="image/png" />
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
  <div class="stepper-item completed" id="step-3">
    <div class="step-counter">3</div>
    <div class="step-name">Shipping</div>
  </div>
  <div class="stepper-item active" id="step-4">
    <div class="step-counter">4</div>
    <div class="step-name">Payment</div>
  </div>
  <div class="stepper-item" id="step-5">
    <div class="step-counter">5</div>
    <div class="step-name">Review</div>
  </div>
</div>

  <!-- Form -->
<div class="form-container" style="max-width: 1000px; width: 1000px; padding: 50px;">
<h5 class="mb-4" style="font-size: 24px; font-weight: bold;">Pilih Metode Pembayaran</h5>

<div class="mb-4">
  <label style="cursor:pointer; display:flex; align-items:center; gap:10px; padding:10px; border:1px solid #ccc; border-radius:8px;">
    <input type="radio" name="payment_category" value="virtual_account" style="transform: scale(1.3);">
    <div>
      <h6 style>Virtual Account</h6>
      <div class="d-flex gap-3 flex-wrap">
        <img src="{{ asset('dashboard2/assets/img/imgtoko/bri.png') }}" alt="bri" style="height: 40px;">
        <img src="{{ asset('dashboard2/assets/img/imgtoko/bca.png') }}" alt="bca" style="height: 40px;">
      </div>
    </div>
  </label>
</div>

<div class="mb-4">
  <label style="cursor:pointer; display:flex; align-items:center; gap:10px; padding:10px; border:1px solid #ccc; border-radius:8px;">
    <input type="radio" name="payment_category" value="online_payment" style="transform: scale(1.3);">
    <div>
      <h6>Online Payment</h6>
      <div class="d-flex gap-3 flex-wrap">
        <img src="{{ asset('dashboard2/assets/img/imgtoko/qris.png') }}" alt="Qris" style="height: 40px;">
        <img src="{{ asset('dashboard2/assets/img/imgtoko/gopay.png') }}" alt="GoPay" style="height: 40px;">
        <img src="{{ asset('dashboard2/assets/img/imgtoko/ovo.png') }}" alt="OVO" style="height: 40px;">
        <img src="{{ asset('dashboard2/assets/img/imgtoko/dana.png') }}" alt="DANA" style="height: 40px;">
      </div>
    </div>
  </label>
</div>

<div style="margin-top:40px;">
  <a href="{{ route('shipping') }}" class="btn-back" style="margin-right: 20px;">Back</a>
  <a href="{{ route('review') }}" class="btn-next" style="margin-right: 20px;">Review Pesanan</a>
</div>

</form>
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

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
  <div class="stepper-item active" id="step-2">
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
  <div class="form-container" style="max-width: 1000px; width: 1000px; padding: 50px;">
  <h5 class="mb-4">Alamat Pengiriman</h5>
  <form>
    <div class="mb-3">
      <label for="labelAlamat" class="form-label">Label Alamat</label>
      <input type="text" class="form-control" id="labelAlamat" placeholder="Rumah / Kantor / Lainnya">
    </div>
    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="namaPenerima" class="form-label">Nama Penerima</label>
        <input type="text" class="form-control" id="namaPenerima">
      </div>
      <div class="col-md-6 mb-3">
        <label for="nomorTelepon" class="form-label">Nomor Telepon</label>
        <input type="text" class="form-control" id="nomorTelepon">
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 mb-3">
        <label for="kota" class="form-label">Kota / Kecamatan</label>
        <input type="text" class="form-control" id="kota" placeholder="Masukkan nama kota/kecamatan">
      </div>
      <div class="col-md-4 mb-3">
        <label for="kodePos" class="form-label">Kode Pos</label>
        <input type="text" class="form-control" id="kodePos">
      </div>
    </div>
    <div class="mb-3">
      <label for="alamatLengkap" class="form-label">Alamat Lengkap</label>
      <textarea class="form-control" id="alamatLengkap" rows="3"></textarea>
    </div>
    <!-- <button type="submit" class="btn btn-simpan">Simpan</button> -->
     
    <!-- Button Back -->
    <a href="{{ route('cart') }}" class="btn-baack" style="margin-right: 20px;">Back</a>
    <!-- Button Next -->
    <a href="{{ route('shipping') }}" class="btn-next">Next</a>
   
  
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

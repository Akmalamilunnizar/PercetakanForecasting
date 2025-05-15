<!doctype html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
  data-assets-path="../assets/" data-template="vertical-menu-template-free" data-style="light">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>CIME | Halaman Login</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('dashboard2/assets/img/icons/logocime.png') }}" type="image/png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

  <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="../css/demo.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


  <!-- Custom CSS -->
  <style>
    body {
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
      background: url('{{ asset('assets/images/baground1.jpg') }}') no-repeat center center fixed;
      background-size: cover;
    }

    body::after {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.4); /* nilai opacity bisa kamu sesuaikan */
      z-index: -1;
    }


    .main-container {
      display: flex;
      width: 90%;
      max-width: 1200px;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
      overflow: hidden;
    }

    .left-section {
      flex: 1;
      padding: 2rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .right-section {
      flex: 1;
      background: linear-gradient(135deg,rgb(88, 93, 255),rgb(227, 224, 255));
      color: white;
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .right-section img {
      max-width: 310px;
      margin-bottom: 1rem;
    }

    .right-section h1 {
      font-size: 2.5rem;
      margin-bottom: 1rem;
      color: white;
      font-weight: bold;
      font-family: 'Times New Roman', Times, serif;
    }

    .right-section p {
      font-size: 1.6rem;
      font-family: 'Times New Roman', Times, serif;
    }

    .logo-link {
      position: absolute;
      top: 20px;
      left: 20px;
      z-index: 1000;
    }

    .logo {
      width: 200px;
      height: auto;
    }
  </style>
</head>

  <body>
    <a href="/" style="position: absolute; top: 20px; left: 20px; z-index: 1000;">
    <img src="{{ asset('dashboard2/assets/img/icons/logocime.png') }}" alt="Logo" style="width: 120px; height: auto;" />
  </a>
  <div class="main-container">
    <div class="left-section">
      <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <i class="fas fa-envelope me-2"></i>
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Harap masukkan email" autofocus />
          </div>
          <div class="mb-3 form-password-toggle">
            <i class="fas fa-lock me-2"></i>
            <label class="form-label" for="password">Password</label>
            <div class="input-group input-group-merge">
              <input type="password" id="password" class="form-control" name="password"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                aria-describedby="password" />
              <span class="input-group-text" id="toggle-password">
                <i class="bx bx-hide" id="icon"></i>
              </span>
            </div>
<<<<<<< HEAD
          </div>
        <div class="mb-3">
        <div class="d-flex justify-content-between align-items-center">
          <!-- <div class="form-check mb-0">
            <input class="form-check-input" type="checkbox" id="remember-me" />
            <label class="form-check-label" for="remember-me"> Simpan Login </label>
          </div> -->
          <div>
            <a href="{{ route('password.request') }}" style="color:rgb(0, 0, 0); text-decoration: none;">Lupa Password?</a>
=======
            <!-- <a href="forgotpw"><span>Lupa Password?</span></a> -->
            @if (Route::has('password.request'))
                        <a class="text-sm text-blue-500 hover:underline" href="{{ route('password.request') }}">
                            {{ __('Lupa Password?') }}
                        </a>
                    @endif
>>>>>>> af08a956adf25438556d3e9c50189b3108352ae7
          </div>
        </div>
      </div>

      <button class="btn d-grid w-100" type="submit" style="background-color:rgb(56, 135, 255); color: #fff; border: none;">
        Login
      </button>

      <p class="text-center mt-3">
        <span>Tidak punya akun?</span>
        <a href="register" style="color:rgb(0, 0, 0); text-decoration: none;">Register</a>
      </p>

      </form>
    </div>
    <script>
      // Ambil elemen input dan ikon
      const togglePassword = document.querySelector('#toggle-password');
      const passwordField = document.querySelector('#password');
      const icon = document.querySelector('#icon');

      // Fungsi untuk toggle password visibility
      togglePassword.addEventListener('click', function () {
        // Cek apakah password sedang ditampilkan atau disembunyikan
        const type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;

        // Ubah ikon sesuai dengan status visibility password
        if (type === 'password') {
          icon.classList.remove('bx-show');
          icon.classList.add('bx-hide');
        } else {
          icon.classList.remove('bx-hide');
          icon.classList.add('bx-show');
        }
      });
    </script>

    <!-- Logo dan Informasi -->
    <div class="right-section">
      <h1>CITRA MEDIA</h1>
      <p>Optimasi Manajemen Stok di Industri Percetakan Menggunakan Prediksi Penjualan</p>
      <img src="{{ asset('dashboard2/assets/img/imgtoko/print2.png') }}" alt="" />
    </div>
  </div>


</body>

</html>

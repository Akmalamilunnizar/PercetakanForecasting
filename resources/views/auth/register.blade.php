<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>CIME | Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('dashboard2/assets/img/icons/logocime.png') }}" type="image/png" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans&display=swap" rel="stylesheet" />

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Public Sans', sans-serif;
      background: url('{{ asset('assets/images/baground1.png') }}') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

    .logo {
      margin-bottom: 30px;
      transform: scale(1.2);
      animation: floatZoom 4s ease-in-out infinite;
    }

    .logo img {
      max-width: 300px;
      height: auto;
    }

    .login-card {
      background: #fff;
      border-radius: 12px;
      padding: 30px 40px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      min-height: 500px;
    }

    .login-card h2 {
      text-align: center;
      margin-bottom: 25px;
      font-weight: bold;
      color: #333;
      font-family: 'Times New Roman', Times, serif;
    }

    .login-card input[type="text"],
    .login-card input[type="password"],
    .login-card input[type="tel"],
    .login-card textarea {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #ddd;
      border-radius: 8px;
      transition: all 0.3s ease;
      outline: none;
      font-family: 'Public Sans', sans-serif;
      font-size: 1rem;
    }

    .login-card input:focus,
    .login-card textarea:focus {
      border-color: #80bdff;
      box-shadow: 0 0 8px rgba(128, 189, 255, 0.7);
    }

    .login-card textarea {
      resize: vertical;
      min-height: 80px;
    }

    .login-card button {
      width: 100%;
      padding: 12px;
      background-color: #3887ff;
      border: none;
      color: #fff;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
    }

    .login-card button:hover {
      background-color: #1e6fe2;
    }

    .login-card p {
      text-align: center;
      margin-top: 20px;
      font-size: 0.9rem;
    }

    .login-card a {
      color: #333;
      text-decoration: none;
    }

    .login-card a:hover {
      text-decoration: underline;
    }

    .alert {
      padding: 10px;
      background-color: #f44336;
      color: white;
      border-radius: 5px;
      margin-bottom: 20px;
    }

    .alert-success {
      background-color: #4CAF50;
    }

    .alert ul {
      margin: 0;
      padding-left: 20px;
    }

    @keyframes floatZoom {
      0% {
        transform: translateY(0) scale(1);
      }

      50% {
        transform: translateY(-10px) scale(1.05);
      }

      100% {
        transform: translateY(0) scale(1);
      }
    }
  </style>
</head>

<body>

  <!-- Logo Tengah -->
  <div class="logo">
    <img src="{{ asset('dashboard2/assets/img/icons/logocime.png') }}" alt="Logo">
  </div>

  <!-- Card Register -->
  <div class="login-card">
    <h2>Register</h2>

    @if ($errors->any() || session('error') || session('success'))
    <script>
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 9000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer);
          toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
      });

      @if ($errors->any())
      @foreach ($errors->all() as $error)
      Toast.fire({
        icon: 'error',
        title: 'Gagal !',
        text: 'Register gagal !'
      });
      @endforeach
      @endif

      @if (session('error'))
      Toast.fire({
        icon: 'error',
        title: 'Gagal !',
        text: 'Register gagal !'
      });
      @endif

      @if (session('success'))
      Toast.fire({
        icon: 'success',
        title: 'Berhasil !',
        text: 'Register berhasil, Silahkan Login !'
      });
      @endif
    </script>
    @endif

    <form action="{{ url('register') }}" method="POST">
      @csrf
      <input type="text" name="f_name" placeholder="Nama Lengkap" value="{{ old('f_name') }}" autofocus required>
      @error('f_name')
      <span style="color: red;">{{ $message }}</span>
      @enderror

      <input type="text" name="email" placeholder="Email" value="{{ old('email') }}" required>
      @error('email')
      <span style="color: red;">{{ $message }}</span>
      @enderror

      <input type="tel" name="nomor_telepon" placeholder="Nomor Telepon (081234567890)" value="{{ old('nomor_telepon') }}" required pattern="[0-9]*" minlength="10" maxlength="15">
      @error('nomor_telepon')
      <span style="color: red;">{{ $message }}</span>
      @enderror

      <textarea name="alamat" placeholder="Alamat Lengkap" required>{{ old('alamat') }}</textarea>
      @error('alamat')
      <span style="color: red;">{{ $message }}</span>
      @enderror

      <input type="password" name="password" placeholder="Password" required>
      @error('password')
      <span style="color: red;">{{ $message }}</span>
      @enderror

      <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
      @error('password_confirmation')
      <span style="color: red;">{{ $message }}</span>
      @enderror

      <button type="submit">Daftar</button>

      <p>
        Sudah punya akun? <a href="{{ url('login') }}">Login</a>
      </p>
    </form>
  </div>

</body>

</html>

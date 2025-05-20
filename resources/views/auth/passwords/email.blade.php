<!doctype html>
<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>CIME | Lupa Password</title>

    <link rel="shortcut icon" href="{{ asset('dashboard2/assets/img/icons/logocime.png') }}" type="image/png" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="../assets/vendor/css/core.css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" />
    <link rel="stylesheet" href="../css/demo.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

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
            background: rgba(0, 0, 0, 0.4);
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
            background: linear-gradient(135deg, rgb(88, 93, 255), rgb(227, 224, 255));
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
    </style>
</head>

<body>
    <a href="/" style="position: absolute; top: 20px; left: 20px; z-index: 1000;">
        <img src="{{ asset('dashboard2/assets/img/icons/logocime.png') }}" alt="Logo" style="width: 120px; height: auto;" />
    </a>

    <div class="main-container">
        <div class="left-section">
            @if (session('status'))
                <div class="alert alert-success mb-4">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <h4 class="mb-4">Reset Password</h4>
                <p class="text-muted mb-4">
                    Tidak masalah. Cukup masukkan alamat email kamu dan kami akan kirimkan link untuk atur ulang password.
                </p>

                <div class="mb-3">
                    <i class="fas fa-envelope me-2"></i>
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        placeholder="Harap masukkan email" value="{{ old('email') }}" required autofocus />
                </div>

                <button class="btn d-grid w-100" type="submit"
                    style="background-color:rgb(56, 135, 255); color: #fff; border: none;">
                    Kirim Link Reset Password
                </button>

                <p class="text-center mt-3">
                    <a href="{{ route('login') }}" style="color:rgb(0, 0, 0); text-decoration: none;">Kembali ke Login</a>
                </p>
            </form>
        </div>

        <div class="right-section">
            <h1>CITRA MEDIA</h1>
            <p>Optimasi Manajemen Stok di Industri Percetakan Menggunakan Prediksi Penjualan</p>
            <img src="{{ asset('dashboard2/assets/img/imgtoko/print2.png') }}" alt="" />
        </div>
    </div>
</body>

</html>

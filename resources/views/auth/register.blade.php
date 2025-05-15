<!doctype html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>CIME | Halaman Register </title>

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
    <!-- Logo di pojok kiri atas -->
     <a href="/" style="position: absolute; top: 20px; left: 20px; z-index: 1000;">
        <img src="{{ asset('dashboard2/assets/img/icons/logocime.png') }}" alt="Logo" style="width: 120px; height: auto;" />
     </a>

    <div class="main-container">
        <div class="left-section">
            <form action="{{ url('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="f_name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="f_name" name="f_name"
                        placeholder="Masukkan nama lengkap" autofocus />
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email" />
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor Telepon</label>
                    <input type="tel" class="form-control" id="phone" name="phone"
                        placeholder="Masukkan nomor telepon" />
                </div>

                <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password" class="form-control" name="password"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password" />
                        <span class="input-group-text cursor-pointer" id="toggle-password">
                            <i class="bx bx-hide" id="icon-password"></i>
                        </span>
                    </div>
                </div>

                <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password_confirmation" class="form-control"
                            name="password_confirmation" placeholder="Konfirmasi password"
                            aria-describedby="password_confirmation" />
                        <span class="input-group-text cursor-pointer" id="toggle-password-confirmation">
                            <i class="bx bx-hide" id="icon-password-confirmation"></i>
                        </span>
                    </div>
                </div>
                <button class="btn d-grid w-100" type="submit" style="background-color:rgb(56, 135, 255); color: #fff; border: none;">
                    Daftar
                </button>
                <p class="text-center mt-3">
                    <span>Sudah punya akun?</span>
                    <a href="login" style="color:rgb(0, 0, 0); text-decoration: none;"><span>Login</span></a>
                </p>
            </form>
        </div>
        <script>
            // Ambil elemen input dan ikon untuk password
            const togglePassword = document.querySelector('#toggle-password');
            const passwordField = document.querySelector('#password');
            const iconPassword = document.querySelector('#icon-password');

            // Fungsi untuk toggle password visibility
            togglePassword.addEventListener('click', function () {
                const type = passwordField.type === 'password' ? 'text' : 'password';
                passwordField.type = type;

                // Ubah ikon sesuai status password
                if (type === 'password') {
                    iconPassword.classList.remove('bx-show');
                    iconPassword.classList.add('bx-hide');
                } else {
                    iconPassword.classList.remove('bx-hide');
                    iconPassword.classList.add('bx-show');
                }
            });

            // Ambil elemen input dan ikon untuk konfirmasi password
            const togglePasswordConfirmation = document.querySelector('#toggle-password-confirmation');
            const passwordConfirmationField = document.querySelector('#password_confirmation');
            const iconPasswordConfirmation = document.querySelector('#icon-password-confirmation');

            // Fungsi untuk toggle konfirmasi password visibility
            togglePasswordConfirmation.addEventListener('click', function () {
                const type = passwordConfirmationField.type === 'password' ? 'text' : 'password';
                passwordConfirmationField.type = type;

                // Ubah ikon sesuai status konfirmasi password
                if (type === 'password') {
                    iconPasswordConfirmation.classList.remove('bx-show');
                    iconPasswordConfirmation.classList.add('bx-hide');
                } else {
                    iconPasswordConfirmation.classList.remove('bx-hide');
                    iconPasswordConfirmation.classList.add('bx-show');
                }
            });
        </script>

        <!-- Logo dan Informasi -->
        <div class="right-section">
            <h1>CITRA MEDIA</h1>
            <p>Optimasi Manajemen Stok di Industri Percetakan Menggunakan Prediksi Penjualan</p>
            <img src="{{ asset('dashboard2/assets/img/imgtoko/print3.png') }}" alt="" />
        </div>
    </div>
</body>


</html>
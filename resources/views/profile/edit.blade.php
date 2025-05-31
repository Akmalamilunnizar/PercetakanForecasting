<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil | Toko Percetakan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/toko.css') }}" />
    <style>
        body {
            background-color: #f5f8ff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .profile-card {
            background-color: #fff;
            border-radius: 12px; /* Sedikit lebih membulat */
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08); /* Bayangan lebih dalam */
            padding: 40px;
            margin-top: 30px;
        }

        .profile-img-container {
            position: relative;
            width: 150px; /* Ukuran lebih besar */
            height: 150px;
            margin: 0 auto 25px auto;
        }

        .profile-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #4318ff; /* Border lebih tebal */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .file-upload-icon {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background-color: #4318ff;
            color: white;
            border-radius: 50%;
            padding: 8px; /* Padding lebih besar */
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem; /* Ukuran ikon lebih besar */
            transition: background-color 0.3s ease;
        }

        .file-upload-icon:hover {
            background-color: #3614cc;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            border-color: #4318ff;
            box-shadow: 0 0 0 0.25rem rgba(67, 24, 255, 0.25);
        }

        .btn-primary {
            background-color: #4318ff;
            border-color: #4318ff;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #3614cc;
            border-color: #3614cc;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        hr {
            border-top: 1px dashed #e0e0e0; /* Garis putus-putus */
            margin: 40px 0;
        }

        .alert {
            border-radius: 8px;
            margin-bottom: 25px;
        }

        /* Styling untuk form password update */
        .password-update-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #333;
        }

        .password-update-form input[type="email"],
        .password-update-form input[type="password"] {
            width: 100%;
            padding: 10px 15px;
            margin-bottom: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-sizing: border-box; /* Pastikan padding tidak menambah lebar */
        }

        .password-update-form button[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #28a745; /* Warna hijau untuk update password */
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .password-update-form button[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    @include('toko.layouts.template') {{-- Pastikan Anda memasukkan template utama Anda di sini --}}

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="profile-card">
                    <h2 class="mb-5 text-center fw-bold text-primary">Edit Profil Anda</h2>

                    {{-- Pesan Status Profil --}}
                    @if (session('status') === 'profile-updated')
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i> Profil berhasil diperbarui!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if ($errors->profileUpdate->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> Ada kesalahan saat memperbarui profil.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif


                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="text-center mb-4">
                            <div class="profile-img-container">
                                <img id="profile-image-preview"
                                    src="{{ asset($user->img ? 'storage/' . $user->img : 'https://ui-avatars.com/api/?name=' . urlencode($user->f_name) . '&background=4318ff&color=ffffff&size=150') }}"
                                    alt="Profile Picture">
                                <label for="profile-image-upload" class="file-upload-icon">
                                    <i class="bi bi-camera-fill"></i>
                                </label>
                                <input type="file" id="profile-image-upload" name="img" accept="image/*" class="d-none">
                            </div>
                            @error('img')
                                <div class="text-danger mt-1 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="f_name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error('f_name', 'profileUpdate') is-invalid @enderror" id="f_name"
                                    name="f_name" value="{{ old('f_name', $user->f_name) }}" required autofocus>
                                @error('f_name', 'profileUpdate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email', 'profileUpdate') is-invalid @enderror" id="email"
                                    name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email', 'profileUpdate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control @error('nomor_telepon', 'profileUpdate') is-invalid @enderror"
                                    id="nomor_telepon" name="nomor_telepon"
                                    value="{{ old('nomor_telepon', $user->nomor_telepon) }}">
                                @error('nomor_telepon', 'profileUpdate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username', 'profileUpdate') is-invalid @enderror"
                                    id="username" name="username" value="{{ old('username', $user->username) }}" required>
                                @error('username', 'profileUpdate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control @error('alamat', 'profileUpdate') is-invalid @enderror" id="alamat"
                                name="alamat" rows="3">{{ old('alamat', $user->alamat) }}</textarea>
                            @error('alamat', 'profileUpdate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Simpan Perubahan</button>
                        </div>
                    </form>

                    <hr class="my-5">

                    {{-- Form untuk Update Password --}}
                    <h3 class="mb-4 text-center fw-bold text-success">Perbarui Kata Sandi</h3>
                    {{-- Tambahkan blok ini untuk pesan sukses update password --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if ($errors->updatePassword->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> Ada kesalahan saat memperbarui kata sandi.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('profile.password') }}" class="password-update-form">
                        @csrf

                        <div class="mb-3">
                            <label for="password_email" class="form-label">Email</label>
                             <input type="email" id="password_email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="password_new" class="form-label">Password Baru</label>
                            <input type="password" id="password_new" name="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" required>
                            @error('password', 'updatePassword')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" required>
                            @error('password_confirmation', 'updatePassword')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">Perbarui Kata Sandi</button>
                        </div>
                    </form>


                    <hr class="my-5">

                    {{-- Form untuk Hapus Akun --}}
                    <h3 class="mb-4 text-center fw-bold text-danger">Hapus Akun</h3>
                    <p class="text-center text-muted mb-4">Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara
                        permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda
                        simpan.</p>
                    <button type="button" class="btn btn-danger d-grid mx-auto" data-bs-toggle="modal"
                        data-bs-target="#confirmUserDeletionModal">Hapus Akun</button>

                    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1"
                        aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="confirmUserDeletionModalLabel"><i class="bi bi-exclamation-octagon-fill me-2"></i> Konfirmasi Penghapusan Akun</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-danger fw-bold">Apakah Anda yakin ingin menghapus akun Anda secara permanen?</p>
                                    <p>Semua data terkait akun Anda akan dihapus dan tidak dapat dikembalikan. Mohon masukkan kata sandi Anda untuk mengkonfirmasi tindakan ini.</p>
                                    <form id="delete-user-form" method="POST" action="{{ route('profile.destroy') }}">
                                        @csrf
                                        @method('delete')
                                        <div class="mb-3">
                                            <label for="password_delete" class="form-label">Kata Sandi Anda</label>
                                            <input type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" id="password_delete"
                                                name="password" required>
                                            @error('password', 'userDeletion')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" form="delete-user-form" class="btn btn-danger">Ya, Hapus Akun Saya</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('profile-image-upload').addEventListener('change', function (event) {
            const [file] = event.target.files;
            if (file) {
                document.getElementById('profile-image-preview').src = URL.createObjectURL(file);
            }
        });

        // Pastikan modal delete user terbuka kembali jika ada error validasi
        @if ($errors->userDeletion->any())
            var deleteUserModal = new bootstrap.Modal(document.getElementById('confirmUserDeletionModal'));
            deleteUserModal.show();
        @endif
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil | Toko Percetakan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/toko.css') }}" />
    <style>
        body {
            background-color: #f5f8ff;
        }
        .profile-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }
        .profile-img-container {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto 20px auto;
        }
        .profile-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #4318ff;
        }
        .file-upload-icon {
            position: absolute;
            bottom: 0;
            right: 0;
            background-color: #4318ff;
            color: white;
            border-radius: 50%;
            padding: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    @include('toko.layouts.template') {{-- Pastikan Anda memasukkan template utama Anda di sini --}}

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="profile-card">
                    <h2 class="mb-4 text-center">Edit Profil Anda</h2>

                    @if (session('status') === 'profile-updated')
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Profil berhasil diperbarui!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="text-center mb-4">
                            <div class="profile-img-container">
                                <img id="profile-image-preview" src="{{ asset($user->img ? 'storage/' . $user->img : 'https://i.pravatar.cc/120') }}" alt="Profile Picture">
                                <label for="profile-image-upload" class="file-upload-icon">
                                    <i class="bi bi-camera-fill"></i>
                                </label>
                                <input type="file" id="profile-image-upload" name="img" accept="image/*" class="d-none">
                            </div>
                            @error('img')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="f_name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('f_name') is-invalid @enderror" id="f_name" name="f_name" value="{{ old('f_name', $user->f_name) }}" required autofocus>
                            @error('f_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon', $user->nomor_telepon) }}">
                            @error('nomor_telepon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{ old('alamat', $user->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Simpan Perubahan</button>
                        </div>
                    </form>

                    <hr class="my-5">

                    {{-- Form untuk Update Password (Opsional, tapi sangat disarankan) --}}
                    <h3 class="mb-4 text-center">Perbarui Kata Sandi</h3>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Kata Sandi Saat Ini</label>
                            <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" id="current_password" name="current_password" required>
                            @error('current_password', 'updatePassword')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi Baru</label>
                            <input type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" id="password" name="password" required>
                            @error('password', 'updatePassword')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required>
                            @error('password_confirmation', 'updatePassword')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-warning btn-lg">Perbarui Kata Sandi</button>
                        </div>
                    </form>

                    <hr class="my-5">

                    {{-- Form untuk Hapus Akun (Opsional) --}}
                    <h3 class="mb-4 text-center text-danger">Hapus Akun</h3>
                    <p class="text-center">Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.</p>
                    <button type="button" class="btn btn-danger d-grid mx-auto" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">Hapus Akun</button>

                    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmUserDeletionModalLabel">Konfirmasi Penghapusan Akun</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin menghapus akun Anda? Semua data akan dihapus secara permanen. Mohon masukkan kata sandi Anda untuk mengkonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.</p>
                                    <form id="delete-user-form" method="POST" action="{{ route('profile.destroy') }}">
                                        @csrf
                                        @method('delete')
                                        <div class="mb-3">
                                            <label for="password_delete" class="form-label">Kata Sandi</label>
                                            <input type="password" class="form-control" id="password_delete" name="password" required>
                                        </div>
                                        @error('password', 'deleteUser')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" form="delete-user-form" class="btn btn-danger">Hapus Akun</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('profile-image-upload').addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                document.getElementById('profile-image-preview').src = URL.createObjectURL(file);
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
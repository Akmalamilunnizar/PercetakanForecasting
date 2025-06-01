@extends('admin.layouts.template')
@section('page_title')
    CIME | Halaman Daftar Ukuran
@endsection
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fonadmin.layouts.templatet-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <div class="container-xxl flex-grow-1 py-1">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Halaman/</span> Daftar Ukuran</h4>

        @if (session('message'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
            <a href="{{ route('addukuran') }}" class="btn btn-primary" style="border-radius: 8px;">
                <i class="fas fa-plus me-1"></i> Tambah Ukuran
            </a>
        </div>

        <div class="card">
            <h5 class="card-header">Data Ukuran</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th class="fw-bold text-center">No</th>
                            <th class="fw-bold text-center">Nama Ukuran</th>
                            <th class="fw-bold text-center">Panjang</th>
                            <th class="fw-bold text-center">Lebar</th>
                            <th class="fw-bold text-center">Satuan</th>
                            <th class="fw-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($sizes as $index => $size)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $size->nama }}</td>
                                <td class="text-center">{{ $size->panjang }}</td>
                                <td class="text-center">{{ $size->lebar }}</td>
                                <td class="text-center">{{ $size->satuan->Satuan }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('editukuran', $size->id_ukuran) }}" class="btn btn-warning" style="border-radius: 8px;">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                        <a href="{{ route('deleteukuran', $size->id_ukuran) }}" 
                                            class="btn btn-danger" 
                                            style="border-radius: 8px;"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus ukuran ini?')">
                                            <i class="fas fa-trash-alt me-1"></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

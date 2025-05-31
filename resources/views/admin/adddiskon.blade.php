@extends('admin.layouts.template')
@section('page_title', 'Tambah Diskon')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Tambah Diskon</h4>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('storediskon') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Diskon</label>
                    <input type="text" class="form-control" name="nama" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <input type="text" class="form-control" name="description" maxlength="250">
                </div>
                <div class="mb-3">
                    <label for="persentase" class="form-label">Persentase (%)</label>
                    <input type="number" class="form-control" name="persentase" min="0" max="100" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection

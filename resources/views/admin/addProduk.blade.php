@extends('admin.layouts.template')
@section('page_title', 'Tambah Produk')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">Tambah Data Produk</h4>
    <div class="card">
        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form id="add-produk-form" action="{{ route('storeproduk') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <!-- Nama Produk -->
                <div class="mb-3">
                    <label for="NamaProduk" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" name="NamaProduk" value="{{ old('NamaProduk') }}" required>
                </div>
                <!-- Ukuran & Harga per Ukuran -->
                <div class="mb-3">
                    <label class="form-label">Ukuran & Harga per Ukuran</label>
                    <div id="ukuran-harga-list">
                        <div class="row mb-2 ukuran-harga-item">
                            <div class="col-md-6">
                                <select name="sizes[]" class="form-select" required>
                                    <option value="">Pilih Ukuran</option>
                                    @foreach($sizeList as $size)
                                        <option value="{{ $size->id_ukuran }}">
                                            {{ $size->nama }} ({{ $size->panjang }} x {{ $size->lebar }} {{ $size->satuan->Satuan }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="harga_per_size[]" class="form-control" placeholder="Harga" required>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger remove-ukuran-harga">Hapus</button>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="add-ukuran-harga" class="btn btn-secondary btn-sm mt-2">+ Tambah Ukuran</button>
                </div>
                <!-- Custom Harga -->
                <div class="mb-3">
                    <label for="custom_harga" class="form-label">Harga Custom</label>
                    <input type="number" class="form-control" name="custom_harga" value="{{ old('custom_harga') }}" placeholder="Harga custom ukuran" required>
                </div>
                <!-- Bahan -->
                <div class="mb-3">
                    <label for="id_bahan" class="form-label">Bahan</label>
                    <select name="id_bahan" class="form-select" required>
                        <option value="">Pilih Bahan</option>
                        @foreach($bahanList as $bahan)
                            <option value="{{ $bahan->IdBarang }}" {{ old('id_bahan') == $bahan->IdBarang ? 'selected' : '' }}>{{ $bahan->NamaBarang }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Diskon -->
                <div class="mb-3">
                    <label for="diskon" class="form-label">Diskon</label>
                    <select name="diskon" class="form-select">
                        <option value="">Pilih Diskon</option>
                        @foreach($diskonList as $diskon)
                            <option value="{{ $diskon->id }}" {{ old('diskon') == $diskon->id ? 'selected' : '' }}>{{ $diskon->nama }} ({{ $diskon->persentase }}%)</option>
                        @endforeach
                    </select>
                </div>
                <!-- Deskripsi -->
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3" required>{{ old('deskripsi') }}</textarea>
                </div>
                <!-- Gambar -->
                <div class="mb-3">
                    <label for="Img" class="form-label">Gambar</label>
                    <input type="file" class="form-control" name="Img" required>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Produk</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Dynamic add/remove ukuran-harga rows
    document.getElementById('add-ukuran-harga').onclick = function() {
        let list = document.getElementById('ukuran-harga-list');
        let item = list.querySelector('.ukuran-harga-item').cloneNode(true);
        item.querySelector('select').value = '';
        item.querySelector('input').value = '';
        list.appendChild(item);
    };
    document.getElementById('ukuran-harga-list').onclick = function(e) {
        if (e.target.classList.contains('remove-ukuran-harga')) {
            let items = document.querySelectorAll('.ukuran-harga-item');
            if (items.length > 1) e.target.closest('.ukuran-harga-item').remove();
        }
    };
</script>
@endpush

<!-- Bootstrap CSS (in <head>) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Bundle JS (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
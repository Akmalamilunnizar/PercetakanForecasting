@extends('admin.layouts.template')

@section('page_title')
CIME | Halaman Edit Produk
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Halaman /</span> Edit Produk</h4>
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0 fw-bold fs-4">Edit Data Produk</h5>
            </div>
            <div class="card-body">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
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

                <form action="{{ route('updateproduk', $produk->IdProduk) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="IdProduk">ID Produk</label>
                        <div class="col-sm-10">
                            <input type="text" id="IdProduk" name="IdProduk" class="form-control" value="{{ $produk->IdProduk }}" readonly style="background-color: #e9ecef; cursor: default;">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="NamaProduk">Nama Produk</label>
                        <div class="col-sm-10">
                            <input type="text" id="NamaProduk" name="NamaProduk" class="form-control @error('NamaProduk') is-invalid @enderror" value="{{ old('NamaProduk', $produk->NamaProduk) }}" required>
                            @error('NamaProduk')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="custom_harga">Harga Custom</label>
                        <div class="col-sm-10">
                            <input type="number" id="custom_harga" name="custom_harga" class="form-control @error('custom_harga') is-invalid @enderror" value="{{ old('custom_harga', $produk->custom_harga) }}" required>
                            @error('custom_harga')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="sizes">Ukuran & Harga</label>
                        <div class="col-sm-10">
                            <div id="ukuran-harga-list">
                                @foreach($produk->sizes as $i => $size)
                                <div class="row mb-2 ukuran-harga-item">
                                    <div class="col-md-6">
                                        <select name="sizes[]" class="form-select" required>
                                            <option value="">Pilih Ukuran</option>
                                            @foreach($sizeList as $s)
                                                <option value="{{ $s->id_ukuran }}" {{ $size->id_ukuran == $s->id_ukuran ? 'selected' : '' }}>
                                                    {{ $s->nama }} ({{ $s->panjang }} x {{ $s->lebar }} {{ $s->satuan->Satuan }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" name="harga_per_size[]" class="form-control" placeholder="Harga" value="{{ $size->pivot->harga }}" required>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-outline-danger remove-ukuran-harga">Hapus</button>
                                    </div>
                                </div>
                                @endforeach
                                @if($produk->sizes->count() == 0)
                                <div class="row mb-2 ukuran-harga-item">
                                    <div class="col-md-6">
                                        <select name="sizes[]" class="form-select" required>
                                            <option value="">Pilih Ukuran</option>
                                            @foreach($sizeList as $s)
                                                <option value="{{ $s->id_ukuran }}">
                                                    {{ $s->nama }} ({{ $s->panjang }} x {{ $s->lebar }} {{ $s->satuan->Satuan }})
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
                                @endif
                            </div>
                            <button type="button" id="add-ukuran-harga" class="btn btn-outline-secondary btn-sm mt-2">+ Tambah Ukuran</button>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="id_bahan">Bahan</label>
                        <div class="col-sm-10">
                            <select class="form-select @error('id_bahan') is-invalid @enderror" id="id_bahan" name="id_bahan" required>
                                <option value="">Pilih Bahan</option>
                                @foreach($bahanList as $bahan)
                                    <option value="{{ $bahan->IdBarang }}" {{ old('id_bahan', $produk->id_bahan) == $bahan->IdBarang ? 'selected' : '' }}>
                                        {{ $bahan->NamaBarang }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_bahan')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="deskripsi">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="Img">Gambar</label>
                        <div class="col-sm-10">
                            @if($produk->Img)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $produk->Img) }}" alt="Current Image" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            @endif
                            <input class="form-control @error('Img') is-invalid @enderror" type="file" id="Img" name="Img">
                            @error('Img')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-outline-primary">Update Produk</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
@endsection

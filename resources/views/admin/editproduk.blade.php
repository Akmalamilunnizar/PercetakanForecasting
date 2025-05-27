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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
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
                                <input type="text" id="NamaProduk" name="NamaProduk" class="form-control" value="{{ $produk->NamaProduk }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="HargaProduk">Harga Produk</label>
                            <div class="col-sm-10">
                                <input type="number" id="HargaProduk" name="HargaProduk" class="form-control" value="{{ $produk->HargaProduk }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="ukuran">Ukuran</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="ukuran" name="ukuran">
                                    <option value="">Pilih Ukuran</option>
                                    @foreach($sizeList as $size)
                                        <option value="{{ $size->id_ukuran }}" {{ $produk->ukuran == $size->id_ukuran ? 'selected' : '' }}>
                                            {{ $size->nama }} ({{ $size->panjang }} x {{ $size->lebar }} {{ $size->satuan->Satuan }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="bahan">Bahan</label>
                            <div class="col-sm-10">
                                <input type="text" id="bahan" name="bahan" class="form-control" value="{{ $produk->bahan }}" placeholder="Contoh: Flexy, Albatros">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="custom">Custom</label>
                            <div class="col-sm-10">
                                <input type="text" id="custom" name="custom" class="form-control" value="{{ $produk->custom }}" placeholder="Contoh: Ya/Tidak">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="id_bahan">Bahan (Database)</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="id_bahan" name="id_bahan">
                                    <option value="">Pilih Bahan</option>
                                    @foreach($bahanList as $bahan)
                                        <option value="{{ $bahan->IdBarang }}" {{ $produk->id_bahan == $bahan->IdBarang ? 'selected' : '' }}>
                                            {{ $bahan->NamaBarang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="diskon">Diskon</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="diskon" name="diskon">
                                    <option value="">Pilih Diskon</option>
                                    @foreach($diskonList as $diskon)
                                        <option value="{{ $diskon->id }}" {{ $produk->diskon == $diskon->id ? 'selected' : '' }}>
                                            {{ $diskon->nama }} ({{ $diskon->persentase }}%)
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="deskripsi">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required>{{ $produk->deskripsi }}</textarea>
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
                                <input class="form-control" type="file" id="Img" name="Img">
                                <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
                            </div>
                        </div>

                    <!-- Submit Button -->
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
@endsection

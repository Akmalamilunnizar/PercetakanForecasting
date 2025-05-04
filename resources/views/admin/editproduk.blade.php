@extends('admin.layouts.template')

@section('page_title')
    Edit Produk - Percetakan
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Halaman /</span> Edit Produk</h4>
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Edit Data Produk</h5>
                <small class="text-muted float-end">Form Edit</small>
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

                    <!-- ID Produk (tidak dapat diedit) -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="IdProduk">ID Produk</label>
                        <div class="col-sm-10">
                            <input type="text" id="IdProduk" name="IdProduk" class="form-control"
                                value="{{ $produk->IdProduk }}" readonly
                                style="background-color: #e9ecef; cursor: default;">
                        </div>
                    </div>

                    <!-- Nama Produk -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="NamaProduk">Nama Produk</label>
                        <div class="col-sm-10">
                            <input type="text" id="NamaProduk" name="NamaProduk" class="form-control"
                                   value="{{ $produk->NamaProduk }}" required>
                        </div>
                    </div>

                    <!-- Harga Produk -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="HargaProduk">Harga Produk</label>
                        <div class="col-sm-10">
                            <input type="number" id="HargaProduk" name="HargaProduk" class="form-control"
                                   value="{{ $produk->HargaProduk }}" required>
                        </div>
                    </div>

                    <!-- Gambar Produk -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="Img">Gambar Produk</label>
                        <div class="col-sm-10">
                            @if ($produk->Img)
                                <img src="{{ asset('storage/' . $produk->Img) }}" alt="produk gambar" width="100">
                                <br>
                            @endif
                            <input type="file" id="Img" name="Img" class="form-control">
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar</small>
                        </div>
                    </div>

                    <!-- Submit Button -->
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Update Produk</button>
                    </div>
                </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection

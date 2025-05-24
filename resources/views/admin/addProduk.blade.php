@extends('admin.layouts.template')

@section('page_title')
CIME | Halaman Tambah Produk
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Halaman / </span>Tambah Data Produk</h4>
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                 <h5 class="mb-0 fw-bold fs-4">Tambah Data Produk</h5>
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

                <form action="{{ route('storeproduk') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="IdProduk">ID Produk</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="IdProduk" name="IdProduk" value="{{$newId}}" readonly/>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="NamaProduk">Nama Produk</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="NamaProduk" name="NamaProduk" placeholder="Banner" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="HargaProduk">Harga Produk</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="HargaProduk" name="HargaProduk" placeholder="5000" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="Img">Gambar</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="file" id="Img" name="Img" />
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-outline-primary">
                                Tambah Produk
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

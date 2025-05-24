@extends('admin.layouts.template')
@section('page_title')
CIME | Halaman Tambah Data Barang
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Halaman/</span>Tambah Data Barang</h4>
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0 fw-bold fs-4">Tambah Data Barang</h5>
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
                <form action="{{ route('store-item') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Username Admin</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="username" name="username" value="{{ $username }}" readonly/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Id Masuk</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="IdMasuk" name="IdMasuk" value="{{ $newIdMasuk }}" readonly />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Supplier</label>
                        <div class="col-sm-10">
                        <select class="form-select" id="IdSupplier" name="IdSupplier">
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->IdSupplier }}">{{ $supplier->NamaSupplier }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Kuantitas Masuk</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="QtyMasuk" name="QtyMasuk" placeholder="50" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Harga Satuan</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="HargaSatuan" name="HargaSatuan" placeholder="55000" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Sub Total</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="SubTotal" name="SubTotal" placeholder="1100000" readonly/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Id Barang</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="IdBarang" name="IdBarang" placeholder="Scan Id Barang" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="NamaBarang" name="NamaBarang" placeholder="Banner" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Kategori Barang</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="IdJenisBarang" name="IdJenisBarang" aria-label="Default select example">
                                <option selected>Pilih Kategori Barang</option>
                                @foreach ($typeid as $type)
                                <option value="{{ $type->IdJenisBarang }}">{{ $type->JenisBarang }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Satuan</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="IdSatuan" name="IdSatuan" aria-label="Default select example">
                                <option selected>Pilih Satuan</option>
                                @foreach ($typeS as $type)
                                <option value="{{ $type->IdSatuan }}">{{ $type->Satuan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Upload Gambar</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="file" id="img" name="img" />
                        </div>
                    </div> --}}
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-outline-primary">
                                Tambah Barang
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/script.js') }}"></script>




@endsection

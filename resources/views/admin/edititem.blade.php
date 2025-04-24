@extends('admin.layouts.template')
@section('page_title')
    Add Product - Single Ecom
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Halaman/</span> Edit Kolam</h4>
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Edit Barang</h5>
                    <small class="text-muted float-end">Input Informasi</small>
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
                    <form action="{{ route('updateitem') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $iteminfo->IdBarang }}" name="IdBarang">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Barang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="NamaBarang" name="NamaBarang"
                                    value="{{ $iteminfo->NamaBarang }}" placeholder="Nasi Padang" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Pilih Jenis</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="IdJenisBarang" name="IdJenisBarang"
                                    aria-label="Default select example">
                                    <option value="{{ $parent_title->IdJenisBarang ?? '0' }}" selected>
                                        {{ $parent_title->JenisBarang ?? 'ROOT' }}</option>
                                    {{-- foreach for showing each available jenis barang --}}
                                    @foreach ($typeid as $type)
                                        <option value="{{ $type->IdJenisBarang }}">{{ $type->JenisBarang }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Jumlah Stok</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="JumlahStok" name="JumlahStok"
                                    value="{{ $iteminfo->JumlahStok }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Pilih Satuan</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="IdSatuan" name="IdSatuan">
                                    <option value="">-- Pilih Satuan --</option>
                                    @foreach ($typeS as $satuan)
                                        <option value="{{ $satuan->IdSatuan }}"
                                            {{ $iteminfo->IdSatuan == $satuan->IdSatuan ? 'selected' : '' }}>
                                            {{ $satuan->Satuan }}
                                        </option>
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
                                <button type="submit" class="btn btn-primary">Update Kolam</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

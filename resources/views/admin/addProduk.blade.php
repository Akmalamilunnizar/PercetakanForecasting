@extends('admin.layouts.template')

@section('page_title')
    SANKE | Halaman Tambah Produk
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Halaman / </span>Tambah Data Produk</h4>
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Tambah Data Produk</h5>
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

                    {{-- !!! PASTIKAN TAG FORM HANYA SATU PASANG DAN MENCAKUP SEMUA INPUT !!! --}}
                    <form action="{{ route('storeproduk') }}" method="POST" enctype="multipart/form-data"
                        id="addProductForm">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="IdProduk">ID Produk</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="IdProduk" name="IdProduk" value="{{$newId}}"
                                    readonly />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="NamaProduk">Nama Produk</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="NamaProduk" name="NamaProduk"
                                    placeholder="Banner" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="HargaProduk">Harga Produk</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="HargaProduk" name="HargaProduk"
                                    placeholder="5000" />
                            </div>
                        </div>

                        {{-- New field: Ukuran Produk --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="ukuran_produk_tags">Ukuran Produk</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="ukuran_produk_tags" name="ukuran_produk"
                                    placeholder="Ketik ukuran dan tekan Enter (misal: A4)"
                                    value="{{ old('ukuran_produk') }}" />
                                <small class="form-text text-muted">Ketik ukuran produk dan tekan Enter. Contoh: A4, A3,
                                    A2.</small>
                            </div>
                        </div>

                        {{-- New field: Jenis Bahan Produk --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="jenis_bahan_produk">Jenis Bahan Produk</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="jenis_bahan_produk" name="jenis_bahan_produk"
                                    placeholder="Contoh: Flexy, Albatros" />
                            </div>
                        </div>

                        {{-- New field: Custom Produk --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="custom_produk">Custom Produk</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="custom_produk" name="custom_produk"
                                    placeholder="Contoh: Ya/Tidak" />
                            </div>
                        </div>

                        {{-- New field: Diskon --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="diskon">Diskon</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="diskon" name="diskon"
                                    placeholder="Contoh: 10 (dalam persen)" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="Img">Image</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="Img" name="Img" />
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn"
                                    style="background: linear-gradient(45deg, #007bff, #00bfff); color: white;">
                                    Tambah Produk
                                </button>
                            </div>
                        </div>
                    </form> {{-- !!! INI ADALAH SATU-SATUNYA TAG PENUTUP FORM YANG BENAR !!! --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputTags = document.getElementById('ukuran_produk_tags');
            const hiddenInput = document.getElementById('ukuran_produk_hidden');
            const form = document.getElementById('addProductForm');
            let tags = [];

            if (hiddenInput.value) {
                tags = hiddenInput.value.split(', ').map(tag => tag.trim()).filter(tag => tag !== '');
            }

            function updateHiddenInput() {
                hiddenInput.value = tags.join(', ');
            }

            function addTag(tag) {
                tag = tag.trim();
                if (tag && !tags.includes(tag)) {
                    tags.push(tag);
                    updateHiddenInput();
                    // renderTags(); // Jika Anda punya fungsi ini untuk tampilan visual
                }
            }

            inputTags.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ',') {
                    e.preventDefault();
                    const value = this.value;
                    if (value) {
                        addTag(value);
                        this.value = '';
                    }
                }
            });

            form.addEventListener('submit', function (e) {
                const lastValue = inputTags.value.trim();
                if (lastValue && !tags.includes(lastValue)) {
                    tags.push(lastValue);
                    updateHiddenInput();
                    // inputTags.value = '';
                }
                // Form akan disubmit secara otomatis
            });

            // Contoh fungsi renderTags (jika Anda memiliki area untuk menampilkannya)
            function renderTags() {
                // console.log("Current tags:", tags);
            }

            renderTags();
        });
    </script>
@endpush
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

                    {{-- !!! PASTIKAN TAG FORM HANYA SATU PASANG DAN MENCAKUP SEMUA INPUT !!! --}}
                    <form action="{{ route('storeproduk') }}" method="POST" enctype="multipart/form-data"
                        id="addProductForm">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="IdProduk">ID Produk</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="IdProduk" name="IdProduk" value="{{$newId}}" readonly />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="NamaProduk">Nama Produk</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="NamaProduk" name="NamaProduk" placeholder="Banner" required />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="HargaProduk">Harga Produk</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="HargaProduk" name="HargaProduk" placeholder="5000" required />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="ukuran">Ukuran</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="ukuran" name="ukuran">
                                    <option value="">Pilih Ukuran</option>
                                    @foreach($sizeList as $size)
                                        <option value="{{ $size->id_ukuran }}">{{ $size->nama }} ({{ $size->panjang }} x {{ $size->lebar }} {{ $size->satuan->Satuan }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="bahan">Bahan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="bahan" name="bahan" placeholder="Contoh: Flexy, Albatros" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="custom">Custom</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="custom" name="custom" placeholder="Contoh: Ya/Tidak" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="id_bahan">Bahan (Database)</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="id_bahan" name="id_bahan">
                                    <option value="">Pilih Bahan</option>
                                    @foreach($bahanList as $bahan)
                                        <option value="{{ $bahan->IdBarang }}">{{ $bahan->NamaBarang }}</option>
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
                                        <option value="{{ $diskon->id }}">{{ $diskon->nama }} ({{ $diskon->persentase }}%)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="deskripsi">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Masukkan deskripsi produk" required></textarea>
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
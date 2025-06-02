    @extends('admin.layouts.template')

    @section('page_title')
CIME | Halaman Daftar Produk
    @endsection
    @section('search')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input type="text" name="search" class="form-control border-0 shadow-none ps-1 ps-sm-2 w-100"
                    placeholder="Pencarian id atau nama produk..." value="{{ isset($search) ? $search : '' }}" aria-label="Pencarian..."/>
            </div>
        </div>
    @endsection

    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-2 mb-3"><span class="text-muted fw-light">Data Produk /</span> Daftar Produk</h4>
            <a href="{{ route('addproduk') }}" class="btn btn-outline-primary mb-3">
                + Tambah Produk
            </a>

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

            <div class="card mt-3">
                <h5 class="card-header">Produk Yang Terdaftar</h5>
                <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead class="table-primary">
                            <tr>
                                <th class="fw-bold text-center">ID</th>
                                <th class="fw-bold text-center">Gambar</th>
                                <th class="fw-bold text-center">Nama Produk</th>
                                <th class="fw-bold text-center">Harga</th>
                                <th class="fw-bold text-center">Ukuran</th>
                                <th class="fw-bold text-center">Bahan</th>
                                <th class="fw-bold text-center">Custom</th>
                                <th class="fw-bold text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($dataProduk as $produk)
                                <tr>
                                    <td class="text-center">{{ $produk->IdProduk }}</td>
                                    <td class="text-center">
                                        @if ($produk->Img)
                                            <img src="{{ asset('storage/' . $produk->Img) }}" alt="{{ $produk->NamaProduk }}" class="img-thumbnail" style="max-width: 80px;">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $produk->NamaProduk }}</td>
                                    <td class="text-center">
                                        @if($produk->sizes->count())
                                            @foreach ($produk->sizes as $size)
                                            <span class="badge bg-primary text-white mb-1 d-block">
                                                    Rp {{ number_format($size->pivot->harga, 0, ',', '.') }}
                                                </span>
                                            @endforeach
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($produk->sizes->count())
                                            @foreach ($produk->sizes as $size)
                                                <span class="badge bg-primary text-white mb-1 d-block">
                                                    {{ $size->nama }} ({{ $size->panjang }} x {{ $size->lebar }} {{ $size->satuan->Satuan }})
                                                </span>
                                            @endforeach
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $produk->bahan ? $produk->bahan->NamaBarang : '-' }}</td>
                                    <td>
                                        @if($produk->custom_harga && $produk->custom_harga > 0)
                                            Rp {{ number_format($produk->custom_harga, 0, ',', '.') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('editproduk', $produk->IdProduk) }}"  class="btn btn-warning">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                       <form action="{{ route('deleteproduk', $produk->IdProduk) }}" method="POST" style="display:inline;" id="delete-form-{{ $produk->IdProduk }}">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" class="btn btn-danger" onclick="event.preventDefault(); if(confirm('Yakin ingin menghapus produk ini?')) document.getElementById('delete-form-{{ $produk->IdProduk }}').submit();">
                                                <i class="fas fa-trash-alt me-1"></i> Delete
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection

    <script>
    $(document).ready(function() {
        $('#ukuran').on('change', function() {
            if ($(this).val() === '') {
                $('#customSizeFields').show();
            } else {
                $('#customSizeFields').hide();
            }
        });
    });
    </script>

    @extends('admin.layouts.template')

    @section('page_title')
        Daftar Produk - Sistem Manajemen Percetakan
    @endsection

    @section('search')
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
            <a href="{{ route('addproduk') }}" class="btn btn-primary"
                style="background: linear-gradient(45deg, #C3A2FF);">
                + Tambah Produk
            </a>

            @if (session()->has('message'))
                <div class="alert alert-success mb-2">
                    {{ session()->get('message') }}
                </div>
            @endif

            <div class="card mt-3">
                <h5 class="card-header">Produk Yang Terdaftar</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>Id Produk</th>
                                <th>Nama Produk</th>
                                <th>Harga Produk</th>
                                <th>Gambar</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($dataProduk as $produk)
                                <tr>
                                    <td>{{ $produk->IdProduk }}</td>
                                    <td>{{ $produk->NamaProduk }}</td>
                                    <td>{{ $produk->HargaProduk }}</td>
                                    <td>
                                        
                                        @if ($produk->Img)
                                            <img src="{{ asset('storage/' . $produk->Img) }}" width="80">
                                        @else
                                            Tidak ada gambar
                                        @endif

                                    </td>
                                    <td>
                                        <a href="{{ route('editproduk', $produk->IdProduk) }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ route('deleteproduk', $produk->IdProduk) }}" method="POST" style="display:inline;" id="delete-form-{{ $produk->IdProduk }}">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" class="btn btn-warning" onclick="event.preventDefault(); if(confirm('Yakin ingin menghapus produk ini?')) document.getElementById('delete-form-{{ $produk->IdProduk }}').submit();">Delete</a>
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

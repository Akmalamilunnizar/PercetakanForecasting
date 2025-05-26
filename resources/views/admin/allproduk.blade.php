    @extends('admin.layouts.app')

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
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Produk /</span> Daftar Produk</h4>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Produk</h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('addproduk') }}" class="btn btn-primary">
                            <i class="bx bx-plus"></i> Tambah Produk
                        </a>
                        <form action="{{ route('searchproduk') }}" method="GET" class="d-flex gap-2">
                            <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="{{ $search ?? '' }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-search"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Gambar</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Ukuran</th>
                                <th>Bahan</th>
                                <th>Custom</th>
                                <th>Diskon</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($dataProduk as $produk)
                                <tr>
                                    <td>{{ $produk->IdProduk }}</td>
                                    <td>
                                        @if ($produk->Img)
                                            <img src="{{ asset('storage/' . $produk->Img) }}" alt="{{ $produk->NamaProduk }}" class="img-thumbnail" style="max-width: 80px;">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $produk->NamaProduk }}</td>
                                    <td>Rp {{ number_format($produk->HargaProduk, 0, ',', '.') }}</td>
                                    <td>{{ $produk->size ? $produk->size->nama . ' (' . $produk->size->panjang . ' x ' . $produk->size->lebar . ' ' . $produk->size->satuan->Satuan . ')' : '-' }}</td>
                                    <td>{{ $produk->bahan ?? '-' }}</td>
                                    <td>{{ $produk->custom ?? '-' }}</td>
                                    <td>
                                        @if($produk->diskon)
                                            <span class="badge bg-label-success">{{ $produk->diskon->persentase }}%</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('editproduk', $produk->IdProduk) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                                <form action="{{ route('deleteproduk', $produk->IdProduk) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection

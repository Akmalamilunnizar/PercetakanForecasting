@extends('admin.layouts.template')
@section('page_title')
CIME | Halaman Daftar Barang
@endsection
@section('search')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            {{-- <form method="GET" action={{ route('searchitem') }}> --}}
            <input type="text" name="search" class="form-control border-0 shadow-none ps-1 ps-sm-2 w-100"
                placeholder="Pencarian id atau nama..." value="{{ isset($search) ? $search : '' }}" aria-label="Pencarian..."
                style="600px" />
            </form>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Halaman/</span> Semua Barang</h4>
        <a href="{{ route('additems') }}" class="btn btn-primary mb-3">
            + Tambah Barang
        </a>
        <a href="{{ route('exititems') }}" class="btn btn-danger mb-3">
            + Barang Keluar 
        </a>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="card">
            <h5 class="card-header">Barang Yang Tersedia</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                     <thead class="table-primary">
                        <tr>
                          <th class="fw-bold text-center">Id</th>
                        <th class="fw-bold text-center">Id Masuk</th>
                        <th class="fw-bold text-center">Id Supplier</th>
                        <th class="fw-bold text-center">Qty Masuk</th>
                        <th class="fw-bold text-center">Harga Satuan</th>
                        <th class="fw-bold text-center">Sub Total</th>
                        <th class="fw-bold text-center">Nama Barang</th>
                        <th class="fw-bold text-center">JenisBarang</th>
                        <th class="fw-bold text-center">Jumlah Stok</th>
                        <th class="fw-bold text-center">Id Keluar</th>
                        <th class="fw-bold text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                        @foreach ($items as $item)
                            <tr>
                               <td class="text-center">{{ $item->IdBarang }}</td>
                                <td class="text-center">{{ $item->detailBarangMasuk?->IdMasuk ?? '-' }}</td>
                                <td class="text-center">{{ $item->detailBarangMasuk?->IdSupplier ?? '-' }}</td>
                                <td class="text-center">{{ $item->detailBarangMasuk?->QtyMasuk ?? '-' }}</td>
                                <td class="text-center">{{ $item->detailBarangMasuk?->HargaSatuan ?? '-' }}</td>
                                <td class="text-center">{{ $item->detailBarangMasuk?->SubTotal ?? '-' }}</td>
                                <td class="text-center">{{ $item->NamaBarang }}</td>
                                <td class="text-center">{{ $item->jenisBarang->JenisBarang }}</td>
                                <td class="text-center">{{ $item->JumlahStok }} {{ $item->satuan->Satuan }}</td>
                                <td class="text-center">{{ $item->detailBarangKeluar?->IdKeluar ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('edititem', $item->IdBarang) }}" class="btn btn-warning">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <a href="{{ route('deleteitem', $item->IdBarang) }}" class="btn btn-danger" onclick="return confirm('Yakin ingin hapus data ini?')">
                                        <i class="fas fa-trash-alt me-1"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Bootstrap Table with Header - Light -->
    </div>
@endsection

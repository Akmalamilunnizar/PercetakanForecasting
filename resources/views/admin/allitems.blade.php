@extends('admin.layouts.template')
@section('page_title')
    All Product - Single Ecom
@endsection
@section('search')
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
        <a href="{{ route('additems') }}" class="btn btn-success ms-auto mb-3"
            style="background: linear-gradient(45deg, #28a745, #34d058);">
            + Tambah Barang
        </a>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="card">
            <h5 class="card-header">Barang Yang Tersedia</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Id</th>
                            <th>Id Masuk</th>
                            <th>Id Supplier</th>
                            <th>Qty Masuk</th>
                            <th>Harga Satuan</th>
                            <th>Sub Total</th>
                            <th>Nama Barang</th>
                            <th>JenisBarang</th>
                            <th>Jumlah Stok</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->IdBarang }}</td>
                                <td>{{ $item->detailBarangMasuk?->IdMasuk ?? '-' }}</td>
                                <td>{{ $item->detailBarangMasuk?->IdSupplier ?? '-' }}</td>
                                <td>{{ $item->detailBarangMasuk?->QtyMasuk ?? '-' }}</td>
                                <td>{{ $item->detailBarangMasuk?->HargaSatuan ?? '-' }}</td>
                                <td>{{ $item->detailBarangMasuk?->SubTotal ?? '-' }}</td>
                                <td>{{ $item->NamaBarang }}</td>
                                <td>{{ $item->jenisBarang->JenisBarang }}</td>
                                {{-- <td>{{ $jml_ikan }}</td> --}}
                                <td>{{ $item->JumlahStok }} {{ $item->satuan->Satuan }}</td>
                                {{-- <td>{{ $item->updated_at }}</td> --}}
                                <td>
                                    <a href="{{ route('edititem', $item->IdBarang) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ route('deleteitem', $item->IdBarang) }}" class="btn btn-warning">Delete</a>
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

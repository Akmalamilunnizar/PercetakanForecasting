@extends('admin.layouts.template')

@section('page_title')
CIME | Halaman Daftar Transaksi
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
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Halaman</span> Daftar Transaksi</h4>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
<div class="card">
    <h5 class="card-header fw-bold">Daftar Transaksi</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-striped">
            <thead class="table-light">
                <tr>
                  <th style="text-align: center; font-weight: bold;">Id</th>
                <th style="text-align: center; font-weight: bold;">Nama Customer</th>
                <th style="text-align: center; font-weight: bold;">Qty Orderan</th>
                <th style="text-align: center; font-weight: bold;">Alamat</th>
                <th style="text-align: center; font-weight: bold;">Jumlah yang dibayarkan</th>
                <th style="text-align: center; font-weight: bold;">Actions</th>
                <th style="text-align: center; font-weight: bold;">Status Orderan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $item)
                   <tr>
                        <td class="text-center">{{ $item->IdTransaksi }}</td>
                        {{-- Make customer name clickable --}}
                        <td class="text-center">
                            {{-- Assuming 'detail' relationship exists and 'id' is available on the detail object --}}
                            {{-- This link will point to a route that shows customer details --}}
                            <a href="{{ route('customerDetails', $item->detail->id) }}" class="text-primary fw-bold">
                                {{ $item->detail->f_name }}
                            </a>
                        </td>
                        {{-- It seems 'Bayar' here might be intended for quantity, based on the header 'Qty Orderan'. --}}
                        {{-- If it's quantity, ensure your $item->Bayar actually holds quantity, or use a different field. --}}
                        <td class="text-center">{{ $item->Bayar }}</td>
                        <td class="text-center">{{ $item->detail->alamat }}</td>
                        <td class="text-center">{{ $item->bayar }}</td>
                       <td class="text-center">
                            <a href="{{ route('terimaOrderan', $item->id) }}" class="btn btn-success btn-sm mx-1">
                                <i class="fas fa-check me-1"></i> Terima
                            </a>
                            <a href="{{ route('tolakOrderan', $item->id) }}" class="btn btn-danger btn-sm mx-1">
                                <i class="fas fa-times me-1"></i> Tolak
                            </a>
                        </td>
                        <td class="text-center">{{ $item->StatusPesanan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection

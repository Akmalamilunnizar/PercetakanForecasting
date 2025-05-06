@extends('admin.layouts.template')

@section('page_title')
    CIME | Daftar Customer
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
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Halaman</span> Daftar Customer</h4>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
<div class="card">
    <h5 class="card-header">Customer yang Terdaftar</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead class="table-light">
                <tr>
                    <th>Id</th>
                    <th>Nama Customer</th>
                    <th>Nomor telepon</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @foreach ($customer as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->f_name }}</td>
                        <td>{{ $item->nomor_telepon }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>
                            <a href="{{ route('deletecustomer', $item->id) }}" class="btn btn-warning">Delete</a>
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
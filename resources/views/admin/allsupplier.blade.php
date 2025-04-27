@extends('admin.layouts.template')
@section('page_title')
    Daftar Supplier - Sistem Manajemen Percetakan
@endsection
@section('search')
    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            <input type="text" name="search" class="form-control border-0 shadow-none ps-1 ps-sm-2 w-100"
                placeholder="Pencarian id atau nama supplier..." value="{{ isset($search) ? $search : '' }}" aria-label="Pencarian..."/>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-2 mb-3"><span class="text-muted fw-light">Data Supplier/</span> Daftar Supplier</h4>
        <a href="{{ route('addsupplier') }}" class="btn btn-primary"
            style="background: linear-gradient(45deg, #C3A2FF);">
            + Tambah Supplier
        </a>
        @if (session()->has('message'))
            <div class="alert alert-success mb-2">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="card mt-3">
            <h5 class="card-header">Supplier Yang Terdaftar</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Id Supplier</th>
                            <th>Nama Supplier</th>
                            <th>No Tlp</th>
                            <th>Alamat</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($suppliers as $supplier)
                            <tr>
                                <td>{{ $supplier->IdSupplier }}</td>
                                <td>{{ $supplier->NamaSupplier }}</td>
                                <td>{{ $supplier->NoTelp }}</td>
                                <td>{{ $supplier->Alamat }}</td>
                                <td>
                                    <a href="{{ route('editsupplier', $supplier->IdSupplier) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('deletesupplier', $supplier->IdSupplier) }}" method="POST" style="display:inline;" id="delete-form-{{ $supplier->IdSupplier }}">
                                @csrf
                                @method('DELETE')
                                <a href="#" class="btn btn-warning" onclick="event.preventDefault(); if(confirm('Yakin ingin menghapus supplier ini?')) document.getElementById('delete-form-{{ $supplier->IdSupplier }}').submit();">Delete</a>
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

@extends('admin.layouts.template')
@section('page_title')
    Daftar Jenis - CIME
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
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Halaman/</span> Daftar Jenis</h4>
        <a href="{{ route('addtype') }}" class="btn btn-success ms-auto mb-3"
            style="background: linear-gradient(45deg, #28a745, #34d058);">
            + Tambah Jenis
        </a>
        @if (session()->has('message'))
            @php
                $alertType = session('alert') ?? 'success'; // default success kalau nggak ada
            @endphp
            <div class="alert alert-{{ $alertType }} alert-dismissible fade show" role="alert">
                {{ session()->get('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <h5 class="card-header">Jenis Yang Tersedia</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Id</th>
                            <th>Nama Jenis</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                        @foreach ($type as $item)
                            <tr>
                                <td>{{ $item->IdJenisBarang }}</td>
                                <td>{{ $item->JenisBarang }}</td>
                                <td>
                                    <a href="{{ route('edittype', $item->IdJenisBarang) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ route('deletetype', $item->IdJenisBarang) }}"
                                        class="btn btn-warning">Delete</a>
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

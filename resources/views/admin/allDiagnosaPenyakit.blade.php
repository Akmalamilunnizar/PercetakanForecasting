@extends('admin.layouts.template')
@section('page_title')
    SANKE | Halaman Daftar Penyakit Ikan Koi
@endsection

@section('search')
    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            <form method="GET" action="{{ route('searchdiagnosa') }}">
                <input type="text" name="search" class="form-control border-0 shadow-none ps-1 ps-sm-2"
                    placeholder="Pencarian jenis koi atau penyakit..." value="{{ isset($search) ? $search : '' }}"
                    aria-label="Pencarian..." />
            </form>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="mb-3">
            <a href="{{ url('/barang-masuk/tambah') }}" class="btn btn-success custom-dropdown">
                Tambah Barang Masuk
            </a>
        </div>


        <!-- <div class="btn-group mb-3">
                <button type="button" class="btn btn-outline-success dropdown-toggle custom-dropdown" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Tambah Barang Masuk
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="javascript:void(0);"></a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);">Kolam 2</a></li>
                </ul>
            </div> -->
        <div class="card">
            <h5 class="card-header">Daftar Barang Masuk</h5>

            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Id Barang</th>
                            <th>Nama Petugas</th>
                            <th>Tanggal Masuk</th>
                            <!-- <th>Gambar Koi Terdiagnosa</th>
                            <th>Tanggal</th>
                            <th>Aksi</th> -->
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($diagnoses_d as $key => $diagnosas)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                {{-- Show related Koi name --}}
                                <td>{{ $diagnosas->koiFish->name ?? 'Koi not available' }}</td> {{-- This will display the Koi
                                name --}}
                                {{-- Show related Penyakit name --}}
                                <td>{{ $diagnosas->penyakit->nama_penyakit ?? 'Penyakit not available' }}</td> {{-- This will
                                display the Penyakit name --}}
                                <td>
                                    @if ($diagnosas->gambar_koi)
                                        <img src="{{ asset($diagnosas->gambar_koi) }}" alt="Gambar Koi" width="50">
                                    @else
                                        Tidak ada gambar
                                    @endif
                                </td>
                                <td>{{ $diagnosas->created_at }}</td>
                                <td>
                                    <a href="{{ route('editdiagnosa', $diagnosas->id) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ route('showdiagnosa', $diagnosas->id) }}" class="btn btn-info">Detail</a>
                                    <a href="{{ url('admin/delete-diagnosa/' . $diagnosas->id) }}" class="btn btn-warning"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
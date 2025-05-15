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

        <div class="mb-3 d-flex">
            <!-- Tombol Export PDF -->
            <a href="{{ url('/barang-masuk/tambah') }}" class="btn btn-success custom-dropdown me-2">
                Export PDF
            </a>

            <!-- Dropdown Bulan -->
            <select class="form-select w-auto custom-dropdown me-2" name="bulan" id="bulan">
                <option value="">Pilih Bulan</option>
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>

            <!-- Dropdown Tahun -->
            <select class="form-select w-auto custom-dropdown" name="tahun" id="tahun">
                <option value="">Pilih Tahun</option>
                @for ($i = 2020; $i <= date('Y'); $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
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
            <h5 class="card-header">Laporan Barang Masuk</h5>

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
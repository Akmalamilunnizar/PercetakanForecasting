@extends('admin.layouts.template')

@section('page_title', 'Daftar Ukuran')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Daftar Ukuran</h4>

    @if(session('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Ukuran</h5>
            <a href="{{ route('addukuran') }}" class="btn btn-primary">
                <i class="bx bx-plus"></i> Tambah Ukuran
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Ukuran</th>
                            <th>Panjang</th>
                            <th>Lebar</th>
                            <th>Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sizes as $index => $size)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $size->nama }}</td>
                            <td>{{ $size->panjang }}</td>
                            <td>{{ $size->lebar }}</td>
                            <td>{{ $size->satuan->Satuan }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('editukuran', $size->id_ukuran) }}" class="btn btn-sm btn-warning">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                    <form action="{{ route('deleteukuran', $size->id_ukuran) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ukuran ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

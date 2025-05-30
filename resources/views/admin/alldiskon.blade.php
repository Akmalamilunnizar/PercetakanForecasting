@extends('admin.layouts.template')
@section('page_title', 'Daftar Diskon')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Daftar Diskon</h4>
    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <a href="{{ route('adddiskon') }}" class="btn btn-primary mb-3">+ Tambah Diskon</a>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Diskon</th>
                        <th>Deskripsi</th>
                        <th>Persentase</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($diskonList as $diskon)
                    <tr>
                        <td>{{ $diskon->nama }}</td>
                        <td>{{ $diskon->description }}</td>
                        <td>{{ $diskon->persentase }}%</td>
                        <td>
                            <a href="{{ route('editdiskon', $diskon->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('deletediskon', $diskon->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus diskon?')">Hapus</button>
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

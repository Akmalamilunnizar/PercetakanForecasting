@extends('admin.layouts.template')

@section('page_title')
    CIME | Daftar Transaksi
@endsection

@section('search')
    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            <form method="GET" action={{ route('searchitem') }}>
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
    <h5 class="card-header">Daftar Transaksi</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead class="table-light">
                <tr>
                    <th>Id</th>
                    <th>Nama Customer</th>
                    <th>Qty Orderan</th>
                    <th>Alamat</th>
                    <th>Jumlah yang dibayarkan</th>
                    <th>Actions</th>
                    <th>Status Orderan</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($transaksi as $item)
                    <tr>
                        <td>{{ $item->IdTransaksi }}</td>
                        <td>{{ $item->detail->f_name }}</td>
                        <td>{{ $item->Bayar}}</td>
                        <td>{{ $item->detail->alamat }}</td>
                        <td>{{ $item->bayar }}</td>
                        <td>
                            {{-- Ubah onclick untuk memanggil fungsi SweetAlert --}}
                            <a href="#" class="btn btn-success"
                                onclick="confirmAction('terima', '{{ route('terimaOrderan', $item->id) }}');">Terima</a>
                            <a href="#" class="btn btn-danger"
                                onclick="confirmAction('tolak', '{{ route('tolakOrderan', $item->id) }}');">Tolak</a>
                        </td>
                        <td>{{ $item->StatusPesanan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>

{{-- Skrip JavaScript untuk SweetAlert2 --}}
<script>
    function confirmAction(type, url) {
        let title, text, confirmButtonText;

        if (type === 'terima') {
            title = 'Apakah Anda Yakin?';
            text = 'Anda akan menerima orderan ini.';
            confirmButtonText = 'Ya, Terima!';
        } else if (type === 'tolak') {
            title = 'Apakah Anda Yakin?';
            text = 'Anda akan menolak orderan ini.';
            confirmButtonText = 'Ya, Tolak!';
        }

        Swal.fire({
            title: title,
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: confirmButtonText,
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika user mengklik 'Ya', lanjutkan ke URL yang dituju
                window.location.href = url;
            }
        });
    }
</script>
@endsection
<!DOCTYPE html>
<html>
<head>
    <title>Detail Laporan Barang #{{ $laporanbarang->IdLaporan }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #000000;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #000000;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background-color:rgb(175, 205, 255);
            color: #000000;
            padding: 8px;
            text-align: left;
            font-size: 13px;
        }
        td {
            padding: 8px;
            border: 1px solid #ccc;
            font-size: 13px;
            color: #000000;
        }
        .label {
            width: 35%;
            background-color:rgb(219, 217, 255);
            font-weight: bold;
            color: #000000;
        }
        p {
            color: #000000;
        }
    </style>
</head>
<body>

    <h2>Detail Laporan Barang #{{ $laporanbarang->IdLaporan }}</h2>

    <table>
        <tr>
            <th class="label">Nama Barang</th>
            <td>{{ optional($laporanbarang->databarang)->NamaBarang ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th class="label">Nama Supplier</th>
            <td>{{ optional($laporanbarang->supplier)->NamaSupplier ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th class="label">Qty Masuk</th>
            <td>{{ optional($laporanbarang->detailBarangMasuk)->QtyMasuk ?? 0 }}</td>
        </tr>
        <tr>
            <th class="label">Qty Keluar</th>
            <td>{{ optional($laporanbarang->detailBarangKeluar)->QtyKeluar ?? 0 }}</td>
        </tr>
        <tr>
            <th class="label">Jumlah Stok</th>
            <td>
                {{ optional($laporanbarang->databarang)->JumlahStok ?? 0 }}
                {{ optional($laporanbarang->databarang?->satuan)->Satuan ?? '' }}
            </td>
        </tr>
    </table>
</body>

</html>

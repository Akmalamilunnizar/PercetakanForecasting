<!DOCTYPE html>
<html>
<head>
    <title>Detail Laporan Barang #{{ $laporantransaksi->Idlaporan_transaksi }}</title>
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

    <h2>Detail Laporan Transaksi #{{ $laporantransaksi->Idlaporan_transaksi }}</h2>

    <table>
        <tr>
            <th class="label">Nama Produk</th>
            <td>{{ optional($laporantransaksi->produk)->NamaProduk ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th class="label">Tanggal Transaksi</th>
            <td>{{ optional($laporantransaksi->transaksi)->tglTransaksi }}</td>
        </tr>
        <tr>
            <th class="label">Total Harga</th>
            <td>Rp {{ number_format(optional($laporantransaksi->transaksi)->GrandTotal, 0, ',', '.') }}</td>
        </tr>
    </table>
</body>

</html>

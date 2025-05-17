<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Laporan Barang {{ $bulan ? 'Bulan '.$bulan : '' }} {{ $tahun }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
                Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
            margin: 40px;
            background: rgb(207, 209, 255);
            color: #000; /* warna hitam */
        }

        h3 {
            text-align: center;
            font-weight: 600;
            font-size: 24px;
            margin-bottom: 30px;
            color: #000; /* hitam */
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        thead tr {
            background: linear-gradient(90deg, #4e73df, #224abe);
            color: #000; /* ubah jadi hitam */
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.05em;
        }

        thead th {
            padding: 15px 10px;
            color: #000; /* hitam */
        }

        tbody tr {
            background: rgb(237, 246, 255);
            transition: background-color 0.3s ease;
        }

        tbody tr:nth-child(odd) {
            background: rgb(164, 204, 255);
        }

        tbody tr:hover {
            background-color: rgb(5, 250, 83);
        }

        tbody td {
            padding: 12px 10px;
            font-size: 14px;
            color: #000; /* teks hitam */
        }

        tbody td:first-child {
            font-weight: 600;
            color: #000; /* hitam */
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* Jika tidak ada data */
        .no-data {
            text-align: center;
            font-style: italic;
            color: #000; /* hitam */
            padding: 20px 0;
        }
    </style>
</head>
<body>
    <h3>Laporan Barang {{ $bulan ? 'Bulan '.$bulan : '' }} {{ $tahun }}</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Nama Supplier</th>
                <th>Qty Masuk</th>
                <th>Qty Keluar</th>
                <th>Jumlah Stok</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporanbarang as $index => $laporan)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td style="text-align: center;">{{ optional($laporan->databarang)->NamaBarang ?? 'N/A' }}</td>
                    <td style="text-align: center;">{{ optional($laporan->supplier)->NamaSupplier ?? 'N/A' }}</td>
                    <td style="text-align: center;">{{ optional($laporan->detailBarangMasuk)->QtyMasuk ?? 0 }}</td>
                    <td style="text-align: center;">{{ optional($laporan->detailBarangKeluar)->QtyKeluar ?? 0 }}</td>
                    <td style="text-align: center;">
                        {{ optional($laporan->databarang)->JumlahStok ?? 0 }}
                        {{ optional($laporan->databarang?->satuan)->Satuan ?? '' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>

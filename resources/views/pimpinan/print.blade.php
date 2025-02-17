<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Penjualan</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .detail {
            font-size: 10px;
            margin-top: 5px;
        }
    </style>
</head>
<body>

    <h2>Laporan Penjualan</h2>

    <table>
        <thead>
            <tr>
                <th>No Resi</th>
                <th>Waktu</th>
                <th>Member</th>
                <th>Total</th>
                <th>Uang Dibayar</th>
                <th>Kembalian</th>
                <th>Detail Produk</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sales as $sale)
            <tr>
                <td>{{ $sale->no_resi }}</td>
                <td>{{ $sale->waktu }}</td>
                <td>{{ $sale->user->name ?? 'Non Member' }}</td>
                <td>Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($sale->uang_dibayar, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($sale->kembalian, 0, ',', '.') }}</td>
                <td>
                    <strong>Detail:</strong> <br>
                    @foreach($sale->sale_detail as $detail)
                        - **Nama:** {{ $detail->product->name }} <br>
                        - **Jumlah:** {{ $detail->jumlah_jual }} x Rp {{ number_format($detail->product->price, 0, ',', '.') }} <br>
                        - **Subtotal:** <strong>Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</strong> <br><br>
                    @endforeach
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center;">Tidak ada transaksi</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>

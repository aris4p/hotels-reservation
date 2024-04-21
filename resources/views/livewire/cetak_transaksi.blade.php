<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Transaksi Transaksi</title>
    <style>
        /* CSS untuk styling tampilan cetakan PDF */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Lpaoran Transaksi</h1>
    <table>
        <thead>
            <tr>
               <th class="sort">No Transaksi</th>
                <th class="sort">Nama Pelanggan</th>
                <th class="sort">Kamar</th>
                <th class="sort">Harga</th>
                <th class="sort">Jumlah</th>
                <th class="sort">Checkin</th>
                <th class="sort">Checkout</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $item->notrx }}</td>
                <td>{{ $item->pelanggan_id }}</td>
                <td>{{ $item->kamar_id }}</td>
                <td>{{ $item->harga }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $item->tglCheckin }}</td>
                <td>{{ $item->tglCheckout }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

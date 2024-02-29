<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Transaksi</title>

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JavaScript -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.js"></script>

    <!-- Custom Styles -->
    <style>
        /* Tambahkan gaya kustom Anda di sini */
        .total {
            margin-top: 10px;
        }
        .additional-info, .signature {
            margin-top: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .total {
            margin-top: 20px;
            text-align: right;
            font-weight: bold;
        }
        .additional-info, .signature {
            margin-top: 20px;
            text-align: center;
        }
        ol {
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <table id="datatable" class="table table-bordered table-fixed" style="width:100%" border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Kode Transaksi</th>
                <th>Items</th>
                <th>Total Harga</th>
                <th>Uang Bayar</th>
                <th>Uang Kembali</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php $no_transaksi = 1 ?>
            @php
                $totalHargaFiltered = 0;
            @endphp
            @foreach ($transaksi as $transaksi)
                <tr>
                    <td>{{ $no_transaksi }}</td>
                    <td>{{ $transaksi->nama_pelanggan }}</td>
                    <td>{{ $transaksi->id }}</td>
                    <td>
                        <ol>
                            @foreach ($transaksi->items as $item)
                                <li>{{ $item->nama_produk }} - {{ $item->quantity }} - Rp.{{ number_format($item->quantity * $item->harga_produk) }}</li>
                            @endforeach
                        </ol>
                    </td>
                    <td>Rp.{{ number_format($transaksi->total_harga) }}</td>
                    <td>Rp.{{ number_format($transaksi->uang_bayar) }}</td>
                    <td>Rp.{{ number_format($transaksi->uang_kembali) }}</td>
                    <td>{{ $transaksi->created_at->toDayDateTimeString() }}</td>
                </tr>
                @foreach ($transaksi->items as $item)
                    @php
                        $totalHargaFiltered += $item->quantity * $item->harga_produk;
                    @endphp
                @endforeach
            <?php $no_transaksi++?>
            @endforeach
        </tbody>
    </table>
    <p class="total">Total Harga : Rp {{ number_format($totalHargaFiltered, 0, ',', '.') }}</p>
    <!-- Additional Information -->
    <div class="additional-info">
        <p>KiraMerch</p>
    </div>

    <!-- Signature -->
    <div class="signature">
        <p><u>{{ Auth::user() ? Auth::user()->name : 'Guest' }}</u></p>
        <p>CEO KiraMerch</p>
    </div>

    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>
</body>
</html>

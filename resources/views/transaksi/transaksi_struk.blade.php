<!DOCTYPE html>
<html>
<head>
    <title>Invoice Transaksi #{{ $transaksi->id_trans }}</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 500px;
            margin: 0 auto;
            padding: 10px;
        }
        .header {
            text-align: center;
        }
        .content {
            margin-top: 20px;
            font-size: 14px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
        }
        .barcode {
            text-align: right;
            margin-top: 20px;
        }
        .divider {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h3 style="font-size: 20px;">KIRAMEARCH</h3>
            <h2 style="font-size: 20px;">JL. ARIEF RAHMAN HAKIM NO.28, KEL.CIGADUNG KEC.SUBANG KAB.SUBANG, 41213</h2>
        </div>
        <div class="content">
            <div class="divider"></div> 
            <p style="font-size: 17px;">Invoice Transaksi</p>
            <p style="font-size: 16px;">Tanggal: {{ date('d/m/Y H:i:s') }}</p>
            <p style="font-size: 16px;">Nama Pelanggan: {{ $transaksi->nama_pelanggan}}</p>
            <!-- <p style="font-size: 16px;">Kode Transaksi: {{ $transaksi->id_transaksi }}</p> -->
            <div class="divider"></div>

            <p style="font-size: 17px;">Daftar Produk: 
            @foreach ($transaksi->items as $item)
            <p>- {{ $item->nama_produk }} {{ $item->quantity }} : Rp.{{ number_format($item->quantity * $item->harga_produk) }}</p>
            @endforeach
            <p>Total Harga: Rp.{{ number_format($transaksi->total_harga) }}</p>
            <div class="divider"></div>
        </div>
        <div class="barcode">
            <p>Uang Bayar: Rp.{{ number_format($transaksi->uang_bayar) }}</p>
            <p>Uang Kembali: Rp.{{ number_format($transaksi->uang_kembali) }}</p>
        </div>
        <div class="footer">
            <div class="divider"></div>
            <p style="font-size: 17px;">{{date('H:i:s')}}/{{ Auth::User()->nama}}/{{ $transaksi->id }}</p>
            <p style="font-size: 17px;">Terima Kasih</p>
            <p style="font-size: 17px;">Barang yang sudah dibeli tidak dapat ditukar</p>
        </div>
    </div>
</body>
</html>
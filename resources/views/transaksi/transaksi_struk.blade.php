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
            width: 300px; /* Mengurangi lebar agar sesuai dengan struk Alfamart */
            margin: 0 auto;
            padding: 10px;
            border: 1px solid #000; /* Menambahkan border agar terlihat seperti struk */
        }
        .header {
            text-align: center;
        }
        .content {
            margin-top: 5px;
            font-size: 14px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
        }
        .barcode {
            text-align: right;
            margin-top: 10px;
        }
        .divider {
            border-top: 1px dashed #000;
            margin: 5px 0;
            font-size: 10px;
        }
        .align-right {
            text-align: right;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h3 style="font-size: 20px;">KIRAMEARCH</h3>
            <p style="font-size: 12px;">JL. ARIEF RAHMAN HAKIM NO.28, KEL.CIGADUNG KEC.SUBANG KAB.SUBANG, 41213</p>
        </div>
        <div class="content">
            <div class="divider"></div> 
            <p style="font-size: 14px;"><p>Invoice Transaksi</p><p>Tanggal: {{ date('d/m/Y H:i:s') }}</p>Nama Pelanggan: {{ $transaksi->nama_pelanggan }}</p>
            <div class="divider"></div>

            <p style="font-size: 15px;">Daftar Produk: </p>
            @foreach ($transaksi->items as $item)
                <div style="margin-bottom: 10px;">
                    <p style="margin: 0;">- {{ $item->nama_produk }} ({{ $item->quantity }}) </p>
                    <p style="margin: 0;">&nbsp;&nbsp;&nbsp; Harga = Rp.{{ number_format($item->harga_produk) }}/pcs </p>
                    <p style="margin: 0;">&nbsp;&nbsp;&nbsp; Total = Rp.{{ number_format($item->quantity * $item->harga_produk) }}</p>
                </div>
            @endforeach
            <div class="divider"></div>
        </div>
        <div class="barcode">
            <p class="align-right">Total Harga = Rp.{{ number_format($transaksi->total_harga) }}</p>
            <p class="align-right">Uang Bayar = Rp.{{ number_format($transaksi->uang_bayar) }}</p>
            <p class="align-right">Uang Kembali = Rp.{{ number_format($transaksi->uang_kembali) }}</p>
        </div>
        <div class="footer">
            <div class="divider"></div>
            <p style="font-size: 13px;">{{ date('H:i:s') }}/{{ Auth::User()->nama }}/{{ $transaksi->id_transaksi }}</p>
            <!-- <p style="font-size: 13px;">Terima Kasih</p> -->
            <p style="font-size: 13px;"><p>Terima Kasih</p>Barang yang sudah dibeli tidak dapat ditukar</p>
        </div>
    </div>
</body>
</html>

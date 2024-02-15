<h1>Daftar Transaksi</h1>
<table width="100%" border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>No</th>
    <th>Nama pelanggan</th>
    <th>Kode Transaksi</th>
    <th>Items</th>
    <th>Total Harga</th>
    <th>Uang Bayar</th>
    <th>Uang Kembali</th>
    <th>Tanggal</th>
</tr>
<?php $no_transaksi = 1 ?>
@foreach ($transaksi as $transaksi)
    <tr>
        <td>{{ $no_transaksi }}</td>
        <td>{{ $transaksi->nama_pelanggan }}</td>
            <td>{{ $transaksi->id_transaksi }}</td>
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
<?php $no_transaksi++?>
@endforeach
</table>
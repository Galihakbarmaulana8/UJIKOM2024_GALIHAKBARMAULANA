<h1>Daftar Produk</h1>
<table width="100%" border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>No</th>
    <th>Id Produk</th>
    <th>Nama Produk</th>
    <th>Stok</th>
    <th>Harga Produk</th>
    <th>Tanggal Masuk</th>
</tr>
<?php $no_produk = 1 ?>
@foreach ($produk as $produk)
<tr>
    <td>{{ $no_produk}}</td>
    <td>{{ $produk->id_produk }}</td>
    <td>{{ $produk->nama_produk }}</td>
    <td>{{ $produk->stok }}</td>
    <td>Rp.{{ number_format($produk->harga_produk) }}</td>
    <td>{{ $produk->created_at->toDayDateTimeString() }}</td>
</tr>
<?php $no_produk++?>
@endforeach
</table>

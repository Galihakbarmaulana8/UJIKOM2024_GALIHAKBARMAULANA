@extends('admin')
@section('content')

<body class="nav-md">
    <div class="container body">
        <div class="right_col" role="main">
            <div class="x_panel">
                <div class="card-body">
                    @if($message = Session::get('success'))
                    <div class="alert alert-success">{{ $message }}</div>
                    @endif
                    <a href="{{ route('produk.create') }}" type="button" class="btn btn-success">Tambah Data</a>
                    <a href="{{ url('produk/pdf') }}" type="button" class="btn btn-warning">Cetak PDF</a>
                    <!-- Divider -->
                    <hr class="sidebar-divider d-none d-md-block">
                    <table id="datatable" class="table table-bordered table fixed" style="width:100%">
                        <thead>
                            <tr>
                                <th >No</th>
                                <th >ID Produk</th>
                                <th >Nama Produk</th>
                                <th >Stok</th>
                                <th >Kategori</th>
                                <th >Harga Produk</th>
                                <th >Tanggal Masuk</th>
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no_produk = 1 ?>
                            @foreach ($produk as $produk)
                            <tr>
                                <td>{{ $no_produk}}</td>
                                <td>{{ $produk->id_produk}}</td>
                                <td>{{ $produk->nama_produk}}</td>
                                <td>{{ $produk->stok}}</td>
                                <td>{{ $produk->kategori}}</td>
                                <td>Rp.{{ number_format($produk->harga_produk) }}</td>
                                <td>{{ $produk->created_at->toDayDateTimeString() }}</td>

                                <td>
                                    <form action="{{ route('produk.destroy', $produk->id_produk) }}" method="POST">
                                        <a href="{{ route('produk.edit', $produk->id_produk) }}" type="button" class="btn btn-sm btn-warning shadow">Edit</a>
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger shadow" onclick="return confirm('Konfirmasi Hapus Data !?');">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            <?php $no_produk++?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
@endsection

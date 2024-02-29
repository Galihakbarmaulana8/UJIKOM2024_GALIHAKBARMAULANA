@extends('admin')
@section('content')
<!-- <style>
    .filter{
        
    }
    .btn-filter{
        display: block;
        margin-top: 10px auto;
    }
</style> -->
<body class="nav-md">
    <div class="container body">
        <div class="right_col" role="main">
            <div class="x_panel">
                <div class="card-body">
                <h4 class="card-title">Laporan Transaksi</h4>
                <hr class="sidebar-divider d-none d-md-block">
                    @if($message = Session::get('success'))
                    <div class="alert alert-success">{{ $message }}</div>
                    @endif
                    @if (Auth::user()->role == 'kasir')
                    <a href="{{ route('transaksi.create') }}" type="button" class="btn btn-success">Tambah Data</a>
                    @endif
                    @if (Auth::user()->role == 'owner')
                    <a href="{{ url('transaksi/pdf') }}" type="button" class="btn btn-warning">Cetak PDF</a>
                    @endif
                    @if (Auth::user()->role == 'owner')
                        <a href="{{ route('laporan.index') }}" class="btn btn-warning">
                            Laporan Transaksi
                        </a>
                    @endif
                    <br><br>
                    <!-- Divider -->
                    <table id="datatable" class="table table-bordered table fixed" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pelanggan</th>
                                <!-- <th>Kode Transaksi</th> -->
                                <th>Nomer Unik</th>
                                <th>Items</th>
                                <th>Total Harga</th>
                                <th>Uang Bayar</th>
                                <th>Uang Kembali</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no_transaksi = 1 ?>
                            @foreach ($transaksi as $transaksi)
                                <tr>
                                    <td>{{ $no_transaksi }}</td>
                                    <td>{{ $transaksi->nama_pelanggan }}</td>
                                    <!-- <td>{{ $transaksi->id }}</td> -->
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
                                    <td>
                                        <form action="{{route('transaksi.destroy', $transaksi->id)}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            @if (Auth::user()->role == 'admin')
                                            <button type="submit" class="btn btn-sm btn-danger shadow" onclick="return confirm('Konfirmasi Hapus Data !?');">Hapus</button>
                                            @endif
                                        </form>
                                        <!-- <a href="{{route('transaksi.edit1', $transaksi->id)}}" class="btn btn-sm btn-secondary shadodw">Edit</a> -->
                                        @if (Auth::user()->role == 'kasir')
                                        <!-- <a href="{{route('transaksi.edit', $transaksi->id)}}" class="btn btn-sm btn-secondary shadodw">Edit</a> -->
                                        @endif
                                        @if (Auth::user()->role == 'kasir')
                                        <a href="{{url('transaksi/pdf2', $transaksi->id)}}" class="btn btn-sm btn-primary shadodw">Struk</a>
                                        @endif
                                    </td>
                                </tr>
                            <?php $no_transaksi++?>
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

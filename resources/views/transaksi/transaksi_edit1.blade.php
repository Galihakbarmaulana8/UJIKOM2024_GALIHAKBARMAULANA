<!-- transaksi_edit.blade.php -->

@extends('admin') <!-- Jika Anda menggunakan layout -->

@section('content')
<body class="nav-md">
    <div class="container body">
        <div class="right_col" role="main">
            <div class="x_panel">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h6 class="mb-4">Tambah data transaksi</h6>
                                <div class="ln_solid"></div>
                                <!-- Form untuk mengupdate transaksi -->
    <form action="{{ route('transaksi.update1', $transaksi->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Menggunakan metode PUT untuk update -->

        <!-- Input untuk nama pelanggan -->
        <div class="form-group">
            <label for="nama_pelanggan">Nama Pelanggan:</label>
            <input type="text" name="nama_pelanggan" value="{{ $transaksi->nama_pelanggan }}" class="form-control">
        </div>

        <!-- Input untuk uang bayar -->
        <div class="form-group">
            <label for="uang_bayar">Uang Bayar:</label>
            <input type="number" name="uang_bayar" value="{{ $transaksi->uang_bayar }}" class="form-control">
        </div>

        <!-- Input untuk total harga -->
        <div class="form-group">
            <label for="total_harga">Total Harga:</label>
            <input type="number" name="total_harga" value="{{ $transaksi->total_harga }}" class="form-control">
        </div>

        <!-- Input untuk item transaksi -->
        <div class="form-group">
            <label>Item Transaksi:</label>
            @foreach($transaksiItems as $index => $item)
                <div class="row">
                    <div class="col-md-1">
                        <label>{{ $index + 1 }}</label>
                    </div>
                    <div class="col-md-5">
                        <select name="id_produk[]" class="form-control">
                            @foreach($produk as $produkItem)
                                <option value="{{ $produkItem->id }}" @if($item->id_produk == $produkItem->id) selected @endif>{{ $produkItem->nama_produk }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="quantity[]" value="{{ $item->quantity }}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Tombol untuk submit form -->
        <a href="{{ route('transaksi.index')}}" type="button" class="btn btn-primary">Cancel</a>
        <button type="submit" class="btn btn-primary">Update Transaksi</button>
    </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection

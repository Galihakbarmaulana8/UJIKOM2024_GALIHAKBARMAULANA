@extends('admin')
@section('content')
<body class="nav-md">
    <div class="container body">
        <div class="right_col" role="main">
            <div class="x_panel">
                <div class="card-body">
                    <div class="col-md-12 ">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Tambah Data Produk</h2>
                            </div>
                            <div class="x_content">
                                <br />
                                <form  action="{{ route('produk.store') }}" method="POST" class="form-horizontal form-label-left">
                                    @csrf
                                    <div class="form-group row ">
                                        <label class="control-label col-md-3 col-sm-3 ">Nama Produk</label>
                                        <div class="col-md-9 col-sm-9 ">
                                            <input name="nama_produk" type="text" class="form-control col-md-7 col-md-7" placeholder="Nama Produk">
                                            @error('nama_produk')
                                            <p>{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="control-label col-md-3 col-sm-3 ">Stok</label>
                                        <div class="col-md-9 col-sm-9 ">
                                            <input name="stok" type="text" class="form-control col-md-7 col-md-7" placeholder="Stok">
                                            @error('stok')
                                            <p>{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3 ">Kategori</label>
                                        <div class="col-md-9 col-sm-9 ">
                                            <select name="kategori" class="form-control col-md-7 col-md-7">
                                                <option>Pilih Kategori</option>
                                                <option value="Pakaian dan Aksesoris">Pakaian dan Aksesoris</option>
                                                <option value="Barang Elektronik">Barang Elektronik</option>
                                                <option value="Boneka dan Action Figure">Boneka dan Action Figure</option>
                                                <option value="Peralatan Rumah Tangga">Peralatan Rumah Tangga</option>
                                                <option value="Poster">Poster</option>
                                                <option value="Perhiasan">Perhiasan</option>
                                                <option value="Produk Kesehatan dan Kecantikan">Produk Kesehatan dan Kecantikan</option>
                                                <option value="Seni dan Kerajinan Tangan">Seni dan Kerajinan Tangan</option>
                                            </select>
                                            @error('kategori')
                                                <p>{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3 ">Harga Produk </label>
                                        <div class="col-md-9 col-sm-9 ">
                                            <label class="control-label col-md-1 col-sm-1 ">RP.</label>
                                            <input name="harga_produk" type="number" class="form-control col-md-6 col-md-6" placeholder="Harga Produk">
                                            @error('harga_produk')
                                            <p>{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-9 col-sm-9  offset-md-3">
                                            <a href="{{ route('produk.index')}}"type="button" class="btn btn-primary">Cancel</a>
                                            <button type="reset" class="btn btn-primary">Reset</button>
                                            <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection

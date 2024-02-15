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
                                <h2>Edit Data Produk</h2>
                            </div>
                            <div class="x_content">
                                <br />
                                <form action="{{ route('produk.update', $produk->id_produk) }}" method="POST" class="form-horizontal form-label-left">
                                    @csrf
                                    @method('put')
                                    <div class="form-group row ">
                                        <label class="control-label col-md-2 col-sm-2 ">Nama Produk</label>
                                        <div class="col-md-9 col-sm-9 ">
                                            <input name="nama_produk" type="text" class="form-control col-md-7 col-md-7" value="{{$produk->nama_produk}}">
                                            @error('nama_produk')
                                            <p>{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="control-label col-md-2 col-sm-2 ">Stok</label>
                                        <div class="col-md-9 col-sm-9 ">
                                            <input name="stok" type="text" class="form-control col-md-7 col-md-7" value="{{$produk->stok}}">
                                            @error('stok')
                                            <p>{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-2 col-sm-2 ">Kategori</label>
                                        <div class="col-md-9 col-sm-9 ">
                                            <select name="kategori" class="form-control col-md-7 col-md-7">
                                                <option>Pilih Kategori</option>
                                                @if($produk->kategori == 'Pakaian dan Aksesoris')
                                                <option value="Pakaian dan Aksesoris"selected>Pakaian dan Aksesoris</option>
                                                <option value="Barang Elektronik">Barang Elektronik</option>
                                                <option value="Boneka dan Action Figure">Boneka dan Action Figure</option>
                                                <option value="Peralatan Rumah Tangga">Peralatan Rumah Tangga</option>
                                                <option value="Poster">Poster</option>
                                                <option value="Perhiasan">Perhiasan</option>
                                                <option value="Produk Kesehatan dan Kecantikan">Produk Kesehatan dan Kecantikan</option>
                                                <option value="Seni dan Kerajinan Tangan">Seni dan Kerajinan Tangan</option>
                                                @endif
                                                @if($produk->kategori == 'Barang Elekronik')
                                                <option value="Pakaian dan Aksesoris">Pakaian dan Aksesoris</option>
                                                <option value="Barang Elektronik"selected>Barang Elektronik</option>
                                                <option value="Boneka dan Action Figure">Boneka dan Action Figure</option>
                                                <option value="Peralatan Rumah Tangga">Peralatan Rumah Tangga</option>
                                                <option value="Poster">Poster</option>
                                                <option value="Perhiasan">Perhiasan</option>
                                                <option value="Produk Kesehatan dan Kecantikan">Produk Kesehatan dan Kecantikan</option>
                                                <option value="Seni dan Kerajinan Tangan">Seni dan Kerajinan Tangan</option>
                                                @endif
                                                @if($produk->kategori == 'Boneka Dan Action Figure')
                                                <option value="Pakaian dan Aksesoris">Pakaian dan Aksesoris</option>
                                                <option value="Barang Elektronik">Barang Elektronik</option>
                                                <option value="Boneka dan Action Figure"selected>Boneka dan Action Figure</option>
                                                <option value="Peralatan Rumah Tangga">Peralatan Rumah Tangga</option>
                                                <option value="Poster">Poster</option>
                                                <option value="Perhiasan">Perhiasan</option>
                                                <option value="Produk Kesehatan dan Kecantikan">Produk Kesehatan dan Kecantikan</option>
                                                <option value="Seni dan Kerajinan Tangan">Seni dan Kerajinan Tangan</option>
                                                @endif
                                                @if($produk->kategori == 'Peralatan Rumah Tangga')
                                                <option value="Pakaian dan Aksesoris">Pakaian dan Aksesoris</option>
                                                <option value="Barang Elektronik">Barang Elektronik</option>
                                                <option value="Boneka dan Action Figure">Boneka dan Action Figure</option>
                                                <option value="Peralatan Rumah Tangga"selected>Peralatan Rumah Tangga</option>
                                                <option value="Poster">Poster</option>
                                                <option value="Perhiasan">Perhiasan</option>
                                                <option value="Produk Kesehatan dan Kecantikan">Produk Kesehatan dan Kecantikan</option>
                                                <option value="Seni dan Kerajinan Tangan">Seni dan Kerajinan Tangan</option>
                                                @endif
                                                @if($produk->kategori == 'Poster')
                                                <option value="Pakaian dan Aksesoris">Pakaian dan Aksesoris</option>
                                                <option value="Barang Elektronik">Barang Elektronik</option>
                                                <option value="Boneka dan Action Figure">Boneka dan Action Figure</option>
                                                <option value="Peralatan Rumah Tangga">Peralatan Rumah Tangga</option>
                                                <option value="Poster"selected>Poster</option>
                                                <option value="Perhiasan">Perhiasan</option>
                                                <option value="Produk Kesehatan dan Kecantikan">Produk Kesehatan dan Kecantikan</option>
                                                <option value="Seni dan Kerajinan Tangan">Seni dan Kerajinan Tangan</option>
                                                @endif
                                                @if($produk->kategori == 'Perhiasan')
                                                <option value="Pakaian dan Aksesoris">Pakaian dan Aksesoris</option>
                                                <option value="Barang Elektronik">Barang Elektronik</option>
                                                <option value="Boneka dan Action Figure">Boneka dan Action Figure</option>
                                                <option value="Peralatan Rumah Tangga">Peralatan Rumah Tangga</option>
                                                <option value="Poster">Poster</option>
                                                <option value="Perhiasan"selected>Perhiasan</option>
                                                <option value="Produk Kesehatan dan Kecantikan">Produk Kesehatan dan Kecantikan</option>
                                                <option value="Seni dan Kerajinan Tangan">Seni dan Kerajinan Tangan</option>
                                                @endif
                                                @if($produk->kategori == 'Produk Kesehatan dan Kecantikan')
                                                <option value="Pakaian dan Aksesoris">Pakaian dan Aksesoris</option>
                                                <option value="Barang Elektronik">Barang Elektronik</option>
                                                <option value="Boneka dan Action Figure">Boneka dan Action Figure</option>
                                                <option value="Peralatan Rumah Tangga">Peralatan Rumah Tangga</option>
                                                <option value="Poster">Poster</option>
                                                <option value="Perhiasan">Perhiasan</option>
                                                <option value="Produk Kesehatan dan Kecantikan"selected>Produk Kesehatan dan Kecantikan</option>
                                                <option value="Seni dan Kerajinan Tangan">Seni dan Kerajinan Tangan</option>
                                                @endif
                                                @if($produk->kategori == 'Seni dan Kerajinan Tangan')
                                                <option value="Pakaian dan Aksesoris">Pakaian dan Aksesoris</option>
                                                <option value="Barang Elektronik">Barang Elektronik</option>
                                                <option value="Boneka dan Action Figure">Boneka dan Action Figure</option>
                                                <option value="Peralatan Rumah Tangga">Peralatan Rumah Tangga</option>
                                                <option value="Poster">Poster</option>
                                                <option value="Perhiasan">Perhiasan</option>
                                                <option value="Produk Kesehatan dan Kecantikan">Produk Kesehatan dan Kecantikan</option>
                                                <option value="Seni dan Kerajinan Tangan"selected>Seni dan Kerajinan Tangan</option>
                                                @endif
                                            </select>
                                            @error('kategori')
                                                <p>{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-2 col-sm-2 ">Harga Produk </label>
                                        <div class="col-md-9 col-sm-9 ">
                                            <label class="control-label col-md-1 col-sm-1 ">RP.</label>
                                            <input name="harga_produk" type="number" class="form-control col-md-6 col-md-6" value="{{$produk->harga_produk}}">
                                            @error('harga_produk')
                                            <p>{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-9 col-sm-9 offset-md-2">
                                            <a href="{{ route('produk.index')}}"type="button" class="btn btn-primary">Cancel</a>
                                            <button type="reset" class="btn btn-primary">Reset</button>
                                            <input type="submit" name="submit" class="btn btn-success" value="Submit">
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

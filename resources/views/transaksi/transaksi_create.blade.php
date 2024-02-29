@extends('admin')
@section('content')
<head>
    <style>
        .form-group.row {
  display: flex;
  align-items: center;
}

.form-group.row label {
  flex: 0 0 100px;
  white-space: nowrap;
}

.form-group.row input,
.form-group.row button {
  flex: 1 1 auto;
}
    </style>
</head>
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
                                <form action="{{ route('transaksi.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="nama_pelanggan" class="control-label col-md-10 col-sm-10">Nama pelanggan</label>
                                            <div class="col-md-9 col-sm-9">
                                                <input name="nama_pelanggan" type="text" id="nama_pelanggan" class="form-control col-md-10 col-md-10" placeholder="Nama Pelanggan">
                                                @error('nama_pelanggan')
                                                <p>{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="id_produk" class="control-label col-md-4 col-sm-4 input-group-prepend ">Daftar Kategori</label>
                                                <div class="input-group">
                                                    @php
                                                    // Mengelompokkan produk berdasarkan kategori
                                                    $produk_by_kategori = $produk->groupBy('kategori');
                                                    @endphp
                                                    <select class="form-control" id="kategori_produk">
                                                        <option value="">Pilih Kategori</option>
                                                        @foreach ($produk_by_kategori as $kategori => $produk_kategori)
                                                            <option value="{{ $kategori }}">{{ $kategori }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="id_produk" class="control-label col-md-4 col-sm-4 input-group-prepend ">Daftar Produk</label>
                                                <div class="input-group">
                                                    <select class="form-control" id="id_produk">
                                                        @php
                                                            // Mengurutkan produk berdasarkan nama
                                                            $produk_sorted = $produk->sortBy('nama_produk');
                                                        @endphp
                                                        @foreach ($produk_sorted as $produk)
                                                            <option value="{{ $produk->id_produk}}" data-nama="{{ $produk->nama_produk }}" data-harga="{{ $produk->harga_produk }}" data-id="{{ $produk->id_produk }}">({{$produk->kategori}}) {{ $produk->nama_produk }} - Rp.{{ number_format($produk->harga_produk) }} (Stok: {{ $produk->stok }})</option>
                                                        @endforeach
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="">&nbsp;</label>
                                                <button type="button" id="tambahproduk" class="btn btn-primary d-block" onclick="tambahItem()">Tambah Produk</button>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" id="search_produk" class="form-control" placeholder="Cari produk...">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12 table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Produk</th>
                                                        <th>Quantity</th>
                                                        <th>Harga</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="transaksiItem">

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="2">Jumlah</th>
                                                        <th class="quantity">0</th>
                                                        <th class="totalHarga">0</th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                            <div class="form-group">
                                                <label for="uang_bayar" class="control-label col-md-3 col-sm-3">Uang Bayar</label>
                                                <div class="col-md-9 col-sm-9">
                                                    <label for="uang_bayar" class="control-label col-md-2 col-sm-2 ">RP.</label>
                                                    <input name="uang_bayar" type="number" id="uang_bayar" class="form-control col-md-10 col-md-10" placeholder="Rp.">
                                                    @error('uang_bayar')
                                                    <p>{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                            <label for="uang_kembali" class="control-label col-md-3 col-sm-3"></label>
                                            <div class="col-md-9 col-sm-9">
                                                <label for="uang_kembali" class="control-label col-md-2 col-sm-2 ">RP.</label>
                                                <input name="uang_kembali" type="number" id="uang_kembali" class="form-control col-md-10 col-md-10" placeholder="Rp."Readonly>
                                                @error('uang_kembali')
                                                <p>{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="hidden" name="total_harga" value="0">
                                            <a href="{{ route('transaksi.index')}}"type="button" class="btn btn-primary">Cancel</a>
                                            <button type="reset" class="btn btn-primary">Reset</button>
                                            <button type="submit" name="submit" class="btn btn-success">Simpan Transaksi</button>
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
@section('js')
<script>
    // Mendefinisikan variabel global untuk total harga, jumlah barang, dan daftar item transaksi
    var totalHarga = 0;
    var quantity = 0;
    var listItem = [];
    // Fungsi untuk melakukan pencarian dan memperbarui tampilan daftar produk
    function searchProduk() {
        var input = $('#search_produk').val().toLowerCase(); // Ambil nilai input pencarian dan konversi ke huruf kecil
        $('#id_produk option').filter(function() { // Filter opsi daftar produk
            $(this).toggle($(this).text().toLowerCase().indexOf(input) > -1); // Toggle tampilan opsi berdasarkan pencarian
        });
        }
        // Panggil fungsi searchProduk() setiap kali nilai input pencarian berubah
        $('#search_produk').on('input', function() {
            searchProduk();
    });
    // Fungsi untuk menambahkan item baru ke dalam daftar transaksi
    function tambahItem(){
        // Menambahkan harga produk yang dipilih ke total harga
        updateTotalHarga(parseInt($('#id_produk').find(':selected').data('harga')))

        // Mencari apakah item yang sama sudah ada dalam daftar
        var item = listItem.filter((el) => el.id_produk === $('#id_produk').find(':selected').data('id'));

        // Jika item sudah ada, tingkatkan jumlahnya; jika tidak, tambahkan item baru ke dalam daftar
        if(item.length > 0){
            item[0].quantity += 1;
        }else{
            var item = {
                id_produk: $('#id_produk').find(':selected').data('id'),
                nama: $('#id_produk').find(':selected').data('nama'),
                harga: $('#id_produk').find(':selected').data('harga'),
                quantity: 1
            };
            listItem.push(item);
        }
        
        // Menambah jumlah barang dan memperbarui tabel transaksi
        updateQuantity(1);
        updateTable();
        // Setelah menambah item baru, perbarui dropdown produk berdasarkan kategori yang dipilih
        filterProdukByKategori();
    }
    // Fungsi untuk memperbarui tabel transaksi dengan item-item terbaru
    function updateTable(){
        var html = '';
        // Membuat baris HTML untuk setiap item dalam daftar transaksi
        listItem.map((el,index) => {
            var harga = formatRupiah(el.harga.toString()); // Mengformat harga menjadi format mata uang
            var quantity = formatRupiah(el.quantity.toString()); // Mengformat jumlah barang menjadi format mata uang
            html += `
            <tr>
                <td>${index + 1}</td>
                <td>${el.nama}</td>
                <td>${quantity}</td>
                <td>${harga}</td>
                <td>
                    <input type="hidden" name="id_produk[]" value="${el.id_produk}">
                    <input type="hidden" name="quantity[]" value="${el.quantity}">
                    <button type="button" onclick="deleteItem(${index})" class="btn btn-link">
                        <i class="fa fa-trash text-danger"></i>
                    </button>
                </td>
            </tr>
            `;
        });
        $('.transaksiItem').html(html); // Memperbarui isi tabel transaksi dengan HTML yang baru
    }
    // Fungsi untuk menghapus item dari daftar transaksi
    function deleteItem(index){
        var item = listItem[index];
        if(item.quantity > 1){
            listItem[index].quantity -= 1; // Mengurangi jumlah jika lebih dari satu
            updateTotalHarga(-(item.harga)); // Mengurangi total harga
            updateQuantity(-1); // Mengurangi jumlah barang
        }else{
            listItem.splice(index,1); // Hapus item jika jumlahnya satu
            updateTotalHarga(-(item.harga * item.quantity)); // Mengurangi total harga (menangani kasus ketika quantity tidak terdefinisi)
            updateQuantity(-(item.quantity)); // Mengurangi jumlah barang (menangani kasus ketika quantity tidak terdefinisi)
        }
        updateTable(); // Memperbarui tabel transaksi setelah menghapus item
    }

    // Fungsi untuk memperbarui total harga dengan menambah atau mengurangi nilai nominal
    function updateTotalHarga(nom){
        totalHarga += nom; // Menambah atau mengurangi total harga
        $('[name=total_harga]').val(totalHarga); // Memperbarui nilai input hidden dengan total harga numerik
        $('.totalHarga').html(formatRupiah(totalHarga.toString())); // Memperbarui tampilan total harga di tabel dengan format mata uang
    }

    // Fungsi untuk memperbarui jumlah barang dengan menambah atau mengurangi nilai nominal
    function updateQuantity(nom){
        quantity += nom; // Menambah atau mengurangi jumlah barang
        $('.quantity').html(formatRupiah(quantity.toString())); // Memperbarui tampilan jumlah barang di tabel dengan format mata uang
    }
    // Fungsi untuk menghitung uang kembali tanpa number format
    // function hitungUangKembali() {
    //     var totalHarga = parseFloat($('[name=total_harga]').val());
    //     var uangBayar = parseFloat($('#uang_bayar').val());

    //     // Periksa apakah nilai uang bayar valid
    //     if (!isNaN(totalHarga) && !isNaN(uangBayar)) {
    //         var uangKembali = uangBayar - totalHarga;
    //         // Update nilai input uang kembali tanpa format
    //         $('#uang_kembali').val(uangKembali);
    //     }
    // }

    // // Panggil fungsi hitungUangKembali() setiap kali nilai uang bayar berubah
    // $('#uang_bayar').on('input', function() {
    //     hitungUangKembali();
    // });
    // Fungsi untuk menghitung uang kembali
    function hitungUangKembali() {
        var totalHarga = parseFloat($('[name=total_harga]').val());
        var uangBayarString = $('#uang_bayar').val(); // Ambil nilai uang bayar dalam bentuk string
        var uangBayar = parseFloat(uangBayarString.replace(/\./g, '')); // Hilangkan format uang dengan menghapus titik
    
        // Periksa apakah nilai uang bayar valid
        if (!isNaN(totalHarga) && !isNaN(uangBayar)) {
            var uangKembali = uangBayar - totalHarga;
            $('#uang_kembali').val(formatRupiah(uangKembali.toString())); // Update nilai input uang kembali dengan format mata uang
        }
    }
    
    // Panggil fungsi hitungUangKembali() setiap kali nilai uang bayar berubah
    $('#uang_bayar').on('input', function() {
        hitungUangKembali();
    });
    // Fungsi untuk menghitung uang kembali
    // function hitungUangKembali() {
    //     var totalHarga = parseFloat($('[name=total_harga]').val());
    //     var uangBayar = parseFloat($('#uang_bayar').val());

    //     // Periksa apakah nilai uang bayar valid
    //     if (!isNaN(totalHarga) && !isNaN(uangBayar)) {
    //         var uangKembali = uangBayar - totalHarga;
    //         $('#uang_kembali').val(uangKembali); // Update nilai input uang kembali
    //     }
    // }

    // // Panggil fungsi hitungUangKembali() setiap kali nilai uang bayar berubah
    // $('#uang_bayar').on('input', function() {
    //     hitungUangKembali();
    // });
    // Fungsi untuk memfilter produk berdasarkan kategori yang dipilih
function filterProdukByKategori() {
    var selectedKategori = $('#kategori_produk').val(); // Ambil nilai kategori yang dipilih
    $('#id_produk option').each(function() {
        // Toggle tampilan opsi berdasarkan kategori yang dipilih
        $(this).toggle(selectedKategori === '' || $(this).text().indexOf(selectedKategori) > -1);
    });
}

// Panggil fungsi filterProdukByKategori() setiap kali nilai dropdown kategori berubah
$('#kategori_produk').on('change', function() {
    filterProdukByKategori();
});
// Fungsi untuk mereset dropdown kategori dan menampilkan semua produk
function resetProduk() {
    $('#kategori_produk').val(''); // Mengatur nilai dropdown kategori menjadi kosong
    filterProdukByKategori(); // Menampilkan semua produk
}

// Panggil fungsi resetProduk() saat tombol reset ditekan
$('button[type="reset"]').on('click', function() {
    resetProduk();
});

</script>
@endsection


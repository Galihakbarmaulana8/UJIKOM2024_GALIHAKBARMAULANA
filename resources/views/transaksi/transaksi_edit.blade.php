@extends('admin')
@section('content')
<body class="nav-md">
    <div class="container body">
        <div class="right_col" role="main">
            <div class="x_panel">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h6 class="mb-4">Edit data transaksi</h6>
                                <div class="ln_solid"></div>
                                <form action= "{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <!-- Input Nama Pelanggan -->
                                        <div class="form-group">
                                            <label for="nama_pelanggan" class="control-label col-md-10 col-sm-10">Nama pelanggan</label>
                                            <div class="col-md-9 col-sm-9">
                                                <input name="nama_pelanggan" type="text" id="nama_pelanggan" class="form-control col-md-10 col-md-10" value="{{$transaksi->nama_pelanggan}}" required>
                                                @error('nama_pelanggan')
                                                <p>{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Daftar Produk -->
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="id_produk" class="control-label col-md-4 col-sm-4 ">Daftar Produk</label>
                                                <div class="input-group">
                                                    <!-- Dropdown daftar produk -->
                                                    <select class="form-control" id="id_produk">
                                                        @foreach ($produk as $produk)
                                                            @if (in_array($produk->id_produk, $produkTerpilih))
                                                                <option value="{{ $produk->id_produk }}" data-nama="{{ $produk->nama_produk }}" data-harga="{{ $produk->harga_produk }}" data-id="{{ $produk->id_produk }}" selected>{{ $produk->nama_produk }} - Rp.{{ number_format($produk->harga_produk) }} (Stok: {{ $produk->stok }})</option>
                                                            @else
                                                                <option value="{{ $produk->id_produk }}" data-nama="{{ $produk->nama_produk }}" data-harga="{{ $produk->harga_produk }}" data-id="{{ $produk->id_produk }}">{{ $produk->nama_produk }} - Rp.{{ number_format($produk->harga_produk) }} (Stok: {{ $produk->stok }})</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <!-- Input pencarian -->
                                                    <div class="input-group-append">
                                                        <input type="text" id="search_produk" class="form-control" placeholder="Cari produk...">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                &nbsp;
                                                <button type="button" id="tambahproduk" class="btn btn-primary d-block" onclick="tambahItem()">Tambah Produk</button>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <!-- Tabel Transaksi -->
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
                                                    @foreach ($transaksi->items as $index => $item)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $item->nama_produk }}</td>
                                                            <td>{{ $item->quantity }}</td>
                                                            <td>Rp.{{($item->harga_produk) }}</td>
                                                            <td>
                                                                <input type="hidden" name="id_produk[]" value="{{ $item->id_produk }}">
                                                                <input type="hidden" name="nama_produk[]" value="{{ $item->nama_produk }}">
                                                                <input type="hidden" name="quantity[]" value="{{ $item->quantity }}">
                                                                <button type="button" onclick="deleteItem()" class="btn btn-link">
                                                                    <i class="fa fa-trash text-danger"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
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
                                        <!-- Input Uang Bayar -->
                                        <div class="form-group">
                                            <label for="uang_bayar" class="control-label col-md-3 col-sm-3">Uang Bayar</label>
                                            <div class="col-md-9 col-sm-9">
                                                <label for="uang_bayar" class="control-label col-md-2 col-sm-2 ">RP.</label>
                                                <input name="uang_bayar" type="number" id="uang_bayar" class="form-control col-md-10 col-md-10" placeholder="Rp." value="{{$transaksi->uang_bayar}}" required>
                                                @error('uang_bayar')
                                                <p>{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="uang_kembali" class="control-label col-md-3 col-sm-4"></label>
                                            <div class="col-md-9 col-sm-9">
                                                <label for="uang_kembali" class="control-label col-md-2 col-sm-2 ">RP.</label>
                                                <input name="uang_kembali" type="number" id="uang_kembali" class="form-control col-md-10 col-md-10" placeholder="Rp." Readonly>
                                                @error('uang_kembali')
                                                <p>{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <!-- Tombol Submit dan Reset -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="hidden" name="total_harga" value="0">
                                            <a href="{{ route('transaksi.index')}}" type="button" class="btn btn-primary">Cancel</a>
                                            <!-- <button type="reset" class="btn btn-primary">Reset</button> -->
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
    var totalHarga = 0;
    var quantity = 0;
    var listItem = [];

    // Fungsi untuk melakukan pencarian dan memperbarui tampilan daftar produk
    
    // Tambahkan script untuk memuat item transaksi yang sudah ada sebelumnya
    $(document).ready(function() {
        // Loop melalui item transaksi yang sudah ada dan tambahkan ke array listItem
        $('.transaksiItem tr').each(function() {
            var id_produk = $(this).find('input[name="id_produk[]"]').val();
            var nama = $(this).find('td:eq(1)').text();
            var quantity = parseInt($(this).find('input[name="quantity[]"]').val());
            var harga = parseInt($(this).find('td:eq(3)').text().replace('Rp.', '').replace('.', '').trim());
            var item = {
                id_produk: id_produk,
                nama: nama,
                quantity: quantity,
                harga: harga
            };
            listItem.push(item);
            updateTotalHarga(harga * quantity);
            updateQuantity(quantity);
        });
        updateTable();
    });
    // Script untuk menambahkan item ke dalam daftar transaksi
    // function tambahItem() {
    //     // Mendapatkan informasi tentang produk yang dipilih dari dropdown
    //     var selectedProduk = $('#id_produk :selected');
    //     var id_produk = selectedProduk.data('id');
    //     var nama = selectedProduk.data('nama');
    //     var harga = parseInt(selectedProduk.data('harga'));
    //     // Mencari item yang sudah ada dalam daftar transaksi
    //     var existingItem = listItem.find(item => item.id_produk === id_produk);
    //     // Jika item sudah ada, tingkatkan jumlahnya; jika tidak, tambahkan item baru ke daftar
    //     if (existingItem) {
    //         existingItem.quantity++; // Menambah jumlah jika barang sudah ada
    //         existingItem.harga = harga * existingItem.quantity; // Update harga total
    //     } else {
    //         listItem.push({id_produk: id_produk, nama: nama, quantity: 1, harga: harga}); // Menambah jumlah jika barang sudah ada
    //     }
    //     updateTotalHarga(harga); // Menambahkan harga ke total harga
    //     updateQuantity(1); // Menambahkan 1 ke jumlah barang
    //     updateTable(); // Memperbarui tabel transaksi
    // }
    function tambahItem(){
        // Menambahkan harga produk yang dipilih ke total harga
        updateTotalHarga(parseInt($('#id_produk').find(':selected').data('harga')))

        // Mencari apakah item yang sama sudah ada dalam daftar
        var item = listItem.filter((el) => el.id_produk === $('#id_produk').find(':selected').data('id'));
        // var existingItem = listItem.find((item) => item.id_produk === selectedProdukId);

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
    }
    // Fungsi untuk memperbarui tabel transaksi dengan data terbaru
    function updateTable() {
        var html = '';
        listItem.forEach(function(item, index) {
            // Membuat baris HTML untuk setiap item dalam daftar transaksi
            html += `
            <tr>
            <td>${index + 1}</td>
            <td>${item.nama}</td>
            <td>${item.quantity}</td>
            <td>Rp.${formatRupiah(item.harga)}</td>
            <td>
                <input type="hidden" name="id_produk[]" value="${item.id_produk}">
                <input type="hidden" name="quantity[]" value="${item.quantity}">
                <button type="button" onclick="deleteItem(${index})" class="btn btn-link">
                    <i class="fa fa-trash text-danger"></i>
                </button>
            </td>
            </tr>`;
        });
        $('.transaksiItem').html(html);  // Memperbarui isi tabel transaksi dengan HTML yang baru
    }
    //Script untuk menghapus item dari daftar transaksi
    // function deleteItem(index) {
    //     var item = listItem[index];
    //     updateTotalHarga(-(item.harga * item.quantity)); // Kurangi total harga dengan harga barang dikali quantity
    //     updateQuantity(-item.quantity); // Kurangi jumlah barang
    //         listItem.splice(index, 1); // Hapus item dari list
    //     updateTable(); // Perbarui tabel transaksi
    // }
    // Fungsi untuk menghapus item dari daftar transaksi
    function deleteItem(index){
    var item = listItem[index];
    if(item.quantity > 1){
        listItem[index].quantity -= 1; // Mengurangi jumlah jika lebih dari satu
        updateTotalHarga(-(item.harga)); // Mengurangi total harga
        updateQuantity(-1); // Mengurangi jumlah barang
    } else {
        listItem.splice(index, 1); // Hapus item jika jumlahnya satu
        updateTotalHarga(-(item.harga * (item.quantity || 1))); // Mengurangi total harga (menangani kasus ketika quantity tidak terdefinisi)
        updateQuantity(-(item.quantity || 1)); // Mengurangi jumlah barang (menangani kasus ketika quantity tidak terdefinisi)
    }
    updateTable() // Memperbarui tabel transaksi setelah menghapus item 
    }
    // Fungsi untuk memperbarui total harga dan jumlah barang
    function updateTotalHarga(nominal) {
        totalHarga += parseInt(nominal); // Menambahkan atau mengurangi total harga
        var formattedTotal = 'Rp. ' + formatRupiah(totalHarga.toString()); // Mengonversi total harga menjadi format mata uang
        $('[name=total_harga]').val(totalHarga); // Memperbarui nilai input hidden dengan total harga numerik
        $('.totalHarga').text(formattedTotal); // Memperbarui tampilan total harga di tabel
    }
    // Fungsi untuk memperbarui jumlah barang
    function updateQuantity(nom) {
        quantity += nom; // Menambahkan atau mengurangi jumlah barang
    $('.quantity').text(formatRupiah(quantity.toString())); // Memperbarui tampilan jumlah barang di tabel
    }
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
</script>
@endsection
@extends('admin')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Guide Aplikasi Kasir</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1, h2, h3 {
            color: #333;
        }
        p {
            margin-bottom: 20px;
        }
        ul {
            margin-bottom: 20px;
        }
        .section {
            margin-bottom: 40px;
        }
        .section-title {
            margin-bottom: 10px;
            font-size: 24px;
        }
        .sub-section {
            margin-left: 20px;
        }
        .sub-section-title {
            margin-bottom: 10px;
            font-size: 20px;
        }
        .contact-info {
            margin-top: 40px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .content{
            margin-left: 10%;
        }
    </style>
</head>
<body class="nav-md">
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12">
            <div class="x-panel">
                    <div class="content">
                        <h1>User Guide Aplikasi Kasir</h1>
                        <div class="section">
                            <h2 class="section-title">Langkah-langkah untuk melakukan transaksi:</h2>
                                <ol id="transaksiSteps">
                                    <li>Saat sudah login sebagai kasir anda akan ada di halamn dashboard.</li>
                                    <li>Lalu pilih saja Add transactions yang ada di samping kiri yang akan muncul jika menekan forms.</li>
                                    <li>Jangan lupa menginput nama pelanggan.</li>
                                    <li>Pilih produk dari daftar yang tersedia.</li>
                                    <li>Masukkan jumlah produk yang ingin dibeli.</li>
                                    <li>Klik tombol "Tambah Produk".</li>
                                    <li>Jika data terlalu banyak bisa juga mencari berdasarkan kategori atau mencari produknya.</li>
                                    <li>Ulangi langkah 1-3 untuk menambah produk lainnya jika diperlukan.</li>
                                    <li>Setelah selesai memilih produk, masukkan jumlah uang yang dibayarkan.</li>
                                    <li>Klik tombol "Simpan Transaksi" untuk menyelesaikan transaksi.</li>
                                    <li>Jika sudah anda akan kembali ke tampilan data transaksi.</li>
                                    <li>Setelah itu anda hanya perlu mencetak struk di bagian kanan data.</li>
                                </ol>
                            </div>
                                <div class="section">
                                    <h2 class="section-title">Langkah-langkah untuk filtering data transaksi berdasarkan tanggal:</h2>
                                    <ol id="transaksiSteps">
                                        <li>Pilih tanggal yang di inginkan contoh tanggal "15 februari 2024 - 17 februari 2024" atau hanya 15 februari saja .</li>
                                        <li>Lalu klik tombol "Search" di pinggir nya untuk mencari atau tombol "reset" untuk mereset data yang sudah dimasukan.</li>
                                        <li>Lalu akan muncul tombol cetak PDF di bawah pencarian Tanggal dan data akan berubah sesuai tanggal yang di pilih.</li>
                                        <li>Sesudah nya anda bisa mencetak PDF bila perlu.</li>
                                        <li>Masukkan jumlah produk yang ingin dibeli.</li>
                                    </ol>
                                </div>
                            <div class="section">
                                <h2 class="section-title">Cara mengelola inventaris:</h2>
                                <ul>
                                    <li>Untuk menambah produk baru, klik tombol "Tambah Produk" di menu.</li>
                                    <li>Untuk mengedit atau menghapus produk, klik tombol "Edit" atau "Hapus" di samping produk yang bersangkutan.</li>
                                    <li>Anda juga bisa mencetak data sebagai PDF jika perlu klik tombol "Cetak PDF"</li>
                                    <li>Untuk melihat stok produk, lihat kolom "Stok" pada daftar produk.</li>
                                </ul>
                            </div>
                                <div class="section contact-info">
                                    <h2 class="section-title">Butuh Bantuan?</h2>
                                    <p>Jika Anda mengalami masalah atau memiliki pertanyaan lebih lanjut, silakan hubungi kami:</p>
                                    <p>Email: galihakbarmaulana1@gmail.com</p>
                                    <p>Github: https://github.com/Galihakbarmaulana8</p>
                                    <p>Telepon: 09503756908</p>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
</body>
@endsection

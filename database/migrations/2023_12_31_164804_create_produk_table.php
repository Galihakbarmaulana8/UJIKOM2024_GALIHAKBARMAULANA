<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('id_produk');
            $table->string('nama_produk');
            $table->integer('stok');
            $table->enum('kategori',['Pakaian dan Aksesoris', 'Barang Elektronik', 'Boneka dan Action Figure', 'Peralatan Rumah Tangga', 'Poster', 'Perhiasan', 'Produk Kesehatan dan Kecantikan', 'Seni dan Kerajinan Tangan']);
            $table->integer('harga_produk')->dafault(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};

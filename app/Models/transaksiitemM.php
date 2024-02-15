<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksiitemM extends Model
{
    use HasFactory;
    protected $table = "transaksiitem";
    protected $fillable = ["id_transaksi", "id_produk", "nama_produk", "harga_produk", "quantity"];
}

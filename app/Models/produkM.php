<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produkM extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $primaryKey = 'id_produk';
    protected $fillable = ["nama_produk", "stok", "harga_produk", "kategori"];
}

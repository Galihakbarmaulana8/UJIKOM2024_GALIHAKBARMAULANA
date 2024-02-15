<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksiM extends Model
{
    use HasFactory;
    protected $table = "transactions";
    protected $fillable = ["id_transaksi", "id_user", "nama_pelanggan","total_harga", "uang_bayar", "uang_kembali"];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->id_transaksi = $model->getRandomString();
        });
    }

    public function generateRandomString($length = 6)
    {
        $characters = '0123456789';
        $characterslength = strlen($characters);
        $randomString = '';
        for ($i=0; $i < $length; $i++)
        {
            $randomString .= $characters[rand(0,$characterslength - 1)];
        }
        return $randomString."".date("YmdHis");
    }

    public function getRandomString()
    {
        $str = $this->generateRandomString();
        return $str;
    }

    public function items()
    {
        return $this->hasMany(transaksiitemM::class, 'id_transaksi');
    }
}

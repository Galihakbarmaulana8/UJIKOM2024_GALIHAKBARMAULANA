<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class logM extends Model
{
    use HasFactory;
    protected $table = 'log';
    protected $fillable = ["id", "id_user", "activity"];

    public function getActivitylogOptions(): LogOptions
    {
        returnLogOptions::defaults()->logOnly(['id_user', 'activity']);
    }
}

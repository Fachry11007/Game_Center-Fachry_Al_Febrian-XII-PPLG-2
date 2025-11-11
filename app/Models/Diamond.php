<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diamond extends Model
{
    protected $table = 'Diamonds';

    protected $fillable = [
        'gambar',
        'item',
        'id_akun',
        'harga_beli',
        'stok'
    ];
}

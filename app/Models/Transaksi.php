<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'id_akun',
        'item',
        'metode_pembayaran',
        'jumlah_diamond',
        'harga',
        'status',
        'diskon'
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'jumlah_diamond' => 'integer',
        'diskon' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Hitung harga setelah diskon
     */
    public function getHargaSetelahDiskonAttribute()
    {
        return $this->harga - ($this->harga * ($this->diskon / 100));
    }

    /**
     * Hitung jumlah diskon
     */
    public function getJumlahDiskonAttribute()
    {
        return $this->harga * ($this->diskon / 100);
    }
}

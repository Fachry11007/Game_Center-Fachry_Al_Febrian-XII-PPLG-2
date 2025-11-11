<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiamondSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Diamonds')->insert([
            'gambar' => 'nophoto.jpg',
            'item' => 'diamond',
            'id_akun' => 14556178,
            'harga_beli' => 1000000,
            'stok' => 100
        ]);
    }
}


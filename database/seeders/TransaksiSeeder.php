<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transaksis = [
            [
                'id_akun' => 'user123',
                'item' => 'Diamond 100',
                'metode_pembayaran' => 'Transfer Bank',
                'jumlah_diamond' => 100,
                'harga' => 25000.00,
                'status' => 'success',
                'diskon' => 20.00,
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'id_akun' => 'user456',
                'item' => 'Diamond 500',
                'metode_pembayaran' => 'E-Wallet',
                'jumlah_diamond' => 500,
                'harga' => 125000.00,
                'status' => 'success',
                'diskon' => 20.00,
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(10),
            ],
            [
                'id_akun' => 'user789',
                'item' => 'Diamond 250',
                'metode_pembayaran' => 'Pulsa',
                'jumlah_diamond' => 250,
                'harga' => 62500.00,
                'status' => 'success',
                'diskon' => 20.00,
                'created_at' => now()->subDays(15),
                'updated_at' => now()->subDays(15),
            ],
            [
                'id_akun' => 'user101',
                'item' => 'Diamond 1000',
                'metode_pembayaran' => 'Kartu Kredit',
                'jumlah_diamond' => 1000,
                'harga' => 250000.00,
                'status' => 'success',
                'diskon' => 20.00,
                'created_at' => now()->subDays(20),
                'updated_at' => now()->subDays(20),
            ],
            [
                'id_akun' => 'user202',
                'item' => 'Diamond 100',
                'metode_pembayaran' => 'Transfer Bank',
                'jumlah_diamond' => 100,
                'harga' => 25000.00,
                'status' => 'pending',
                'diskon' => 20.00,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
        ];

        foreach ($transaksis as $transaksi) {
            \App\Models\Transaksi::create($transaksi);
        }
    }
}

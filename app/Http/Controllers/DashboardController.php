<?php

namespace App\Http\Controllers;

use App\Models\Diamond;
use App\Models\Transaksi;
use App\Models\Detail_Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil histori pembelian dalam 1 bulan terakhir
        $historiPembelian = Transaksi::where('created_at', '>=', now()->subMonth())
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Hitung total pembelian bulan ini
        $totalPembelianBulanIni = Transaksi::where('created_at', '>=', now()->subMonth())
            ->where('status', 'success')
            ->get()
            ->sum(function ($transaksi) {
                return $transaksi->harga_setelah_diskon;
            });

        // Hitung jumlah transaksi bulan ini
        $jumlahTransaksiBulanIni = Transaksi::where('created_at', '>=', now()->subMonth())
            ->where('status', 'success')
            ->count();

        // Promo diamond (contoh data statis, bisa diganti dengan data dinamis)
        $promoDiamond = [
            [
                'nama' => 'Diamond 100',
                'harga_normal' => 25000,
                'harga_promo' => 20000,
                'diskon' => 20,
                'gambar' => 'diamond-100.jpg'
            ],
            [
                'nama' => 'Diamond 500',
                'harga_normal' => 125000,
                'harga_promo' => 100000,
                'diskon' => 20,
                'gambar' => 'diamond-500.jpg'
            ],
            [
                'nama' => 'Diamond 1000',
                'harga_normal' => 250000,
                'harga_promo' => 200000,
                'diskon' => 20,
                'gambar' => 'diamond-1000.jpg'
            ]
        ];

        return view('home.dashboard', compact(
            'historiPembelian',
            'totalPembelianBulanIni',
            'jumlahTransaksiBulanIni',
            'promoDiamond'
        ));
    }
}

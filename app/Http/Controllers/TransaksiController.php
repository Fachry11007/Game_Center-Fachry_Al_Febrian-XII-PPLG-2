<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksis = Transaksi::latest()->paginate(10);
        return view('home.transaksi.index', compact('transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Jika ada parameter paket dari form topup
        if ($request->has('paket')) {
            // Parse paket (format: "diamond|harga")
            $paketData = explode('|', $request->paket);
            $jumlahDiamond = $paketData[0];
            $harga = $paketData[1];

            // Hitung harga otomatis
            $hargaOtomatis = ($jumlahDiamond / 100) * 25000;

            // Buat data transaksi
            $data = [
                'id_akun' => $request->id_akun,
                'item' => $jumlahDiamond . ' Diamond',
                'metode_pembayaran' => $request->metode_pembayaran,
                'jumlah_diamond' => $jumlahDiamond,
                'harga' => $hargaOtomatis,
                'diskon' => 20.0,
                'status' => 'pending'
            ];

            // Simpan transaksi
            $transaksi = Transaksi::create($data);

            // Redirect ke detail transaksi
            return redirect()->route('transaksi.show', $transaksi->id)
                ->with('success', 'Transaksi berhasil dibuat! Berikut detail pembelian Anda.');
        }

        return view('home.transaksi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_akun' => 'required|string|max:255',
            'item' => 'required|string|max:255',
            'metode_pembayaran' => 'required|in:Transfer Bank,E-Wallet,Pulsa,Kartu Kredit',
            'jumlah_diamond' => 'required|integer|min:1',
            'status' => 'required|in:pending,success,failed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['harga'] = ($request->jumlah_diamond / 100) * 25000; // Harga otomatis: 25.000 per 100 diamond
        $data['diskon'] = 20.0; // Diskon otomatis 20%

        Transaksi::create($data);

        return redirect()->route('transaksi.show', $transaksi->id)
            ->with('success', 'Transaksi berhasil dibuat! Berikut detail pembelian Anda.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('home.transaksi.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('home.transaksi.edit', compact('transaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'id_akun' => 'required|string|max:255',
            'item' => 'required|string|max:255',
            'metode_pembayaran' => 'required|in:Transfer Bank,E-Wallet,Pulsa,Kartu Kredit',
            'jumlah_diamond' => 'required|integer|min:1',
            'status' => 'required|in:pending,success,failed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $transaksi = Transaksi::findOrFail($id);
        $data = $request->all();
        $data['harga'] = ($request->jumlah_diamond / 100) * 25000; // Harga otomatis: 25.000 per 100 diamond
        $data['diskon'] = 20.0; // Diskon otomatis 20%
        $transaksi->update($data);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus');
    }
}

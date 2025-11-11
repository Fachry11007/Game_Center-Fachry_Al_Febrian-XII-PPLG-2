<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiamondController extends Controller
{
    /**
     * Show the topup page
     */
    public function topup(Request $request)
    {
        // Jika POST request (dari form input ID akun)
        if ($request->isMethod('post')) {
            $request->validate([
                'id_akun' => 'required|string|max:255',
            ]);

            return view('home.diamond.topup', [
                'id_akun' => $request->id_akun
            ]);
        }

        // Jika GET request (halaman awal)
        return view('home.diamond.topup');
    }
}

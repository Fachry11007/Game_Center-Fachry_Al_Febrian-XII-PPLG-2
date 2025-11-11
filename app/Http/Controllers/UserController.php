<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return view('home.users.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('home.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    //melakukan pengecekan inputan tidak boleh kosong
    $request->validate(
        [
            'name' => 'required|max:45',
            'email' => 'required',
            'password' => 'required',
        ]
    );

    //tambah data barang baru
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    //jika sudah menambahkan data baru, maka halaman akan dikembalikan ke user.index
    return redirect()->route('user.index')->with('success', 'data berhasil disimpan');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $user = User::findOrFail($id);
    return view('home.users.edit', compact('user'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    //melakukan pengecekan inputan tidak boleh kosong
    $request->validate(
        [
            'name' => 'required|max:45',
            'email' => 'required',
        ]
    );
    //update data barang
    $user = User::find($id);
    $user->update(
        [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]
    );
    //jika sudah menambahkan data baru, maka halaman akan dikembalikan ke user.index
    return redirect()->route('user.index')->with('success', 'Data Berhasil di edit');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    //cari data user yang akan di hapus
    $user = User::find($id);
    $user->delete();
    return redirect()->route('user.index')->with('success', 'Data Berhasil di hapus');
}
}

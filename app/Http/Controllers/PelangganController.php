<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::all();

        return view('pelanggan.index', compact('pelanggan'));
    }

    public function store(Request $request)
    {
        $duplikat = Pelanggan::where('no_hp', $request->no_hp)->where('nama', $request->nama)->exists();
        if ($duplikat) {
            return back()->withErrors(['error', 'Coba dengan no HP berbeda']);
        }

        Pelanggan::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp
        ]);

        return back()->with('success', 'Data pelanggan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::find($id);
        // $pelanggan->no_hp;
        // if ($request->no_hp == $pelanggan->no_hp && $request->nama == $pelanggan->nama) {
        //     return back()->withErrors(['error', 'Coba dengan no HP berbeda']);
        // }

        $pelanggan->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp
        ]);

        return back()->with('success', 'Data pelanggan berhasil diperbarui');
    }

    public function destroy($id){
        $pelanggan = Pelanggan::find($id);
        $pelanggan->delete();

        return back()->with('success', 'Data pelanggan berhasil dihapus');
    }
}

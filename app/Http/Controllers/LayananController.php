<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $layanan = Layanan::all();

        return view('layanan.index', compact('layanan'));
    }

    public function store(Request $request)
    {
        $harga = preg_replace('/\D/', '', $request->harga);
        $desk = array_filter(array_map('trim', explode(', ', $request->desk)));
        Layanan::create([
            'nama' => $request->nama,
            'desk' => $desk,
            'harga' => $harga
        ]);

        return back()->with('success', 'Data layanan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $layanan = Layanan::find($id);
        $harga = preg_replace('/\D/', '', $request->harga);
        $desk = array_filter(array_map('trim', explode(', ', $request->desk)));
        $layanan->update([
            'nama' => $request->nama,
            'desk' => $desk,
            'harga' => $harga
        ]);

        return back()->with('success', 'Data layanan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();

        return back()->with('success', 'Data layanan berhasil dihapus');
    }
}

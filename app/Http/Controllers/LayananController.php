<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $layanan = Layanan::all();

        return view('layanan.main', compact('layanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $desk = array_filter(array_map('trim', explode(', ', $request->desk_layanan)));
        $harga = preg_replace('/\D/', '', $request->harga_layanan);

        $duplikat = Layanan::where('nama_layanan', $request->nama_layanan)->where('desk_layanan', $desk)->where('harga_layanan', $harga)->exists();
        if($duplikat){
            return redirect()->back()->withErrors(['error' => 'Data layanan telah tersedia']);
        }

        Layanan::create([
            'nama_layanan' => $request->nama_layanan,
            'desk_layanan' => $desk,
            'harga_layanan' => $harga
        ]);

        return redirect()->back()->with('success', 'Data layanan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Layanan $layanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $layanan = Layanan::find($id);
        $desk = array_filter(array_map('trim', explode(', ', $request->desk_layanan)));
        $harga = preg_replace('/\D/', '', $request->harga_layanan);
        $layanan->update([
            'nama_layanan' => $request->nama_layanan,
            'desk_layanan' => $desk,
            'harga_layanan' => $harga
        ]);

        return redirect()->back()->with('success', 'Data layanan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();

        return redirect()->back()->with('success', 'Data layanan berhasil dihapus');
    }
}

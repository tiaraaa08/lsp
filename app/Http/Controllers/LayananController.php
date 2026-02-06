<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $layanan = Layanan::all();

        return view('layanan.index', compact('layanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $desk = array_map(array_filter('trim', explode($request->desk)));
        $harga = preg_replace('/\D/', '', $request->harga);
        Layanan::create([
            'nama' => $request->nama,
            'desk' => $desk,
            'harga' => $harga,
        ]);

        return back()->with('success', 'Data layanan berhasil ditambahkan');
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
    public function edit(Layanan $layanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $layanan = Layanan::find($id);
        $desk = array_map(array_filter('trim', explode($request->desk)));
        $harga = preg_replace('/\D/', '', $request->harga);
        $layanan->update([
            'nama' => $request->nama,
            'desk' => $desk,
            'harga' => $harga,
        ]);

        return back()->with('success', 'Data layanan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();
        
        return back()->with('success', 'Data layanan berhasil dihapus');
    }
}

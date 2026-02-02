<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggan = Pelanggan::all();

        return view('pelanggan.main', compact('pelanggan'));
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
        $duplikat = Pelanggan::where('no_hp', $request->no_hp)->exists();
        if ($duplikat) {
            return redirect()->back()->withErrors(['error', 'Silahkan coba dengan nomor hp berbeda']);
        }

        Pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat_pelanggan' => $request->alamat_pelanggan,
            'no_hp' => $request->no_hp
        ]);

        return redirect()->back()->with('success', 'Data pelanggan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::find($id);

        // $duplikat = Pelanggan::where('no_hp', $request->no_hp)->exists();
        // if ($duplikat) {
        //     return redirect()->back()->withErrors(['error', 'Silahkan coba dengan nomor hp berbeda']);
        // }

        $pelanggan->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat_pelanggan' => $request->alamat_pelanggan,
            'no_hp' => $request->no_hp
        ]);

        return redirect()->back()->with('success', 'Data pelanggan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pelanggan = Pelanggan::find($id);
        $pelanggan->delete();

        return redirect()->back()->with('success', 'Data pelanggan berhasil dihapus');
    }
}

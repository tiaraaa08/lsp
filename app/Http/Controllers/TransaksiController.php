<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $layanan = Layanan::all();
        $pelanggan = Pelanggan::all();
        $transaksi = Transaksi::all();

        return view('transaksi.main', compact('layanan', 'pelanggan', 'transaksi'));
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
        $bayar = preg_replace('/\D/', '', $request->harga);
        Transaksi::create([
            'tanggal' => $request->tanggal,
            'id_layanan' => $request->id_layanan,
            'id_pelanggan' => $request->id_pelanggan,
            'berat' => $request->berat,
            'bayar' => $bayar,
            'pembayaran' => $request->pembayaran,
            'keterangan' => $request->keterangan,
        ]);

        return back()->with('success', 'Data transaksi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function bayar($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->pembayaran = 'Lunas';
        $transaksi->bayar = $transaksi->layanan->harga * $transaksi->berat;
        $transaksi->save();

        return back()->with('success', 'Pembayaran berhasil diselesaikan');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);
        $bayar = preg_replace('/\D/', '', $request->harga);
        $transaksi->update([
            'tanggal' => $request->tanggal,
            'id_layanan' => $request->id_layanan,
            'id_pelanggan' => $request->id_pelanggan,
            'berat' => $request->berat,
            'bayar' => $bayar,
            'pembayaran' => $request->pembayaran,
            'keterangan' => $request->keterangan,
        ]);

        return back()->with('success', 'Data transaksi berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return back()->with('success', 'Data transaksi berhasil dihapu');
    }
}

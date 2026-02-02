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
        $pelanggan = Pelanggan::all();
        $layanan = Layanan::all();
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
        $bayar = preg_replace('/\D/', '', $request->jumlah_bayar);
        Transaksi::create([
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'id_pelanggan' => $request->id_pelanggan,
            'id_layanan' => $request->id_layanan,
            'berat' => $request->berat,
            'jumlah_bayar' => $bayar,
            'keterangan' => 'Proses',
            'pembayaran' => $request->pembayaran
        ]);

        return redirect()->back()->with('success', 'Data transaksi berhasil disimpan');
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
        $transaksi = Transaksi::find($id);
        $transaksi->pembayaran = 'Lunas';
        $transaksi->save();
        return redirect()->back()->with('success', 'Data layanan berhasil diperbarui');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);
        $bayar = preg_replace('/\D/', '', $request->jumlah_bayar);
        $transaksi->update([
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'id_pelanggan' => $request->id_pelanggan,
            'id_layanan' => $request->id_layanan,
            'berat' => $request->berat,
            'jumlah_bayar' => $bayar,
            'keterangan' => 'Proses',
            'pembayaran' => $request->pembayaran
        ]);

        return redirect()->back()->with('success', 'Data transaksi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();


        return redirect()->back()->with('success', 'Data transaksi berhasil dihapus');
    }
}

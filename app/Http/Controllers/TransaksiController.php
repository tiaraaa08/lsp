<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::all();
        $pelanggan = Pelanggan::all();
        $layanan = Layanan::all();

        return view('transaksi.index', compact('transaksi', 'pelanggan', 'layanan'));
    }

    public function store(Request $request)
    {
        $bayar = preg_replace('/\D/', '', $request->bayar);
        Transaksi::create([
            'tanggal' => $request->tanggal,
            'id_layanan' => $request->id_layanan,
            'id_pelanggan' => $request->id_pelanggan,
            'berat' => $request->berat,
            'bayar' => $bayar,
            'keterangan' => $request->keterangan,
            'ppembayaran' => $request->ppembayaran,
        ]);

        return back()->with('success', 'Data transaksi berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $Transaksi = Transaksi::find($id);
        $bayar = preg_replace('/\D/', '', $request->bayar);
        $Transaksi::create([
            'tanggal' => $request->tanggal,
            'id_layanan' => $request->id_layanan,
            'id_pelanggan' => $request->id_pelanggan,
            'berat' => $request->berat,
            'bayar' => $bayar,
            'keterangan' => $request->keterangan,
            'ppembayaran' => $request->ppembayaran,
        ]);

        return back()->with('success', 'Data transaksi berhasil diperbarui');
    }

    public function bayar($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->pembayaran = 'Lunas';
        $transaksi->bayar = $transaksi->layanan->harga * $transaksi->berat;
        $transaksi->save();

        return back()->with('success', 'Pembayayaran berhasil dilakukan');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return back()->with('success', 'Pembayayaran berhasil dihapus');
    }

}

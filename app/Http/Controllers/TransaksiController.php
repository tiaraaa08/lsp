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
        $layanan = Layanan::all();
        $pelanggan = Pelanggan::all();
        $transaksi = Transaksi::all();

        return view('transaksi.index', compact('layanan', 'pelanggan', 'transaksi'));
    }

    public function store(Request $request)
    {
        $bayar = preg_replace('/\D/', '', $request->bayar);
        Transaksi::create([
            'tanggal' => $request->tanggal,
            'id_pelanggan' => $request->id_pelanggan,
            'id_layanan' => $request->id_layanan,
            'berat' => $request->berat,
            'bayar' => $bayar,
            'keterangan' => $request->keterangan,
            'pembayaran' => $request->pembayaran
        ]);

        return back()->with('success', 'Data transaksi berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);
        if ($request->bayar == 'Belum Bayar') {
            $bayar = 0;
        } elseif ($request->pembayaran == 'Lunas') {
            $bayar = preg_replace('/\D/', '', $request->bayar);
        }
        $transaksi->update([
            'tanggal' => $request->tanggal,
            'id_pelanggan' => $request->id_pelanggan,
            'id_layanan' => $request->id_layanan,
            'berat' => $request->berat,
            'bayar' => $bayar,
            'keterangan' => $request->keterangan,
            'pembayaran' => $request->pembayaran
        ]);

        return back()->with('success', 'Data transaksi berhasil ditambahkan');
    }

    public function bayar($id)
    {
        $transaksi = Transaksi::finc($id);
        $transaksi->pembayaran = 'Lunas';
        $transaksi->bayar = $transaksi->layanan->harga * $transaksi->berat;
        $transaksi->save();

        return back()->with('success', 'Pembayaran berhasil dilakukan');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return back()->with('success', 'Data transaksi berhasil dihapus');
    }
}

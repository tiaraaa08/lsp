<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class FiturController extends Controller
{
    public function dashboard()
    {
        $pelanggan = Pelanggan::all();
        $layanan = Layanan::all();
        $transaksi = Transaksi::all();
        $blmBayar = Transaksi::where('pembayaran', 'Belum Bayar');

        return view('fitur.dashboard', compact('layanan', 'pelanggan', 'transaksi', 'blmBayar'));
    }

    public function laporan(Request $request){
        $query = Transaksi::query();

        if($request->hariMulai && !$request->hariAkhir){
            $query->whereDate('tanggal_transaksi', '>=', $request->hariMulai);
        }
        if(!$request->hariMulai && $request->hariAkhir){
            $query->whereDate('tanggal_transaksi', '<=', $request->hariAkhir);
        }
        if($request->hariMulai && $request->hariAkhir){
            $query->WhereBetween('tanggal_transaksi', [
                $request->hariMulai,
                $request->hariAkhir
            ]);
        }
        $transaksi = $query->get();

        return view('fitur.laporan', compact('transaksi'));
    }

    public function struk($id) {
        $transaksi = Transaksi::find($id);

        return view('fitur.struk', compact('transaksi'));
    }
}

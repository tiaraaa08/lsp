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

        $transaksi = Transaksi::all();
        $pelanggan = Pelanggan::all();
        $layanan = Layanan::all();

        return view('fitur.dashboard', compact('transaksi', 'pelanggan', 'layanan'));
    }

    public function laporan(Request $request)
    {
        $query = Transaksi::query();

        if ($request->hariMulai && !$request->hariAkhir) {
            $query->whereDate('tanggal', '>=', $request->hariMulai);
        } elseif (!$request->hariMulai && $request->hariAkhir) {
            $query->whereDate('tanggal', '<=', $request->hariAkhir);
        } elseif($request->hariMulai && $request->hariAkhir) {
            $query->whereBetween('tanggal', [
                $request->hariMulai,
                $request->hariAkhir,
            ]);
        }
        $transaksi= $query->get();

        return view('fitur.laporan', compact('transaksi'));
    }

    public function struk($id){
        $transaksi = Transaksi::find($id);

        return view('fitur.struk', compact('transaksi'));
    }
}

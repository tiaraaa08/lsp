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
        $layanan = Layanan::count();
        $pelanggan = Pelanggan::count();
        $transaksi = Transaksi::latest('tanggal')->paginate(5);
        $selesai = Transaksi::where('keterangan', 'Selesai')->where('pembayaran', 'Lunas')->count();

        return view('fitur.dashboard', compact('layanan', 'pelanggan', 'transaksi', 'selesai'));
    }

    public function laporan(Request $request)
    {
        $query = Transaksi::query()
            ->where('keterangan', 'Selesai')
            ->where('pembayaran', 'Lunas');

        if ($request->hariMulai && !$request->hariAkhir) {
            $query->whereDate('tanggal', '>=', $request->hariMulai);
        } elseif (!$request->hariMulai && $request->hariAkhir) {
            $query->whereDate('tanggal', '<=', $request->hariAkhir);
        } elseif ($request->hariMulai && $request->hariAkhir) {
            $query->whereBetween('tanggal', [
                $request->hariMulai,
                $request->hariAkhir
            ]);
        }

        $transaksi = $query->get();

        return view('fitur.laporan', compact('transaksi'));
    }

    public function struk($id)
    {
        $transaksi = Transaksi::find($id);

        return view('fitur.struk', compact('transaksi'));
    }
}

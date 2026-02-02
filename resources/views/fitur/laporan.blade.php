@extends('main')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row my-3">
                <div class="col-7">
                    <h4 class="align-middle card-title">Laporan Transaksi</h4>
                </div>
                <div class="col-5">
                    <div class="input-group float-end d-flex align-items-center">
                        <input type="date" class="form-control hariMulai border" value="{{ request('hariMulai') }}"
                            oninput="filterTanggal()">
                        <span class="fw-semibold">–</span>
                        <input type="date" class="form-control hariAkhir border" value="{{ request('hariAkhir') }}"
                            oninput="filterTanggal()">
                        <button type="button" class="btn btn-success" onclick="printTable()">
                            Cetak
                        </button>
                    </div>
                </div>
            </div>
            <div class="table-responsive" id="printTable">
                <table class="table table-bordered" id="laporanTable">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Tanggal</td>
                            <td>Pelanggan</td>
                            <td>Layanan</td>
                            <td>Nominal</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $t)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ Carbon\carbon::parse($t->tanggal_transaksi)->translatedFormat('d F Y') }}</td>
                                <td>
                                    <div class="text-nowrap">{{ $t->pelanggan->nama_pelanggan }}</div>
                                    <div class="text-nowrap">{{ $t->pelanggan->no_hp }}</div>
                                </td>
                                <td>
                                    <div class="text-nowrap">{{ $t->layanan->nama_layanan }} <div class="float-end">=> Rp
                                            {{ number_format($t->layanan->harga_layanan) }}</div>
                                    </div>
                                    <div class="text-nowrap">{{ $t->berat }} KG</div>
                                </td>
                                <td>Rp {{ number_format($t->layanan->harga_layanan * $t->berat, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

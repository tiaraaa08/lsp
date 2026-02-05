@extends('main')
@section('title', 'Transaksi')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="fs-4 fw-medium">Data Transaksi</div>
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                    data-bs-target="#tambahTransaksi"><i class="fa fa-plus"></i></button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="TransaksiTable">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Tanggal</td>
                            <td>Pelanggan</td>
                            <td>Layanan </td>
                            <td>Berat</td>
                            <td>Jumlah Bayar</td>
                            <td>Pembayaran</td>
                            <td>Keterangan</td>
                            <td>Aksi</td>
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
                                <td>{{ $t->layanan->nama_layanan }}</td>
                                <td>{{ $t->berat }} KG</td>
                                <td>Rp {{ number_format($t->jumlah_bayar, 0, ',', '.') }}</td>
                                <td>{{ $t->keterangan }}</td>
                                <td>
                                    @if ($t->pembayaran == 'Belum Bayar')
                                        <span class="text-danger">{{ $t->pembayaran }}</span>
                                        <form action="{{ route('transaksi.bayar', $t->id) }}" method="POST"
                                            class="konfirmasiBayar">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Bayar</button>
                                        </form>
                                    @endif
                                    @if ($t->pembayaran == 'Lunas')
                                        <span class="text-success">{{ $t->pembayaran }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                                            data-bs-target="#editTransaksi{{ $t->id }}"><i
                                                class="fa fa-pencil"></i></button>
                                        <form action="{{ route('transaksi.destroy', $t->id) }}" method="POST"
                                            class="konfirmasiHapus">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger"> <i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                        @if ($t->pembayaran == 'Lunas')
                                            <a href="{{ route('struk', $t->id) }}"><button type="button"
                                                    class="btn btn-outline-success"><i class="fa fa-print"></i></button></a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @include('transaksi.edit')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('transaksi.tambah')
@endsection

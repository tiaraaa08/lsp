@extends('main')
@section('content')
    <div class="row stat-cards">
        <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item border border-primary border-top-0">
                <div class="stat-cards-icon border border-primary">
                    <i data-feather="bar-chart-2" aria-hidden="true"></i>
                </div>
                <div class="stat-cards-info">
                    <p class="stat-cards-info__num">{{ $layanan->count() }}</p>
                    <p class="stat-cards-info__title">Total Layanan</p>
                </div>
            </article>
        </div>
        <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item border border-warning border-top-0">
                <div class="stat-cards-icon border border-warning">
                    <i data-feather="file" aria-hidden="true"></i>
                </div>
                <div class="stat-cards-info">
                    <p class="stat-cards-info__num">{{ $pelanggan->count() }}</p>
                    <p class="stat-cards-info__title">Total Pelanggan</p>
                </div>
            </article>
        </div>
        <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item border border-success border-top-0">
                <div class="stat-cards-icon border-success border">
                    <i data-feather="file" aria-hidden="true"></i>
                </div>
                <div class="stat-cards-info">
                    <p class="stat-cards-info__num">{{ $transaksi->count() }}</p>
                    <p class="stat-cards-info__title">Total Transaksi</p>
                </div>
            </article>
        </div>
        <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item border border-danger border-top-0">
                <div class="stat-cards-icon border-danger border">
                    <i data-feather="feather" aria-hidden="true"></i>
                </div>
                <div class="stat-cards-info">
                    <p class="stat-cards-info__num">{{ $blmBayar->count() }}</p>
                    <p class="stat-cards-info__title">Belum Bayar</p>
                </div>
            </article>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="fs-4 fw-medium">Transaksi Terbaru</div>
            <div class="table-responsive">
                <table class="table table-bordered" id="mainTable">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Tanggal</td>
                            <td>Pelanggan</td>
                            <td>Layanan</td>
                            <td>Nominal</td>
                            <td>Keterangan</td>
                            <td>Pembayaran</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $t)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ Carbon\carbon::parse($t->tanggal_transaksi)->translatedFormat('d F Y') }}</td>
                                <td>{{ $t->pelanggan->nama_pelanggan }}</td>
                                <td>
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <div class="text-nowrap">
                                                {{ $t->layanan->nama_layanan }}
                                            </div>
                                            <div class="text-nowrap">
                                              Rp {{ number_format($t->layanan->harga_layanan, 0, ',', '.') }}
                                            </div>
                                        </div>
                                        {{ $t->berat }} KG
                                    </div>
                                </td>
                                <td>Rp {{ number_format($t->jumlah_bayar, 0, ',', '.') }}</td>
                                <td>{{ $t->keterangan }}</td>
                                <td>
                                    @if ($t->pembayaran == 'Belum Bayar')
                                        <span class="text-danger">{{ $t->pembayaran }}</span>
                                    @else
                                        <span class="text-success">{{ $t->pembayaran }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


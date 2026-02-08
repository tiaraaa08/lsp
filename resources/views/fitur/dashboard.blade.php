@extends('main')
@section('title', 'Dashboard')
@section('content')
    <div class="row mb-4">
        <div class="col-md-4 col-xl-4">
            <article class="stat-cards-item">
                <div class="stat-cards-icon primary">
                    <i data-feather="bar-chart-2" aria-hidden="true"></i>
                </div>
                <div class="stat-cards-info">
                    <p class="stat-cards-info__num">{{ $layanan }}</p>
                    <p class="stat-cards-info__title">Jumlah Layanan</p>
                </div>
            </article>
        </div>
        <div class="col-md-4 col-xl-4">
            <article class="stat-cards-item">
                <div class="stat-cards-icon warning">
                    <i data-feather="file" aria-hidden="true"></i>
                </div>
                <div class="stat-cards-info">
                    <p class="stat-cards-info__num">{{ $pelanggan }}</p>
                    <p class="stat-cards-info__title">Jumlah Pelanggan</p>
                </div>
            </article>
        </div>
        <div class="col-md-4 col-xl-4">
            <article class="stat-cards-item">
                <div class="stat-cards-icon purple">
                    <i data-feather="file" aria-hidden="true"></i>
                </div>
                <div class="stat-cards-info">
                    <p class="stat-cards-info__num">{{ $selesai }}</p>
                    <p class="stat-cards-info__title">Transaksi Selesai</p>
                </div>
            </article>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div class="d-flex justify-content-between mb-3">
                    <h3>Transaksi Terbaru</h3>
                </div>
                <table class="table table-bordered" id="layananTable">
                    <thead>
                        <tr class="users-table-info">
                            <th>No</th>
                            <th>Pelanggan</th>
                            <th>Layanan</th>
                            <th>Pembayaran</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $t)
                            <tr>
                                <td>{{ $loop->iteration }}
                                </td>
                                <td>
                                    <div class="text-nowrap"> {{ $t->pelanggan->nama }}</div>
                                    <div class="text-nowrap"> {{ $t->pelanggan->no_hp }}</div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <div class="text-nowrap">{{ $t->layanan->nama }}</div>
                                            <div class="text-nowrap">Rp{{ number_format($t->layanan->harga) }}</div>
                                        </div>
                                        {{ $t->berat }}KG
                                    </div>
                                </td>
                                <td>
                                    @if ($t->pembayaran == 'Belum Bayar')
                                        <div class="text-danger">{{ $t->pembayaran }}</div>
                                        </form>
                                    @else
                                        <div class="text-success">{{ $t->pembayaran }}</div>
                                    @endif
                                </td>
                                <td>
                                    {{ $t->keterangan }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#layananTable').DataTable();
        })
    </script>
@endpush

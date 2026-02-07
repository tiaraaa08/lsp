@extends('main')
@section('title', 'Laporan')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div class="d-flex justify-content-between mb-3">
                    <h3>Transaksi Selesai</h3>
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
                                <td> @if ($t->pembayaran == 'Belum Bayar')
                                        <div class="text-danger">{{ $t->pembayaran }}</div>
                                        </form>
                                    @else
                                        <div class="text-success">{{ $t->pembayaran }}</div>
                                    @endif</td>
                                <td>
                                   {{$t->keterangan}}
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

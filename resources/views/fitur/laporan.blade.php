@extends('main')
@section('title', 'Laporan')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
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
              <div id="printTable">
                  <table class="table table-bordered" id="layananTable">
                    <thead>
                        <tr class="users-table-info">
                            <th>No</th>
                            <th>Tanggal</th>
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
                                <td>{{ Carbon\carbon::parse($t->tanggal)->translatedFormat('d F Y') }}</td>
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
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#layananTable').DataTable();
        })

        function filterTanggal() {
            const mulai = document.querySelector('.hariMulai').value;
            const akhir = document.querySelector('.hariAkhir').value;

            const params = new URLSearchParams();
            if (mulai) params.set('hariMulai', mulai);
            if (akhir) params.set('hariAkhir', akhir);

            const query = params.toString();
            window.location.href = query ? `?${query}` : window.location.pathname;
        }

        function printTable() {
            const print = document.getElementById('printTable');
            const original = document.body.innerHTML;

            const table = $('#layananTable').DataTable();
            table.destroy();

            const mulai = document.querySelector('.hariMulai')?.value;
            const akhir = document.querySelector('.hariAkhir')?.value;
            let tanggal = 'Keseluruhan';

            if (mulai && akhir) {
                tanggal = `${formatTanggal(mulai)} - ${formatTanggal(akhir)}`;
            } else if (mulai) {
                tanggal = `mulai ${formatTanggal(mulai)}`;
            } else if (akhir) {
                tanggal = `sampai ${formatTanggal(akhir)}`;
            }

            const kopSurat =
                `<div style="text-align:center; margin-top:10px">
                <h4>Laporan Transaksi</h4>
                <h3>LSP TIARA</h3>
                <hr>
                <div style="display:flex; justify-content:space-between; margin-bottom:20px">
                    <div>Nama : Tiara</div>
                    <div>Tanggal : ${tanggal}</div>
                </div>
                <hr>
            </div>
            `;

            document.body.innerHTML = kopSurat + print.innerHTML;
            window.print();
            document.body.innerHTML = original;

            window.reload();
        }

        function formatTanggal(tanggal) {
            return new Intl.DateTimeFormat('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            }).format(new Date(tanggal));
        }
    </script>
@endpush

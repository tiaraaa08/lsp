@extends('main')
@section('title', 'Transaksi')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div class="d-flex justify-content-between mb-3">
                    <h3>Data Transaksi</h3>
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#tambah"><i
                            class="fa fa-plus"></i></button>
                </div>
                <table class="table table-bordered" id="transaksiTable">
                    <thead>
                        <tr class="users-table-info">
                            <th>No</th>
                            <th>Pelanggan</th>
                            <th>Layanan</th>
                            <th>Berat</th>
                            <th>Keterangan</th>
                            <th>Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $t)
                            <tr>
                                <td>{{ $loop->iteration }}
                                </td>
                                <td>
                                    <div class="text-nowrap">{{ $t->pelanggan->nama }}</div>
                                    <div class="text-nowrap">{{ $t->pelanggan->no_hp }}</div>
                                </td>
                                <td>
                                    <div class="text-nowrap">{{ $t->layanan->nama }}</div>
                                    <div class="text-nowrap">Rp {{ number_format($t->layanan->harga, 0, ',', '.') }}</div>
                                </td>
                                <td>{{ $t->berat }} KG</td>
                                <td>{{ $t->keterangan }}</td>
                                <td>
                                    @if ($t->pembayaran == 'Belum Bayar')
                                        <div class="text-danger">{{ $t->pembayaran }}</div>
                                        <form action="{{ route('transaksi.bayar', $t->id) }}" method="POST"
                                            class="konfirmasiBayar">
                                            @csrf @method('POST')
                                            <button type="submit" class="btn btn-outline-danger"> <i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    @else
                                        <div class="text-success">{{ $t->pembayaran }}</div>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        @if ($t->pembayaran == 'Lunas')
                                            <a href="{{ route('struk', $t->id) }}"><button type="button"
                                                    class="btn btn-outline-info"><i class="fa fa-print"></i></button>
                                            </a>
                                        @endif
                                        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $t->id }}"><i class="fa fa-pencil"></i></button>
                                        <form action="{{ route('transaksi.destroy', $t->id) }}" class="konfirmasiHapus"
                                            method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#transaksiTable').DataTable();
        })

        document.addEventListener('shown.bs.modal', function(e) {
            const modal = e.target;
            const harga = modal.querySelector('.Layanan');
            const berat = modal.querySelector('.Berat');
            const nominal = modal.querySelector('.Nominal');
            const bayar = modal.querySelector('.Bayar');
            const pembayaran = modal.querySelector('.Pembayaran');
            const kembalian = modal.querySelector('.Kembalian');
            const simpan = modal.querySelector('.Simpan');

            function rupiah(angka) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(angka);
            }

            function clean(val) {
                return Number(val.replace(/\D/g, '')) || 0;
            }

            function hitung() {
                const b = Number(berat.value) || 0;
                const h = Number(harga.selectedOptions[0]?.dataset.harga) || 0;
                const hasil = b * h;

                nominal.value = hasil ? rupiah(hasil) : 0;
                hitungKembalian();
            }

            function hitungKembalian() {
                const hB = clean(bayar.value);
                const hN = clean(nominal.value);
                const kembali = hB - hN;

                kembalian.innerText = rupiah(kembali > 0 ? kembali : 0);
            }

            function validasi() {
                const vB = clean(bayar.value);
                const vN = clean(nominal.value);

                if (pembayaran.value === 'Lunas') {
                    simpan.disabled = vB < vN;
                } else {
                    simpan.disabled = false;
                }
            }

            if(bayar.value) {
                bayar.value = rupiah(clean(bayar.value));
            }

            pembayaran.addEventListener('change', function() {
                if (this.value == 'Lunas') {
                    bayar.readOnly = false;
                    hitungKembalian();
                    validasi();
                }
                if (this.value == 'Belum Bayar') {
                    bayar.value = rupiah(0);
                    bayar.readOnly = true;
                    kembalian.innerText = rupiah(0);
                    simpan.disabled = false;
                }
            })

            bayar.addEventListener('input', function() {
                this.value = rupiah(clean(this.value));
                hitungKembalian();
                validasi();
            })

            harga.addEventListener('change', () => {
                hitung();
                validasi();
            })

            berat.addEventListener('input', () => {
                hitung();
                validasi();
            })

            hitung();
            validasi();
        })
    </script>
@endpush

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

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#TransaksiTable').DataTable();
        })

        document.addEventListener('shown.bs.modal', function(e) {
            const modal = e.target;
            const harga = modal.querySelector('.Layanan');
            const berat = modal.querySelector('.Berat');
            const nominal = modal.querySelector('.Nominal');
            const bayar = modal.querySelector('.JumlahBayar');
            const pembayaran = modal.querySelector('.Pembayaran');
            const simpan = modal.querySelector('.Simpan');
            const kembalian = modal.querySelector('.Kembalian');

            function formatRupiah(angka) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(angka);
            }

            function cleanNumber(val) {
                return Number(val.replace(/\D/g, '')) || 0;
            }

            function hitung() {
                const b = Number(berat.value) || 0;
                const h = Number(harga.selectedOptions[0]?.dataset.harga) || 0;
                const hasil = b * h;

                nominal.value = hasil ? formatRupiah(hasil) : 0;
                hitungKembalian();
            }

            function hitungKembalian() {
                const HKb = cleanNumber(bayar.value) || 0;
                const HKt = cleanNumber(nominal.value) || 0;
                const kembali = HKb - HKt;

                kembalian.innerText = formatRupiah(kembali > 0 ? kembali : 0);
            }

            function validasi() {
                const Vb = cleanNumber(bayar.value) || 0;
                const Vt = cleanNumber(nominal.value) || 0;

                if (pembayaran.value === 'Lunas') {
                    simpan.disabled = Vb < Vt;
                } else {
                    simpan.disabled = false;
                }
            }

            if (bayar.value) {
                bayar.value = formatRupiah(cleanNumber(bayar.value));
            }

            bayar.addEventListener('input', function() {
                this.value = formatRupiah(cleanNumber(this.value));
                hitungKembalian();
                validasi();
            })

            pembayaran.addEventListener('change', function() {
                if (pembayaran.value == 'Lunas') {
                    bayar.readOnly = false;
                    hitungKembalian();
                    validasi();
                }
                if (pembayaran.value == 'Belum Bayar') {
                    bayar.readOnly = true;
                    bayar.value = formatRupiah(0);
                    simpan.disabled = false;
                    kembalian.innerText = formatRupiah(0);
                }
            })

            berat.addEventListener('input', function(){
                if(this.value < 0){
                    this.value = 0;
                }
                hitung();
                validasi();
            })

            harga.addEventListener('change', () => {
                hitung();
                validasi();
            })

            hitung();
            validasi();
        })
        // document.addEventListener('shown.bs.modal', function(e) {
        //     const harga = e.target.querySelectorAll('.JumlahBayar');

        //     harga.forEach((input) => {
        //         let mentah = input.value.replace(/\D/g, '');
        //         if (mentah !== 0) {
        //             input.value = new Intl.NumberFormat('id-ID', {
        //                 style: 'currency',
        //                 currency: 'IDR',
        //                 minimumFractionDigits: 0
        //             }).format(mentah);
        //         }

        //         input.addEventListener('input', function() {
        //             let val = this.value.replace(/\D/g, '');
        //             this.value = val ?
        //                 new Intl.NumberFormat('id-ID', {
        //                     style: 'currency',
        //                     currency: 'IDR',
        //                     minimumFractionDigits: 0
        //                 }).format(val) : '';
        //         })
        //     })
        // })
    </script>
@endpush

<div class="modal fade" id="editTransaksi{{ $t->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Transaksi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('transaksi.update', $t->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="exampleInputEmail1" class="form-label">Tanggal Transaksi</label>
                            <input type="date" value="{{ $t->tanggal_transaksi }}" name="tanggal_transaksi" required class="form-control border"
                                placeholder="Masukkan Nama transaksi">
                        </div>
                        <div class="col-8">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Pelanggan</label>
                                <select name="id_pelanggan" required class="form-select" id="">
                                    <option>Pilih Pelanggan</option>
                                    @foreach ($pelanggan as $p)
                                        <option value="{{ $p->id }}" {{ $t->id_pelanggan == $p->id ? 'selected' : ''}}>{{ $p->nama_pelanggan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-8">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Layanan</label>
                                <select name="id_layanan" required class="form-select Layanan" id="">
                                    <option>Pilih Layanan</option>
                                    @foreach ($layanan as $l)
                                        <option value="{{ $l->id }}" {{ $t->id_layanan == $l->id ? 'selected' : ''}} data-harga="{{ $l->harga_layanan }}">
                                            {{ $l->nama_layanan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="exampleInputEmail1" class="form-label">Berat</label>
                            <div class="input-group">
                                <input type="number" value="{{ $t->berat }}" min="0" name="berat" required class="form-control border Berat"
                                    placeholder="Masukkan Berat">
                                <div class="input-group-text">KG</div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="">Nominal</label>
                            <input type="text" placeholder="Terisi otomatis" readonly class="Nominal border form-control">
                        </div>
                        <div class="col-6">
                            <label for="">Jumlah Bayar</label>
                            <input type="text" value="{{ $t->jumlah_bayar }}" name="jumlah_bayar" required class="JumlahBayar border form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="">Keterangan</label>
                            <select name="keterangan" class="form-select Keterangan" required id="">
                                <option {{ $t->keterangan == 'Proses' ? 'selected' : '' }} value="Proses">Proses</option>
                                <option {{ $t->keterangan == 'Selesai' ? 'selected' : '' }} value="Selesai">Selesai</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="">Pembayaran</label>
                            <select name="pembayaran" class="form-select Pembayaran" required id="">
                                <option {{ $t->pembayaran == 'Belum Bayar' ? 'selected' : '' }} value="Belum Bayar">Belum Bayar</option>
                                <option {{ $t->pembayaran == 'Lunas' ? 'selected' : '' }} value="Lunas">Lunas</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div>Kembalian : Rp <span class="Kembalian"></span></div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary Simpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

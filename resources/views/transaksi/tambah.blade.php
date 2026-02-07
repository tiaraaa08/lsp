<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Transaksi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form p-1" action="{{ route('transaksi.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="exampleInputPassword1" class="form-label">Tanggal Transaksi</label>
                            <input type="date" required name="tanggal" class="form-control border"
                                placeholder="Masukkan Nama Pelanggan" id="exampleInputPassword1">
                        </div>
                        <div class="col-8">
                            <label for="exampleInputPassword1" class="form-label">Pelanggan</label>
                            <select name="id_pelanggan" required class="form-select" id="">
                                <option>Pilih Pelanggan</option>
                                @foreach ($pelanggan as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-8">
                            <label for="exampleInputPassword1" class="form-label">Layanan</label>
                            <select name="id_layanan" required class="form-select Layanan" id="">
                                <option>Pilih Layanan</option>
                                @foreach ($layanan as $l)
                                    <option value="{{ $l->id }}" data-harga="{{ $l->harga }}">{{ $p->nama }} =>
                                        Rp{{ number_format($l->harga, 0, ',', '.') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="exampleInputPassword1" class="form-label">Berat</label>
                            <div class="input-group">
                                <input type="number" required name="berat" class="form-control border Berat"
                                    placeholder="Masukkan Nama Pelanggan" id="exampleInputPassword1">
                                <div class="input-group-text">KG</div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="">Nominal</label>
                            <input type="text" class="form-control border Nominal" readonly>
                        </div>
                        <div class="col-6">
                            <label for="">Jumlah Bayar</label>
                            <input type="text" name="bayar" class="form-control border Bayar" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="">Pembayaran</label>
                            <select name="pembayaran" class="form-control Pembayaran" required id="">
                                <option>Pilih Pembayaran</option>
                                <option value="Belum Bayar">Belum Bayar</option>
                                <option value="Lunas">Lunas</option>
                            </select>
                        </div>
                        <div class="col-6">
                           <label for="">Keterangan</label>
                            <select name="keterangan" class="form-control Keterangan" required id="">
                                <option>Pilih Keterangan</option>
                                <option value="Proses">Proses</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span>Kembalian : Rp <div class="Kembalian"></div></span>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

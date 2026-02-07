<div class="modal fade" id="edit{{ $t->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Transaksi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form p-1" action="{{ route('transaksi.update', $t->id) }}" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="exampleInputPassword1" class="form-label">Tanggal Transaksi</label>
                            <input type="date" value="{{ $t->tanggal }}" required name="tanggal" class="form-control border"
                                placeholder="Masukkan Nama Pelanggan" id="exampleInputPassword1">
                        </div>
                        <div class="col-8">
                            <label for="exampleInputPassword1" class="form-label">Pelanggan</label>
                            <select name="id_pelanggan" required class="form-select" id="">
                                <option>Pilih Pelanggan</option>
                                @foreach ($pelanggan as $p)
                                    <option value="{{ $p->id }}" {{ $t->id_pelanggan ==  $p->id ? 'selected' : ''}}>{{ $p->nama }}</option>
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
                                    <option value="{{ $l->id }}" data-harga="{{ $l->harga }}" {{ $t->id_layanan == $l->id ? 'selected' : '' }}>{{ $p->nama }} =>
                                        Rp{{ number_format($l->harga, 0, ',', '.') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="exampleInputPassword1" class="form-label">Berat</label>
                            <div class="input-group">
                                <input type="number" value="{{ $t->berat }}" required name="berat" class="form-control border Berat"
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
                            <input type="text" value="{{ $t->bayar }}" name="bayar" class="form-control border Bayar" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="">Pembayaran</label>
                            <select name="pembayaran" class="form-control Pembayaran" required id="">
                                <option>Pilih Pembayaran</option>
                                <option value="Belum Bayar" {{ $t->pembayaran == 'Belum Bayar' ? 'selected' : '' }}>Belum Bayar</option>
                                <option value="Lunas" {{ $t->pembayaran == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                            </select>
                        </div>
                        <div class="col-6">
                           <label for="">Keterangan</label>
                            <select name="keterangan" class="form-control Keterangan" required id="">
                                <option>Pilih Keterangan</option>
                                <option value="Proses" {{ $t->keterangan == 'Proses' ? 'selected' : '' }}>Proses</option>
                                <option value="Selesai" {{ $t->keterangan == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span>Kembalian : <div class="Kembalian"></div></span>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary Simpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

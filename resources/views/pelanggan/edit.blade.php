<div class="modal fade" id="editPelanggan{{ $p->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Pelanggan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('pelanggan.update', $p->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Pelanggan</label>
                        <input type="text" name="nama_pelanggan" value="{{ $p->nama_pelanggan }}" required class="form-control border" placeholder="Masukkan Nama Pelanggan">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Alamat Pelanggan</label>
                        <textarea name="alamat_pelanggan" placeholder="Masukkan Alamat Pelanggan" required class="form-control" id="" cols="30" rows="10">{{ $p->alamat_pelanggan }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">No HP</label>
                        <input type="text" name="no_hp" required class="form-control border" value="{{ $p->no_hp }}" placeholder="Masukkan NO HP Pelanggan">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editLayanan{{ $l->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Layanan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('layanan.update', $l->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Layanan</label>
                        <input type="text" name="nama_layanan" value="{{ $l->nama_layanan }}" required class="form-control border" placeholder="Masukkan Nama Layanan">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Deskripsi Layanan</label>
                        <textarea name="desk_layanan" required class="form-control" id="" cols="15" rows="5">{{ implode(', ', $l->desk_layanan) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Harga Layanan</label>
                        <input type="text" name="harga_layanan" value="{{ $l->harga_layanan }}" required class="form-control border Harga" placeholder="Masukkan Harga Layanan">
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

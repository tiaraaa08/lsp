<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pelanggan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form p-1" action="{{route('pelanggan.store')}}" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="mb-2">
                         <label for="exampleInputPassword1" class="form-label">Nama Pelanggan</label>
                            <input type="text" required name="nama" class="form-control border" placeholder="Masukkan Nama Pelanggan" id="exampleInputPassword1">
                    </div>
                    <div class="mb-2">
                         <label for="exampleInputPassword1" class="form-label">Alamat Pelanggan</label>
                         <textarea name="alamat" required id="" cols="15" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="mb-2">
                         <label for="exampleInputPassword1" class="form-label">No HP Pelanggan</label>
                            <input type="text" required class="form-control border" name="no_hp" placeholder="Masukkan Harga Per KG" id="exampleInputPassword1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

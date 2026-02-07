<div class="modal fade" id="edit{{ $p->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Layanan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form p-1" action="{{route('pelanggan.update', $p->id)}}" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="mb-2">
                         <label for="exampleInputPassword1" class="form-label">Nama Layanan</label>
                            <input type="text" required name="nama" value="{{ $p->nama }}" class="form-control border" placeholder="Masukkan Nama Layanan" id="exampleInputPassword1">
                    </div>
                    <div class="mb-2">
                         <label for="exampleInputPassword1" class="form-label">Deskripsi Layanan (pisahkan dengan koma)</label>
                         <textarea name="alamat" required id="" cols="15" rows="5" class="form-control">{{ $p->alamat }}</textarea>
                    </div>
                    <div class="mb-2">
                         <label for="exampleInputPassword1" class="form-label">Harga Per KG</label>
                            <input type="text" required class="form-control border " value="{{ $p->no_hp }}" name="no_hp" placeholder="Masukkan Harga Per KG" id="exampleInputPassword1">
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

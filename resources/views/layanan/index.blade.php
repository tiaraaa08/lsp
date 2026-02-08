@extends('main')
@section('title', 'Dashboard')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div class="d-flex justify-content-between mb-3">
                    <h3>Data Layanan</h3>
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#tambah"><i
                            class="fa fa-plus"></i></button>
                </div>
                <table class="table table-bordered" id="layananTable">
                    <thead>
                        <tr class="users-table-info">
                            <th>No</th>
                            <th>Nama Layanan</th>
                            <th>Deskripsi Layanan</th>
                            <th>Harga Layanan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($layanan as $l)
                            <tr>
                                <td>{{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $l->nama }}
                                </td>
                                <td>{{ implode(', ', $l->desk) }}
                                </td>
                                <td>{{ number_format($l->harga, 0, ',', '.') }}</td>
                                <td>
                                    <div class="d-flex gap-3">
                                        <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $l->id }}"><i class="fa fa-pencil"></i></button>
                                        <form action="{{ route('layanan.destroy', $l->id) }}" class="konfirmasiHapus"
                                            method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @include('layanan.edit')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('layanan.tambah')
@endsection

@push('scripts')
    <script>
        document.addEventListener('shown.bs.modal', function(e) {
            const harga = e.target.querySelectorAll('.rupiah');
            harga.forEach((input) => {
                let mentah = input.value.replace(/\D/g, '');
                input.value = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(mentah);

                input.addEventListener('input', function() {
                    let val = this.value.replace(/\D/g, '');
                    this.value = val ?
                        new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                            minimumFractionDigits: 0
                        }).format(val) : '';
                })
            })
        })
    </script>
@endpush

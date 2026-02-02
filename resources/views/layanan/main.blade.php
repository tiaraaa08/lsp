@extends('main')
@section('title', 'Layanan')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="fs-4 fw-medium">Data Layanan</div>
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#tambahLayanan"><i
                        class="fa fa-plus"></i></button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="layananTable">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nama Layanan</td>
                            <td>Deskripsi Layanan</td>
                            <td>Harga Layanan</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($layanan as $l)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $l->nama_layanan }}</td>
                                <td>
                                    @foreach ($l->desk_layanan as $desk)
                                        <li>{{ $desk }}</li>
                                    @endforeach
                                </td>
                                <td>Rp{{ number_format($l->harga_layanan, 0, ',', '.') }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editLayanan{{ $l->id }}"><i
                                                class="fa fa-pencil"></i></button>
                                        <form action="{{ route('layanan.destroy', $l->id) }}" method="POST"
                                            class="konfirmasiHapus">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger"> <i
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

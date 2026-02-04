@extends('main')
@section('title', 'Pelanggan')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="fs-4 fw-medium">Data Pelanggan</div>
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                    data-bs-target="#tambahPelanggan"><i class="fa fa-plus"></i></button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="PelangganTable">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nama Pelanggan</td>
                            <td>Alamat </td>
                            <td>NO HP</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pelanggan as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->nama_pelanggan }}</td>
                                <td>{{ $p->alamat_pelanggan }}</td>
                                <td>{{ $p->no_hp }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editPelanggan{{ $p->id }}"><i
                                                class="fa fa-pencil"></i></button>
                                        <form action="{{ route('pelanggan.destroy', $p->id) }}" method="POST"
                                            class="konfirmasiHapus">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger"> <i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @include('pelanggan.edit')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('pelanggan.tambah')
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#PelangganTable').DataTable();
    })
</script>
@endpush

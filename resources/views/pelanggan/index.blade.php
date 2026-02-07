@extends('main')
@section('title', 'Dashboard')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div class="d-flex justify-content-between mb-3">
                    <h3>Data Pelanggan</h3>
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#tambah"><i
                            class="fa fa-plus"></i></button>
                </div>
                <table class="table table-bordered" id="pelangganTable">
                    <thead>
                        <tr class="users-table-info">
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Alamat</th>
                            <th>NO HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pelanggan as $p)
                            <tr>
                                <td>{{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $p->nama }}
                                </td>
                                <td>{{ $p->alamat }}
                                </td>
                                <td>{{ $p->no_hp }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $p->id }}"><i class="fa fa-pencil"></i></button>
                                        <form action="{{ route('pelanggan.destroy', $p->id) }}" class="konfirmasiHapus" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger"><i
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
            $('#pelangganTable').DataTable();
        })
    </script>
@endpush

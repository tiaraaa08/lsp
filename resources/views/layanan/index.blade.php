@extends('main')
@section('title', 'Dashboard')
@section('content')
<div class="card">
    <div class="card-body">
            <div class="table-responsive">
        <div class="d-flex justify-content-between mb-3">
            <h3>Data Layanan</h3>
            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-action="#tambah"><i class="fa fa-plus"></i></button>
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
                        <td>{{implode(', ', $l->desk)}}
                        </td>
                        <td>{{ number_format($l->harga, 0, ',', '.') }}</td>
                        <td>
                            <span class="p-relative">
                                <button class="dropdown-btn transparent-btn" type="button" title="More info">
                                    <div class="sr-only">More info</div>
                                    <i data-feather="more-horizontal" aria-hidden="true"></i>
                                </button>
                                <ul class="users-item-dropdown dropdown">
                                    <li><a href="##">Edit</a></li>
                                    <li><a href="##">Quick edit</a></li>
                                    <li><a href="##">Trash</a></li>
                                </ul>
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#layananTable').DataTable();
        })
    </script>
@endpush

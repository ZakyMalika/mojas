@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Data Anak Saya')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Anak yang Terdaftar</h3>
                <div class="card-tools">
                    <a href="{{ route('parent.anak.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Data Anak
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <table id="parent-anak-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Anak</th>
                            <th>Umur</th>
                            <th>Sekolah</th>
                            <th>Kelas</th>
                            <th style="width: 20%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->umur ? $item->umur . ' tahun' : '-' }}</td>
                                <td>{{ $item->sekolah ?? '-' }}</td>
                                <td>{{ $item->kelas ?? '-' }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('parent.anak.show', $item->id) }}" class="btn btn-info btn-sm" title="Detail"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('parent.anak.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm delete-btn"
                                           data-toggle="modal"
                                           data-target="#deleteConfirmationModal"
                                           data-action="{{ route('parent.anak.destroy', $item->id) }}"
                                           data-name="{{ $item->nama }}"
                                           title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center">Anda belum mendaftarkan data anak.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data: <strong id="dataNameToDelete"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    $("#parent-anak-table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
    });

    var deleteUrl = '';
    $('#parent-anak-table tbody').on('click', '.delete-btn', function (event) {
        event.preventDefault();
        deleteUrl = $(this).data('action');
        var dataName = $(this).data('name');
        $('#dataNameToDelete').text(dataName);
    });

    $('#confirmDeleteButton').on('click', function(e) {
        e.preventDefault();
        var form = $('<form>', {
            'method': 'POST', 'action': deleteUrl, 'style': 'display:none;'
        });
        form.append($('<input>', {'type': 'hidden', 'name': '_token', 'value': '{{ csrf_token() }}' }));
        form.append($('<input>', {'type': 'hidden', 'name': '_method', 'value': 'DELETE' }));
        $('body').append(form);
        form.submit();
    });
});
</script>
@endpush

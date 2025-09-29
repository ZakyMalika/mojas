@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Manajemen Tarif Jarak')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Semua Tarif Berdasarkan Jarak</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.tarif-jarak.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Tarif
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

                <table id="tarif-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Jarak (KM)</th>
                            <th>Tarif One Way</th>
                            <th>Tarif Two Way</th>
                            <th>Tarif per KM</th>
                            <th style="width: 20%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->min_distance_km }} - {{ $item->max_distance_km }} KM</td>
                                <td>Rp{{ number_format($item->tarif_one_way, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($item->tarif_two_way, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($item->tarif_per_km, 0, ',', '.') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.tarif-jarak.show', $item->id) }}" class="btn btn-info btn-sm" title="Detail"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('admin.tarif-jarak.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm delete-btn"
                                           data-toggle="modal"
                                           data-target="#deleteConfirmationModal"
                                           data-action="{{ route('admin.tarif-jarak.destroy', $item->id) }}"
                                           data-name="Tarif untuk {{ $item->jarak_dari_km }} - {{ $item->jarak_sampai_km }} KM"
                                           title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center">Belum ada data tarif.</td></tr>
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
    $("#tarif-table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": [ "excel", "pdf", "print"]
    }).buttons().container().appendTo('#tarif-table_wrapper .col-md-6:eq(0)');

    // LOGIKA HAPUS DENGAN MODAL (SOLUSI DEFINITIF)
    let urlToDelete = null;
    $('#tarif-table tbody').on('click', '.delete-btn', function (event) {
        event.preventDefault();
        urlToDelete = $(this).data('action');
        let dataName = $(this).data('name');
        $('#dataNameToDelete').text(dataName);
    });
    $('#confirmDeleteButton').on('click', function(e) {
        e.preventDefault();
        if (urlToDelete) {
            let form = $('<form>', {
                'method': 'POST', 'action': urlToDelete, 'style': 'display:none;'
            });
            form.append($('<input>', {'type': 'hidden', 'name': '_token', 'value': '{{ csrf_token() }}' }));
            form.append($('<input>', {'type': 'hidden', 'name': '_method', 'value': 'DELETE'}));
            $('body').append(form);
            form.submit();
        }
    });
});
</script>
@endpush

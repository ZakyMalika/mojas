@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Manajemen Pendaftaran Anak')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Semua Pendaftaran Layanan</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.pendaftaran-anak.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Buat Pendaftaran
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

                <!-- Search Form -->
                <div class="mb-3">
                    <form action="{{ route('admin.pendaftaran-anak.index') }}" method="GET" class="form-inline justify-content-end">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari pendaftaran..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                @if($items->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Anak</th>
                                    <th>Kemitraan Sekolah</th>
                                    <th>Tipe Layanan</th>
                                    <th>Tarif Bulanan</th>
                                    <th>Periode</th>
                                    <th>Status</th>
                                    <th style="width: 20%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $key => $item)
                                    <tr>
                                        <td>{{ $items->firstItem() + $key }}</td>
                                        <td>{{ $item->anak->nama ?? 'N/A' }}</td>
                                        <td>
                                            @if($item->school_id && $item->school)
                                                <span class="badge bg-success">
                                                    <i class="fas fa-school"></i> {{ $item->school->name }}
                                        </span>
                                        <br><small class="text-muted">Rp{{ number_format($item->school->partnership_rate, 0, ',', '.') }}/hari</small>
                                    @else
                                        <span class="badge bg-secondary">
                                            <i class="fas fa-route"></i> Umum
                                        </span>
                                        @if($item->tarif_jarak)
                                            <br><small class="text-muted">{{ $item->tarif_jarak->min_distance_km }}-{{ $item->tarif_jarak->max_distance_km }}km</small>
                                        @endif
                                    @endif
                                </td>
                                <td>{{ $item->tipe_layanan == 'one_way' ? 'Sekali Jalan' : 'Pulang Pergi' }}</td>
                                <td>Rp{{ number_format($item->tarif_bulanan, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->periode_mulai)->format('d M Y') }}</td>
                                <td>
                                    @php
                                        $statusClass = 'secondary';
                                        if ($item->status == 'pending') $statusClass = 'warning';
                                        elseif ($item->status == 'lunas') $statusClass = 'success';
                                        elseif ($item->status == 'expired') $statusClass = 'danger';
                                    @endphp
                                    <span class="badge bg-{{ $statusClass }}">{{ ucfirst($item->status) }}</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.pendaftaran-anak.show', $item->id) }}" class="btn btn-info btn-sm" title="Detail"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('admin.pendaftaran-anak.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm delete-btn"
                                           data-toggle="modal"
                                           data-target="#deleteConfirmationModal"
                                           data-action="{{ route('admin.pendaftaran-anak.destroy', $item->id) }}"
                                           data-name="Pendaftaran untuk {{ $item->anak->nama ?? 'data ini' }}"
                                           title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted">
                            Menampilkan {{ $items->firstItem() }} sampai {{ $items->lastItem() }} 
                            dari {{ $items->total() }} total data
                        </div>
                        <div>
                            {{ $items->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada data pendaftaran.</h5>
                    </div>
                @endif
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
    $("#pendaftaran-table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
               "buttons": [ "excel", "pdf", "print"]

    }).buttons().container().appendTo('#pendaftaran-table_wrapper .col-md-6:eq(0)');

    // LOGIKA HAPUS DENGAN MODAL (SOLUSI DEFINITIF)
    let urlToDelete = null;
    $('#pendaftaran-table tbody').on('click', '.delete-btn', function (event) {
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

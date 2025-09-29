@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Manajemen Pembayaran')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Semua Transaksi Pembayaran</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.pembayaran.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Buat Pembayaran
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

                <table id="pembayaran-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Orang Tua</th>
                            <th>Anak (Pendaftaran)</th>
                            <th>Jumlah Bayar</th>
                            <th>Metode</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th style="width: 20%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->orang_tua->user->name ?? 'N/A' }}</td>
                                <td>{{ $item->pendaftaran_anak->anak->nama ?? 'N/A' }}</td>
                                <td>Rp{{ number_format($item->jumlah_bayar, 0, ',', '.') }}</td>
                                <td>{{ ucfirst($item->metode_pembayaran) }}</td>
                                <td>{{ $item->tanggal_bayar ? \Carbon\Carbon::parse($item->tanggal_bayar)->format('d M Y') : '-' }}</td>
                                <td>
                                    @php
                                        $statusClass = 'secondary';
                                        if ($item->status == 'pending') $statusClass = 'warning';
                                        elseif ($item->status == 'sukses') $statusClass = 'success';
                                        elseif ($item->status == 'gagal') $statusClass = 'danger';
                                    @endphp
                                    <span class="badge bg-{{ $statusClass }}">{{ ucfirst($item->status) }}</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.pembayaran.show', $item->id) }}" class="btn btn-info btn-sm" title="Detail"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('admin.pembayaran.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm delete-btn"
                                           data-toggle="modal"
                                           data-target="#deleteConfirmationModal"
                                           data-action="{{ route('admin.pembayaran.destroy', $item->id) }}"
                                           data-name="Pembayaran an. {{ $item->orang_tua->user->name ?? 'data ini' }}"
                                           title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="text-center">Belum ada data pembayaran.</td></tr>
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
    $("#pembayaran-table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,       
         "buttons": [ "excel", "pdf", "print"]

    }).buttons().container().appendTo('#pembayaran-table_wrapper .col-md-6:eq(0)');

    // LOGIKA HAPUS DENGAN MODAL (SOLUSI DEFINITIF)
    let urlToDelete = null;
    $('#pembayaran-table tbody').on('click', '.delete-btn', function (event) {
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

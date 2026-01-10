@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Jadwal Antar Jemput Hari Ini')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tugas Antar Jemput Anda</h3>
                <div class="card-tools">
                    <a href="{{ route('driver.jadwal.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Buat Jadwal
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
                
                <div class="mb-2">
                    <button id="bulkDeleteBtn" class="btn btn-danger btn-sm" style="display: none;">
                        <i class="fas fa-trash"></i> Hapus Terpilih (<span id="selectedCount">0</span>)
                    </button>
                </div>

                <table id="jadwal-driver-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px;">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="selectAll">
                                    <label class="custom-control-label" for="selectAll"></label>
                                </div>
                            </th>
                            <th>Hari/Tanggal</th>
                            <th>Waktu Jemput</th>
                            <th>Anak</th>
                            <th>Lokasi Jemput</th>
                            <th>Lokasi Antar</th>
                            <th>Status Saat Ini</th>
                            <th style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input select-item" id="check_{{ $item->id }}" value="{{ $item->id }}">
                                        <label class="custom-control-label" for="check_{{ $item->id }}"></label>
                                    </div>
                                </td>
                                <td data-order="{{ $item->tanggal }}">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                                <td><strong>{{ \Carbon\Carbon::parse($item->jam_jemput)->format('H:i') }}</strong></td>
                                <td>{{ $item->anak->nama ?? 'N/A' }}</td>
                                <td>{{ $item->lokasi_jemput ?? $item->anak->sekolah ?? 'N/A' }}</td>
                                <td>{{ $item->lokasi_antar ?? $item->anak->alamat_penjemputan ?? 'N/A' }}</td>
                                <td>
                                    @php
                                        $statusMap = [
                                            'menunggu' => 'secondary',
                                            'dijemput' => 'info',
                                            'perjalanan' => 'primary',
                                            'selesai' => 'success',
                                            'dibatalkan' => 'danger',
                                        ];
                                        $statusClass = $statusMap[$item->status] ?? 'secondary';
                                    @endphp
                                    <span class="badge bg-{{ $statusClass }}">{{ ucfirst($item->status) }}</span>
                                </td>
                                <td>
                                    {{-- Tombol ini akan mengarahkan ke halaman edit --}}
                                    <a href="{{ route('driver.jadwal.edit', $item->id) }}" class="btn btn-warning btn-sm" {{ $item->status == 'selesai' || $item->status == 'dibatalkan' ? 'disabled' : '' }} title="Update Status">
                                        <i class="fas fa-edit"></i> Ubah
                                    </a>
                                    <form action="{{ route('driver.jadwal.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="text-center">Tidak ada jadwal untuk hari ini.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                 <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted">
                        Menampilkan {{ $items->firstItem() ?? 0 }} sampai {{ $items->lastItem() ?? 0 }} dari {{ $items->total() }} data
                    </div>
                    <div>
                        {{ $items->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>

<!-- Modal Konfirmasi Bulk Hapus -->
<div class="modal fade" id="bulkConfirmModal" tabindex="-1" role="dialog" aria-labelledby="bulkConfirmLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bulkConfirmLabel">Konfirmasi Hapus Massal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus <strong id="bulkConfirmCount"></strong> jadwal yang dipilih? Tindakan ini tidak dapat dibatalkan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmBulkDelete">Ya, Hapus Semua</button>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    $("#jadwal-driver-table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,"paging": false,
        "order": [[ 0, "desc" ]] // Urutkan dari yang terbaru
    });

    // LOGIKA SELECT ALL
    $('#selectAll').click(function() {
        $('.select-item').prop('checked', this.checked);
        toggleBulkDeleteButton();
    });

    // Check individual item
    $(document).on('change', '.select-item', function() {
        toggleBulkDeleteButton();
         // Uncheck "select all" if one is unchecked
        if(false == $(this).prop("checked")){ 
            $("#selectAll").prop('checked', false); 
        }
        // Check "select all" if all are checked
        if ($('.select-item:checked').length == $('.select-item').length ){
            $("#selectAll").prop('checked', true);
        }
    });

    function toggleBulkDeleteButton() {
        var count = $('.select-item:checked').length;
        if (count > 0) {
            $('#bulkDeleteBtn').show();
            $('#selectedCount').text(count);
        } else {
            $('#bulkDeleteBtn').hide();
        }
    }

    // BULK DELETE
    $('#bulkDeleteBtn').click(function() {
        var ids = [];
        $('.select-item:checked').each(function() {
            ids.push($(this).val());
        });

        if (ids.length > 0) {
            $('#bulkConfirmModal').modal('show');
            $('#bulkConfirmCount').text(ids.length);
        }
    });

    $('#confirmBulkDelete').click(function() {
        var ids = [];
        $('.select-item:checked').each(function() {
            ids.push($(this).val());
        });

        if(ids.length > 0) {
             // Safe CSRF check
            const metaCsrf = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = metaCsrf ? metaCsrf.getAttribute('content') : "{{ csrf_token() }}";

            $.ajax({
                url: "{{ route('driver.jadwal.bulkDestroy') }}",
                type: 'POST',
                data: {
                    _token: csrfToken,
                    _method: 'DELETE',
                    ids: ids
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan saat menghapus data.');
                    console.error(xhr);
                }
            });
        }
    });
});
</script>
@endpush


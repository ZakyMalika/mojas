@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Manajemen Penghasilan Pengemudi')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Semua Penghasilan</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.penghasilan.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Data
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
                    <form action="{{ route('admin.penghasilan.index') }}" method="GET" class="form-inline justify-content-end">
                        <div class="input-group">
                            {{-- <input type="text" name="search" class="form-control" placeholder="Cari penghasilan..." value="{{ request('search') }}"> --}}
                            {{-- <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div> --}}
                        </div>
                    </form>
                </div>

                <!-- Export Buttons -->
                <div class="mb-3">
                    <div class="btn-group mr-2" role="group">
                        <a href="{{ route('admin.penghasilan.export-excel', ['search' => request('search')]) }}" class="btn btn-success btn-sm" title="Download SEMUA data dalam Excel">
                            <i class="fas fa-file-excel"></i> Download Excel Semua
                        </a>
                    </div>
                    <div class="btn-group" role="group">
                        <a href="{{ route('admin.penghasilan.export-pdf-all', ['search' => request('search')]) }}" class="btn btn-danger btn-sm" title="Download SEMUA data dalam PDF">
                            <i class="fas fa-file-pdf"></i> Download PDF Semua
                        </a>
                        @if(request('per_page') != 'all')
                            <a href="{{ route('admin.penghasilan.export-pdf-current', ['search' => request('search'), 'per_page' => request('per_page', 15)]) }}" class="btn btn-outline-danger btn-sm" title="Download hanya halaman saat ini dalam PDF">
                                <i class="fas fa-file-pdf"></i> Download PDF Halaman Ini
                            </a>
                        @endif
                    </div>
                </div>

                <table id="tarif-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th><i class="fas fa-car-side mr-1"></i> Pengemudi</th>
                            <th><i class="fas fa-child mr-1"></i> Anak</th>
                            <th><i class="fas fa-calendar-alt mr-1"></i> Jadwal</th>
                            <th><i class="fas fa-road mr-1"></i> Tipe Layanan</th>
                            <th><i class="fas fa-coins mr-1"></i> Komisi</th>
                            <th><i class="fas fa-info-circle mr-1"></i> Status</th>
                            <th><i class="fas fa-cogs mr-1"></i> Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $items->firstItem() + $loop->index }}</td>
                                <td>{{ $item->driver->user->name ?? 'N/A' }}</td>
                                <td>{{ $item->jadwal->anak->nama ?? 'N/A' }}</td>
                                <td>{{ $item->jadwal ? \Carbon\Carbon::parse($item->jadwal->tanggal)->format('d M Y') : 'N/A' }}</td>
                                {{-- Mengambil jarak dari data pendaftaran anak yang terkait dengan jadwal --}}
                                <td>
                                    @php
                                        // Mengambil tipe layanan dari pendaftaran anak yang terkait
                                        $pendaftaran = $item->jadwal->anak->pendaftaran_anak->first();
                                        $tipe_layanan = $pendaftaran ? $pendaftaran->tipe_layanan : null;
                                        
                                        $formatted_layanan = 'N/A';
                                        if ($tipe_layanan === 'one_way') {
                                            $formatted_layanan = 'One Way';
                                        } elseif ($tipe_layanan === 'two_way') {
                                            $formatted_layanan = 'Two Way';
                                        }
                                    @endphp
                                    <strong>{{ $formatted_layanan }}</strong>
                                </td>
                                <td>Rp {{ number_format($item->komisi_pengemudi, 0, ',', '.') }}</td>
                                <td>
                                    @php
                                        $statusClass = $item->status == 'dibayar' ? 'success' : 'warning';
                                    @endphp
                                    <span class="badge bg-{{ $statusClass }}">{{ ucfirst($item->status) }}</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.penghasilan.show', $item->id) }}" class="btn btn-info btn-sm" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.penghasilan.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-sm delete-btn"
                                           data-toggle="modal"
                                           data-target="#deleteConfirmationModal"
                                           data-action="{{ route('admin.penghasilan.destroy', $item->id) }}"
                                           data-name="Penghasilan untuk Jadwal #{{ $item->jadwal_id }}"
                                           title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="text-center">Belum ada data penghasilan.</td></tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mb-2 d-flex align-items-center justify-content-between">
                    <div>
                        <form method="GET" id="perPageForm" class="form-inline">
                            @if(request('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif
                            <label for="per_page" class="mr-2">Tampilkan</label>
                            <select name="per_page" id="per_page" class="form-control form-control-sm mr-2"
                                onchange="document.getElementById('perPageForm').submit()">
                                <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10</option>
                                <option value="15" {{ request('per_page') == '15' || !request('per_page') ? 'selected' : '' }}>15</option>
                                <option value="25" {{ request('per_page') == '25' ? 'selected' : '' }}>25</option>
                                <option value="50" {{ request('per_page') == '50' ? 'selected' : '' }}>50</option>
                                <option value="100" {{ request('per_page') == '100' ? 'selected' : '' }}>100</option>
                                <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>Semua</option>
                            </select>
                            <small class="text-muted">data</small>
                        </form>
                    </div>
                </div>

                @if(request('per_page') != 'all')
                    @if($items instanceof \Illuminate\Pagination\Paginator && $items->hasPages())
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="text-muted">
                                Menampilkan {{ $items->firstItem() ?? 0 }} sampai {{ $items->lastItem() ?? 0 }} dari {{ $items->total() }} data
                            </div>
                            <div>
                                {{ $items->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    @endif
                @else
                    <div class="text-muted mt-3" style="padding: 10px; background-color: #f8f9fa; border-radius: 4px;">
                        <i class="fas fa-check-circle" style="color: #27ae60;"></i> 
                        <strong>Menampilkan {{ is_iterable($items) ? count($items) : $items->count() }} data (SEMUA DATA)</strong>
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
                <form id="deleteForm" method="POST" action="" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    

    $('#deleteConfirmationModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var action = button.data('action');
        var name = button.data('name');
        var modal = $(this);
        modal.find('#dataNameToDelete').text(name);
        modal.find('#deleteForm').attr('action', action);
    });
});
</script>
@endpush


@push('scripts')
<script>
$(function () {
    // $("#tarif-table").DataTable({
    //     "responsive": true, "lengthChange": false, "autoWidth": false,
    //     "buttons": [ "excel", "pdf", "print"]
    // }).buttons().container().appendTo('#tarif-table_wrapper .col-md-6:eq(0)');

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


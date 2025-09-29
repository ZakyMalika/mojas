@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Manajemen Penghasilan Pengemudi')

@section('content')
{{-- Kartu Ringkasan Data --}}



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

                <table id="penghasilan-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
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
                            <tr><td colspan="7" class="text-center">Belum ada data penghasilan.</td></tr>
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


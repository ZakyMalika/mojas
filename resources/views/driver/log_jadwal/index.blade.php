@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Riwayat Perjalanan Saya')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Log Aktivitas dan Riwayat Perjalanan</h3>
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

                <table id="log-jadwal-driver-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>ID Jadwal</th>
                            <th>Anak</th>
                            <th>Status Lama</th>
                            <th>Status Baru</th>
                            <th>Keterangan</th>
                            <th style="width: 10%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $item->created_at->format('d M Y, H:i') }}</td>
                                <td>#{{ $item->jadwal_id }}</td>
                                <td>{{ $item->jadwal->anak->nama ?? 'N/A' }}</td>
                                <td><span class="badge bg-secondary">{{ ucfirst($item->status_lama) }}</span></td>
                                <td><span class="badge bg-info">{{ ucfirst($item->status_baru) }}</span></td>
                                <td>{{ $item->keterangan ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('driver.log-jadwal.show', $item->id) }}" class="btn btn-info btn-sm btn-block" title="Lihat Detail">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center">Belum ada riwayat perjalanan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    $("#log-jadwal-driver-table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "order": [[ 0, "desc" ]] // Urutkan berdasarkan waktu terbaru
    });
});
</script>
@endpush

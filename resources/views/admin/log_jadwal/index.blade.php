@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Log Aktivitas Jadwal')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Semua Log Perubahan Jadwal</h3>
                {{-- Log biasanya tidak dibuat manual oleh admin, jadi tombol create disembunyikan --}}
                {{-- <div class="card-tools">
                    <a href="{{ route('admin.log-jadwal.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Log
                    </a>
                </div> --}}
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

                <table id="log-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Jadwal (Anak)</th>
                            <th>Pengemudi</th>
                            <th>Perubahan Status</th>
                            <th>Keterangan</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    ID: {{ $item->jadwal_id }} <br>
                                    <small>{{ $item->jadwal->anak->nama ?? 'Anak tidak ditemukan' }}</small>
                                </td>
                                <td>{{ $item->driver->user->name ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-secondary">{{ ucfirst($item->status_lama) }}</span>
                                    <i class="fas fa-long-arrow-alt-right mx-1"></i>
                                    <span class="badge bg-primary">{{ ucfirst($item->status_baru) }}</span>
                                </td>
                                <td>{{ \Illuminate\Support\Str::limit($item->keterangan, 30, '...') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.log-jadwal.show', $item->id) }}" class="btn btn-info btn-sm" title="Detail">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center">Belum ada data log.</td></tr>
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
    $("#log-table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "order": [[ 0, "desc" ]], // Urutkan berdasarkan ID terbaru
        "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#log-table_wrapper .col-md-6:eq(0)');
});
</script>
@endpush

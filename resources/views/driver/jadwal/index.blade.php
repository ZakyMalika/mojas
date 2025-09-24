@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Jadwal Antar Jemput Hari Ini')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tugas Antar Jemput Anda</h3>
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

                <table id="jadwal-driver-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
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
                                    <a href="{{ route('driver.jadwal.edit', $item->id) }}" class="btn btn-warning btn-sm btn-block" {{ $item->status == 'selesai' || $item->status == 'dibatalkan' ? 'disabled' : '' }}>
                                        <i class="fas fa-edit"></i> Update Status
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center">Tidak ada jadwal untuk hari ini.</td></tr>
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
    $("#jadwal-driver-table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "order": [[ 0, "asc" ]] // Urutkan berdasarkan jam jemput
    });
});
</script>
@endpush


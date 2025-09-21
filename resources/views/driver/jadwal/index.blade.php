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
                            <th style="width: 25%;">Update Status</th>
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
                                    {{-- Form untuk update status --}}
                                    {{-- Anda perlu membuat route POST/PUT: driver.jadwal.updateStatus --}}
                                    <form action="#" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="input-group">
                                            <select name="status" class="form-control" {{ $item->status == 'selesai' || $item->status == 'dibatalkan' ? 'disabled' : '' }}>
                                                <option value="dijemput" {{ $item->status == 'dijemput' ? 'selected' : '' }}>Sudah Dijemput</option>
                                                <option value="perjalanan" {{ $item->status == 'perjalanan' ? 'selected' : '' }}>Dalam Perjalanan</option>
                                                <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                <option value="dibatalkan" {{ $item->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                            </select>
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-success" {{ $item->status == 'selesai' || $item->status == 'dibatalkan' ? 'disabled' : '' }}>Update</button>
                                            </div>
                                        </div>
                                    </form>
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

@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Jadwal Anak Saya')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Jadwal Antar Jemput Anak Anda</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <p class="mb-4 text-muted">Halaman ini menampilkan semua jadwal yang telah diatur. Anda dapat memantau status penjemputan anak Anda secara real-time di sini.</p>

                <table id="jadwal-parent-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Hari/Tanggal</th>
                            <th>Anak</th>
                            <th>Pengemudi</th>
                            <th>Jam Jemput</th>
                            <th>Jam Antar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Asumsi: Controller mengirimkan variabel $items yang berisi daftar jadwal --}}
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $item->hari }}, {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                <td>{{ $item->anak->nama ?? 'N/A' }}</td>
                                <td>{{ $item->driver->user->name ?? 'Belum Ditugaskan' }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->jam_jemput)->format('H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->jam_antar)->format('H:i') }}</td>
                                <td>
                                    @php
                                        $statusMap = [
                                            'menunggu' => ['class' => 'secondary', 'icon' => 'far fa-clock'],
                                            'dijemput' => ['class' => 'info', 'icon' => 'fas fa-child'],
                                            'perjalanan' => ['class' => 'primary', 'icon' => 'fas fa-route'],
                                            'selesai' => ['class' => 'success', 'icon' => 'fas fa-check-circle'],
                                            'dibatalkan' => ['class' => 'danger', 'icon' => 'fas fa-times-circle'],
                                        ];
                                        $statusInfo = $statusMap[$item->status] ?? ['class' => 'secondary', 'icon' => 'fas fa-question-circle'];
                                    @endphp
                                    <span class="badge bg-{{ $statusInfo['class'] }}"><i class="{{ $statusInfo['icon'] }} mr-1"></i> {{ ucfirst($item->status) }}</span>
                                </td>
                                <td>
                                    {{-- Halaman ini read-only, jadi hanya ada tombol detail --}}
                                    {{-- Pastikan Anda memiliki route 'parent.jadwal.show' --}}
                                    <a href="#" class="btn btn-info btn-sm btn-block" title="Lihat Detail">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center">Belum ada jadwal yang diatur untuk anak Anda.</td></tr>
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
    $("#jadwal-parent-table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "order": [[ 0, "desc" ]] // Urutkan berdasarkan tanggal terbaru
    });
});
</script>
@endpush


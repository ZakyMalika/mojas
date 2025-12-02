@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Riwayat Penghasilan Saya')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Semua Penghasilan yang Tercatat</h3>
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

                <table id="penghasilan-driver-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal Jadwal</th>
                            <th>Anak</th>
                            <th>Komisi Diterima</th>
                            <th>Status</th>
                            <th>Tanggal Dibayar</th>
                            <th style="width: 10%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>#{{ $item->id }}</td>
                                <td>{{ $item->jadwal->tanggal ? \Carbon\Carbon::parse($item->jadwal->tanggal)->format('d M Y') : 'N/A' }}</td>
                                <td>{{ $item->jadwal->anak->nama ?? 'N/A' }}</td>
                                <td><strong>Rp{{ number_format($item->komisi_pengemudi, 0, ',', '.') }}</strong></td>
                                <td>
                                    @php
                                        $statusClass = ($item->status == 'pending') ? 'warning' : 'success';
                                    @endphp
                                    <span class="badge bg-{{ $statusClass }}">{{ ucfirst($item->status) }}</span>
                                </td>
                                <td>{{ $item->tanggal_dibayar ? \Carbon\Carbon::parse($item->tanggal_dibayar)->format('d M Y') : 'Tanggal Belum dipilih' }}</td>
                                <td>
                                    <a href="{{ route('driver.penghasilan.show', $item->id) }}" class="btn btn-info btn-sm btn-block" title="Lihat Detail">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center">Belum ada riwayat penghasilan.</td></tr>
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
    $("#penghasilan-driver-table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "order": [[ 0, "desc" ]] // Urutkan berdasarkan ID terbaru
    });
});
</script>
@endpush


@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Riwayat Pembayaran')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Semua Transaksi Pembayaran</h3>
                <div class="card-tools">
                    <a href="{{ route('parent.pembayaran.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Lakukan Pembayaran Baru
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

                <table id="parent-pembayaran-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Anak</th>
                            <th>Jumlah Bayar</th>
                            <th>Metode</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th style="width: 10%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>#{{ $item->id }}</td>
                                <td>{{ $item->pendaftaran_anak->anak->nama ?? 'Data Anak Dihapus' }}</td>
                                <td><strong>Rp{{ number_format($item->jumlah_bayar, 0, ',', '.') }}</strong></td>
                                <td>{{ ucfirst($item->metode_pembayaran) }}</td>
                                <td>{{ $item->tanggal_bayar ? \Carbon\Carbon::parse($item->tanggal_bayar)->format('d M Y') : '-' }}</td>
                                <td>
                                    @php
                                        $statusMap = ['pending' => 'warning', 'sukses' => 'success', 'gagal' => 'danger'];
                                    @endphp
                                    <span class="badge bg-{{ $statusMap[$item->status] ?? 'secondary' }}">{{ ucfirst($item->status) }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('parent.pembayaran.show', $item->id) }}" class="btn btn-info btn-sm btn-block" title="Lihat Detail">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center">Anda belum memiliki riwayat pembayaran.</td></tr>
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
    $("#parent-pembayaran-table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "order": [[ 0, "desc" ]]
    });
});
</script>
@endpush

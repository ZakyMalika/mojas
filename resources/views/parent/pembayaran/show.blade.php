@extends('layouts.app')

@section('content-title', 'Detail Pembayaran')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Detail Transaksi #{{ $item->id }}</h3>
                <div class="card-tools">
                     <a href="{{ route('parent.pembayaran.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali ke Riwayat</a>
                     {{-- Tombol edit hanya muncul jika status masih 'pending' --}}
                     @if($item->status == 'pending')
                        <a href="{{ route('parent.pembayaran.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                     @endif
                </div>
            </div>
            <div class="card-body">
                <h4>Informasi Pembayaran</h4>
                <dl class="row">
                    <dt class="col-sm-4">Status</dt>
                    <dd class="col-sm-8">
                        @php
                            $statusMap = ['pending' => 'warning', 'sukses' => 'success', 'gagal' => 'danger'];
                        @endphp
                        <span class="badge bg-{{ $statusMap[$item->status] ?? 'secondary' }}">{{ ucfirst($item->status) }}</span>
                    </dd>

                    <dt class="col-sm-4">Jumlah Pembayaran</dt>
                    <dd class="col-sm-8"><strong>Rp{{ number_format($item->jumlah_bayar, 0, ',', '.') }}</strong></dd>

                    <dt class="col-sm-4">Metode Pembayaran</dt>
                    <dd class="col-sm-8">{{ ucfirst($item->metode_pembayaran) }}</dd>

                    <dt class="col-sm-4">Tanggal Pembayaran</dt>
                    <dd class="col-sm-8">{{ $item->tanggal_bayar ? \Carbon\Carbon::parse($item->tanggal_bayar)->format('d F Y') : '-' }}</dd>
                </dl>
                <hr>
                <h4>Detail Pendaftaran</h4>
                 <dl class="row">
                    <dt class="col-sm-4">ID Pendaftaran</dt>
                    <dd class="col-sm-8">#{{ $item->pendaftaran_anak_id }}</dd>

                    <dt class="col-sm-4">Nama Anak</dt>
                    <dd class="col-sm-8">{{ $item->pendaftaran_anak->anak->nama ?? 'Data Anak Dihapus' }}</dd>
                    
                    <dt class="col-sm-4">Periode Layanan</dt>
                    <dd class="col-sm-8">
                        {{ $item->pendaftaran_anak ? \Carbon\Carbon::parse($item->pendaftaran_anak->periode_mulai)->format('d M Y') : 'N/A' }}
                        s/d
                        {{ $item->pendaftaran_anak ? \Carbon\Carbon::parse($item->pendaftaran_anak->periode_selesai)->format('d M Y') : 'N/A' }}
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection

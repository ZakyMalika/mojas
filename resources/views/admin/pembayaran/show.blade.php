@extends('layouts.app')

@section('content-title', 'Detail Pembayaran')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Detail untuk Pembayaran ID: <strong>#{{ $item->id }}</strong></h3>
                <div class="card-tools">
                     <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                     <a href="{{ route('admin.pembayaran.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                </div>
            </div>
            <div class="card-body">
                <h4>Detail Transaksi</h4>
                <dl class="row">
                    <dt class="col-sm-4">Status</dt>
                    <dd class="col-sm-8">
                        @php
                            $statusClass = 'secondary';
                            if ($item->status == 'pending') $statusClass = 'warning';
                            elseif ($item->status == 'sukses') $statusClass = 'success';
                            elseif ($item->status == 'gagal') $statusClass = 'danger';
                        @endphp
                        <span class="badge bg-{{ $statusClass }}">{{ ucfirst($item->status) }}</span>
                    </dd>

                    <dt class="col-sm-4">Jumlah Pembayaran</dt>
                    <dd class="col-sm-8"><strong>Rp{{ number_format($item->jumlah_bayar, 0, ',', '.') }}</strong></dd>
                    
                    <dt class="col-sm-4">Metode</dt>
                    <dd class="col-sm-8">{{ ucfirst($item->metode_pembayaran) }}</dd>
                    
                    <dt class="col-sm-4">Tanggal Pembayaran</dt>
                    <dd class="col-sm-8">{{ $item->tanggal_bayar ? \Carbon\Carbon::parse($item->tanggal_bayar)->format('d F Y') : '-' }}</dd>
                </dl>
                <hr>
                <h4>Informasi Pihak Terkait</h4>
                <dl class="row">
                     <dt class="col-sm-4">ID Pendaftaran</dt>
                    <dd class="col-sm-8">
                        <a href="{{-- route('admin.pendaftaran-anak.show', $item->pendaftaran_anak_id) --}}">#{{ $item->pendaftaran_anak_id }}</a>
                    </dd>
                    <dt class="col-sm-4">Anak</dt>
                    <dd class="col-sm-8">{{ $item->pendaftaran_anak->anak->nama ?? 'N/A' }}</dd>
                    <dt class="col-sm-4">Orang Tua</dt>
                    <dd class="col-sm-8">{{ $item->orang_tua->user->name ?? 'N/A' }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection

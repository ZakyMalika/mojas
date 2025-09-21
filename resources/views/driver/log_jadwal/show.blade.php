@extends('layouts.app')

@section('content-title', 'Detail Log Perjalanan')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Detail Log ID: <strong>#{{ $item->id }}</strong></h3>
                <div class="card-tools">
                     <a href="{{ route('driver.log-jadwal.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali ke Riwayat</a>
                </div>
            </div>
            <div class="card-body">
                <h4>Detail Perubahan Status</h4>
                <dl class="row">
                    <dt class="col-sm-4">Waktu Kejadian</dt>
                    <dd class="col-sm-8">{{ $item->created_at->format('d F Y, H:i:s') }}</dd>

                    <dt class="col-sm-4">Status Lama</dt>
                    <dd class="col-sm-8"><span class="badge bg-secondary">{{ ucfirst($item->status_lama) }}</span></dd>
                    
                    <dt class="col-sm-4">Status Baru</dt>
                    <dd class="col-sm-8"><span class="badge bg-info">{{ ucfirst($item->status_baru) }}</span></dd>

                    <dt class="col-sm-4">Keterangan</dt>
                    <dd class="col-sm-8">{{ $item->keterangan ?? 'Tidak ada keterangan.' }}</dd>
                </dl>
                <hr>
                <h4>Informasi Jadwal Terkait</h4>
                <dl class="row">
                     <dt class="col-sm-4">ID Jadwal</dt>
                    <dd class="col-sm-8">#{{ $item->jadwal_id }}</dd>
                    
                    <dt class="col-sm-4">Tanggal</dt>
                    <dd class="col-sm-8">{{ $item->jadwal->tanggal ? \Carbon\Carbon::parse($item->jadwal->tanggal)->format('d F Y') : 'N/A' }}</dd>

                    <dt class="col-sm-4">Anak</dt>
                    <dd class="col-sm-8">{{ $item->jadwal->anak->nama ?? 'N/A' }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection

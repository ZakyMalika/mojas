@extends('layouts.app')

@section('content-title', 'Detail Jadwal Antar Jemput')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Detail Jadwal untuk: <strong>{{ $item->anak->nama ?? 'N/A' }}</strong></h3>
                <div class="card-tools">
                     <a href="{{ route('driver.jadwal.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali ke Daftar Jadwal</a>
                </div>
            </div>
            <div class="card-body">
                <h4>Informasi Jadwal</h4>
                <dl class="row">
                    <dt class="col-sm-4">Status Saat Ini</dt>
                    <dd class="col-sm-8">
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
                    </dd>

                    <dt class="col-sm-4">Tanggal</dt>
                    <dd class="col-sm-8">{{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d F Y') : 'N/A' }} ({{ $item->hari }})</dd>
                    
                    <dt class="col-sm-4">Jam Jemput</dt>
                    <dd class="col-sm-8">{{ $item->jam_jemput ? \Carbon\Carbon::parse($item->jam_jemput)->format('H:i') : 'N/A' }}</dd>
                    
                    <dt class="col-sm-4">Jam Antar</dt>
                    <dd class="col-sm-8">{{ $item->jam_antar ? \Carbon\Carbon::parse($item->jam_antar)->format('H:i') : 'N/A' }}</dd>
                </dl>
                <hr>
                <h4>Informasi Lokasi & Anak</h4>
                <dl class="row">
                     <dt class="col-sm-4">Nama Anak</dt>
                    <dd class="col-sm-8">{{ $item->anak->nama ?? 'N/A' }}</dd>
                    
                    <dt class="col-sm-4">Lokasi Penjemputan</dt>
                    <dd class="col-sm-8">{{ $item->lokasi_jemput ?? $item->anak->sekolah ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Lokasi Pengantaran</dt>
                    <dd class="col-sm-8">{{ $item->lokasi_antar ?? $item->anak->alamat_penjemputan ?? 'N/A' }}</dd>
                    
                    <dt class="col-sm-4">Catatan</dt>
                    <dd class="col-sm-8">{{ $item->catatan ?? 'Tidak ada catatan.' }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection

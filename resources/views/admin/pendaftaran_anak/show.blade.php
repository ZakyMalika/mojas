@extends('layouts.app')

@section('content-title', 'Detail Pendaftaran Anak')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Detail Pendaftaran untuk: <strong>{{ $item->anak->nama ?? 'N/A' }}</strong></h3>
                <div class="card-tools">
                     <a href="{{ route('admin.pendaftaran-anak.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                     <a href="{{ route('admin.pendaftaran-anak.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                </div>
            </div>
            <div class="card-body">
                <h4>Detail Layanan</h4>
                <dl class="row">
                    <dt class="col-sm-4">Status Pendaftaran</dt>
                    <dd class="col-sm-8">
                        @php
                            $statusClass = 'secondary';
                            if ($item->status == 'pending') $statusClass = 'warning';
                            elseif ($item->status == 'lunas') $statusClass = 'success';
                            elseif ($item->status == 'expired') $statusClass = 'danger';
                        @endphp
                        <span class="badge bg-{{ $statusClass }}">{{ ucfirst($item->status) }}</span>
                    </dd>

                    <dt class="col-sm-4">Tarif Bulanan</dt>
                    <dd class="col-sm-8"><strong>Rp{{ number_format($item->tarif_bulanan, 0, ',', '.') }}</strong></dd>
                    
                    <dt class="col-sm-4">Tipe Layanan</dt>
                    <dd class="col-sm-8">{{ $item->tipe_layanan == 'one_way' ? 'Sekali Jalan (One Way)' : 'Pulang Pergi (Two Way)' }}</dd>
                    
                    <dt class="col-sm-4">Periode Aktif</dt>
                    <dd class="col-sm-8">{{ \Carbon\Carbon::parse($item->periode_mulai)->format('d M Y') }} s/d {{ $item->periode_selesai ? \Carbon\Carbon::parse($item->periode_selesai)->format('d M Y') : 'berlanjut' }}</dd>
                </dl>
                <hr>
                <h4>Informasi Pihak & Jarak</h4>
                <dl class="row">
                    <dt class="col-sm-4">Nama Anak</dt>
                    <dd class="col-sm-8">{{ $item->anak->nama ?? 'N/A' }}</dd>
                    <dt class="col-sm-4">Orang Tua</dt>
                    <dd class="col-sm-8">{{ $item->anak->orangTua->user->name ?? 'N/A' }}</dd>
                     <dt class="col-sm-4">Jarak Rumah-Sekolah</dt>
                    <dd class="col-sm-8">{{ $item->jarak_km }} KM</dd>
                    <dt class="col-sm-4">Referensi Tarif</dt>
                    <dd class="col-sm-8">
                        Tarif untuk {{ $item->tarif_jarak->min_distance_km ?? 'N/A' }} - {{ $item->tarif_jarak->max_distance_km ?? 'N/A' }} KM
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection

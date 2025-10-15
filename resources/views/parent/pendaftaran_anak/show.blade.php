@extends('layouts.app')

@section('content-title', 'Detail Pendaftaran Layanan')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Detail Pendaftaran #{{ $item->id }}</h3>
                <div class="card-tools">
                     <a href="{{ route('parent.pendaftaran-anak.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                     @if($item->status == 'pending')
                        <a href="{{ route('parent.pendaftaran-anak.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                     @endif
                </div>
            </div>
            <div class="card-body">
                <h4>Informasi Pendaftaran</h4>
                <dl class="row">
                    <dt class="col-sm-4">Status Pendaftaran</dt>
                    <dd class="col-sm-8">
                         @php
                            $statusMap = ['pending' => 'warning', 'lunas' => 'success', 'expired' => 'danger'];
                        @endphp
                        <span class="badge bg-{{ $statusMap[$item->status] ?? 'secondary' }}">{{ ucfirst($item->status) }}</span>
                    </dd>

                    <dt class="col-sm-4">Nama Anak</dt>
                    <dd class="col-sm-8">{{ $item->anak->nama ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Periode Layanan</dt>
                    <dd class="col-sm-8">
                        {{ $item->periode_mulai ? \Carbon\Carbon::parse($item->periode_mulai)->format('d M Y') : 'N/A' }}
                        s/d
                        {{ $item->periode_selesai ? \Carbon\Carbon::parse($item->periode_selesai)->format('d M Y') : 'Belum ditentukan' }}
                    </dd>
                </dl>
                <hr>
                <h4>Detail Tarif & Layanan</h4>
                 <dl class="row">
                    <dt class="col-sm-4">Jarak Tempuh</dt>
                    <dd class="col-sm-8">{{ $item->tarif_jarak->min_distance_km }} - {{ $item->tarif_jarak->max_distance_km }} KM</dd>
                    
                    <dt class="col-sm-4">Tipe Layanan</dt>
                    <dd class="col-sm-8">{{ $item->tipe_layanan == 'one_way' ? 'One Way (Sekali Jalan)' : 'Two Way (Pulang Pergi)' }}</dd>

                    <dt class="col-sm-4">Tarif Bulanan</dt>
                    <dd class="col-sm-8"><strong>Rp{{ number_format($item->tarif_bulanan, 0, ',', '.') }}</strong></dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection

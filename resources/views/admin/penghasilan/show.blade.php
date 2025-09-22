@extends('layouts.app')

@section('content-title', 'Detail Penghasilan Pengemudi')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Detail Penghasilan ID: <strong>#{{ $item->id }}</strong></h3>
                <div class="card-tools">
                     <a href="{{ route('admin.penghasilan.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                     <a href="{{ $editUrl }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                </div>
            </div>
            <div class="card-body">
                <h4>Detail Keuangan</h4>
                <dl class="row">
                    <dt class="col-sm-4">Status Pembayaran</dt>
                    <dd class="col-sm-8">
                         @php
                            $statusClass = ($item->status == 'pending') ? 'warning' : 'success';
                        @endphp
                        <span class="badge bg-{{ $statusClass }}">{{ ucfirst($item->status) }}</span>
                    </dd>

                    <dt class="col-sm-4">Tarif per Trip</dt>
                    <dd class="col-sm-8"><strong>Rp{{ number_format($item->tarif_per_trip, 0, ',', '.') }}</strong></dd>

                    <dt class="col-sm-4">Komisi Pengemudi</dt>
                    <dd class="col-sm-8"><strong>Rp{{ number_format($item->komisi_pengemudi, 0, ',', '.') }}</strong></dd>
                    
                    <dt class="col-sm-4">Tanggal Dibayar</dt>
                    <dd class="col-sm-8">{{ $item->tanggal_dibayar ? \Carbon\Carbon::parse($item->tanggal_dibayar)->format('d F Y') : 'Belum dibayar' }}</dd>
                </dl>
                <hr>
                <h4>Informasi Terkait</h4>
                <dl class="row">
                     <dt class="col-sm-4">ID Jadwal</dt>
                    <dd class="col-sm-8">
                        @if($item->jadwal_id)
                            <a href="{{ url("admin/jadwal/{$item->jadwal_id}") }}">#{{ $item->jadwal_id }}</a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </dd>
                    <dt class="col-sm-4">Anak</dt>
                    <dd class="col-sm-8">{{ $item->jadwal?->anak?->nama ?? 'N/A' }}</dd>
                     <dt class="col-sm-4">Nama Pengemudi</dt>
                    <dd class="col-sm-8">{{ $item->driver->user->name ?? 'N/A' }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection

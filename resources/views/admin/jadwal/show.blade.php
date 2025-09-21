@extends('layouts.app')

@section('content-title', 'Detail Jadwal Antar Jemput')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Jadwal untuk: <strong>{{ $item->anak->nama ?? 'N/A' }}</strong></h3>
                <div class="card-tools">
                     <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <a href="{{ route('admin.jadwal.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                </div>
            </div>
            <div class="card-body">
                <h4>Detail Jadwal</h4>
                <dl class="row">
                    <dt class="col-sm-4">Status</dt>
                    <dd class="col-sm-8">
                         @php
                            $statusClass = 'secondary';
                            if ($item->status == 'menunggu') $statusClass = 'warning';
                            elseif ($item->status == 'dijemput' || $item->status == 'perjalanan') $statusClass = 'info';
                            elseif ($item->status == 'selesai') $statusClass = 'success';
                            elseif ($item->status == 'dibatalkan') $statusClass = 'danger';
                        @endphp
                        <span class="badge bg-{{ $statusClass }}">{{ ucfirst($item->status) }}</span>
                    </dd>
                    <dt class="col-sm-4">Hari & Tanggal</dt>
                    <dd class="col-sm-8">{{ $item->hari ?? '' }}, {{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</dd>
                    <dt class="col-sm-4">Jam Jemput</dt>
                    <dd class="col-sm-8">{{ \Carbon\Carbon::parse($item->jam_jemput)->format('H:i') }} WIB</dd>
                    <dt class="col-sm-4">Jam Antar</dt>
                    <dd class="col-sm-8">{{ \Carbon\Carbon::parse($item->jam_antar)->format('H:i') }} WIB</dd>
                </dl>

                <hr>
                <h4>Informasi Pihak Terkait</h4>
                <dl class="row">
                    <dt class="col-sm-4">Nama Anak</dt>
                    <dd class="col-sm-8">{{ $item->anak->nama ?? 'N/A' }}</dd>
                    <dt class="col-sm-4">Orang Tua</dt>
                    <dd class="col-sm-8">{{ $item->anak->orangTua->user->name ?? 'N/A' }}</dd>
                    <dt class="col-sm-4">Pengemudi</dt>
                    <dd class="col-sm-8">{{ $item->driver->user->name ?? 'N/A' }}</dd>
                     <dt class="col-sm-4">Nomor Plat</dt>
                    <dd class="col-sm-8">{{ $item->driver->nomor_plat ?? 'N/A' }}</dd>
                </dl>
                 <hr>
                <h4>Informasi Lokasi</h4>
                <dl class="row">
                     <dt class="col-sm-4">Lokasi Jemput</dt>
                    <dd class="col-sm-8">{{ $item->lokasi_jemput ?? $item->anak->alamat_penjemputan ?? 'Tidak ditentukan' }}</dd>
                    <dt class="col-sm-4">Lokasi Antar</dt>
                    <dd class="col-sm-8">{{ $item->lokasi_antar ?? $item->anak->sekolah ?? 'Tidak ditentukan' }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection

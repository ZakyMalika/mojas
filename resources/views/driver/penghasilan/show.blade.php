@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Detail Penghasilan #' . $item->id)

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-file-invoice-dollar mr-1"></i>
                    Rincian Penghasilan
                </h3>
            </div>
            <div class="card-body">
                {{-- Bagian 1: Ringkasan Penghasilan --}}
                <h4><strong>Ringkasan Penghasilan</strong></h4>
                <dl class="row">
                    <dt class="col-sm-3">ID Transaksi</dt>
                    <dd class="col-sm-9">#{{ $item->id }}</dd>

                    <dt class="col-sm-3">Komisi Diterima</dt>
                    <dd class="col-sm-9">
                        <span class="text-success font-weight-bold" style="font-size: 1.2rem;">
                            Rp{{ number_format($item->komisi_pengemudi, 0, ',', '.') }}
                        </span>
                    </dd>

                    <dt class="col-sm-3">Status Pembayaran</dt>
                    <dd class="col-sm-9">
                        @php
                            $statusClass = ($item->status == 'pending') ? 'warning' : 'success';
                            $statusIcon = ($item->status == 'pending') ? 'fas fa-hourglass-half' : 'fas fa-check-circle';
                        @endphp
                        <span class="badge bg-{{ $statusClass }} p-2" style="font-size: 0.9rem;">
                            <i class="{{ $statusIcon }} mr-1"></i> {{ ucfirst($item->status) }}
                        </span>
                    </dd>

                    <dt class="col-sm-3">Tanggal Dibayar</dt>
                    <dd class="col-sm-9">{{ $item->tanggal_dibayar ? \Carbon\Carbon::parse($item->tanggal_dibayar)->translatedFormat('d F Y, H:i') . ' WIB' : 'Menunggu pembayaran dari admin' }}</dd>
                </dl>

                <hr>

                {{-- Bagian 2: Detail Jadwal Terkait --}}
                <h4 class="mt-4"><strong>Informasi Jadwal Terkait</strong></h4>
                @if($item->jadwal)
                    <dl class="row">
                        <dt class="col-sm-3">ID Jadwal</dt>
                        <dd class="col-sm-9">#{{ $item->jadwal->id }}</dd>

                        <dt class="col-sm-3">Tanggal Layanan</dt>
                        <dd class="col-sm-9">{{ \Carbon\Carbon::parse($item->jadwal->tanggal)->translatedFormat('l, d F Y') }}</dd>

                        <dt class="col-sm-3">Nama Anak</dt>
                        <dd class="col-sm-9">{{ $item->jadwal->anak->nama ?? 'N/A' }}</dd>

                        <dt class="col-sm-3">Orang Tua</dt>
                        <dd class="col-sm-9">{{ $item->jadwal->anak->orangTua->user->name ?? 'N/A' }}</dd>

                        <dt class="col-sm-3">Jadwal Jemput</dt>
                        <dd class="col-sm-9">{{ \Carbon\Carbon::parse($item->jadwal->jam_jemput)->format('H:i') }} WIB</dd>

                        <dt class="col-sm-3">Jadwal Antar</dt>
                        <dd class="col-sm-9">{{ \Carbon\Carbon::parse($item->jadwal->jam_antar)->format('H:i') }} WIB</dd>
                    </dl>
                @else
                    <p class="text-muted">Data jadwal terkait tidak ditemukan atau telah dihapus.</p>
                @endif

            </div>
            <div class="card-footer">
                <a href="{{ route('driver.penghasilan.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Riwayat
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Script khusus untuk halaman ini jika diperlukan --}}
<script>
    // console.log("Halaman detail penghasilan dimuat untuk ID: {{ $item->id }}");
</script>
@endpush

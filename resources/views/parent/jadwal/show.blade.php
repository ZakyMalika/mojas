@extends('layouts.app')

{{-- Judul untuk header konten, dibuat dinamis --}}
@section('content-title', 'Detail Jadwal: ' . ($jadwal->anak->nama ?? 'N/A'))

@section('content')
<div class="row">
    {{-- Kolom Kiri: Informasi Detail --}}
    <div class="col-lg-7">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle mr-1"></i>
                    Informasi Lengkap
                </h3>
            </div>
            <div class="card-body">
                {{-- Menggunakan description list untuk tampilan yang rapi --}}
                <dl class="row">
                    <dt class="col-sm-4">Hari, Tanggal</dt>
                    <dd class="col-sm-8">{{ $jadwal->hari }}, {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') }}</dd>

                    <dt class="col-sm-4">Nama Anak</dt>
                    <dd class="col-sm-8">{{ $jadwal->anak->nama ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Status Saat Ini</dt>
                    <dd class="col-sm-8">
                        @php
                            $statusMap = [
                                'menunggu' => ['class' => 'secondary', 'icon' => 'far fa-clock'],
                                'dijemput' => ['class' => 'info', 'icon' => 'fas fa-child'],
                                'perjalanan' => ['class' => 'primary', 'icon' => 'fas fa-route'],
                                'selesai' => ['class' => 'success', 'icon' => 'fas fa-check-circle'],
                                'dibatalkan' => ['class' => 'danger', 'icon' => 'fas fa-times-circle'],
                            ];
                            $statusInfo = $statusMap[$jadwal->status] ?? ['class' => 'secondary', 'icon' => 'fas fa-question-circle'];
                        @endphp
                        <span class="badge bg-{{ $statusInfo['class'] }} p-2" style="font-size: 0.9rem;">
                            <i class="{{ $statusInfo['icon'] }} mr-1"></i> {{ ucfirst($jadwal->status) }}
                        </span>
                    </dd>

                    <dt class="col-sm-4">Waktu Jemput</dt>
                    <dd class="col-sm-8">{{ \Carbon\Carbon::parse($jadwal->jam_jemput)->format('H:i') }} WIB</dd>

                    <dt class="col-sm-4">Waktu Antar</dt>
                    <dd class="col-sm-8">{{ \Carbon\Carbon::parse($jadwal->jam_antar)->format('H:i') }} WIB</dd>

                    {{-- Asumsi: Relasi anak memiliki alamat jemput & antar --}}
                    <dt class="col-sm-4">Lokasi Jemput</dt>
                    <dd class="col-sm-8">{{ $jadwal->anak->alamat_penjemputan ?? 'Alamat belum diatur.' }}</dd>

                    <dt class="col-sm-4">Lokasi Antar</dt>
                    <dd class="col-sm-8">{{ $jadwal->anak->sekolah ?? 'Alamat belum diatur.' }}</dd>
                </dl>

                <hr>

                <h5><strong><i class="fas fa-user-shield mr-1"></i> Informasi Pengemudi</strong></h5>
                <dl class="row mt-3">
                    <dt class="col-sm-4">Nama Pengemudi</dt>
                    <dd class="col-sm-8">{{ $jadwal->driver->user->name ?? 'Belum Ditugaskan' }}</dd>

                    {{-- Asumsi: Relasi user pada driver memiliki nomor_telepon --}}
                </dl>

                <h5><strong><i class="fas fa-car mr-1"></i> Informasi Kendaraan</strong></h5>
                <dl class="row mt-3">
                    {{-- Asumsi: Relasi driver memiliki properti mobil & plat_nomor --}}
                    <dt class="col-sm-4">Kendaraan</dt>
                    <dd class="col-sm-8">{{ $jadwal->driver->jenis_kendaraan ?? '-' }}</dd>

                    <dt class="col-sm-4">Warna Kendaraan</dt>
                    <dd class="col-sm-8">{{ $jadwal->driver->warna_kendaraan ?? '-' }}</dd>

                    <dt class="col-sm-4">Plat Nomor</dt>
                    <dd class="col-sm-8">{{ $jadwal->driver->nomor_plat ?? '-' }}</dd>
                </dl>
            </div>
            <div class="card-footer">
                <a href="{{ route('parent.jadwal.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                </a>
                
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Tambahkan script khusus untuk halaman ini jika diperlukan --}}
{{-- Contoh: Inisialisasi peta (Google Maps/Leaflet) --}}
<script>
    // Kode JavaScript untuk inisialisasi peta akan diletakkan di sini.
    // console.log("Halaman detail jadwal dimuat untuk jadwal ID: {{ $jadwal->id }}");
</script>
@endpush

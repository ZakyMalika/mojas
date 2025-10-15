@extends('layouts.app')

@section('content-title', 'Detail Data Pengemudi')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Informasi Lengkap: <strong>{{ $item->user->name ?? 'N/A' }}</strong></h3>
                <div class="card-tools">
                     <a href="{{ route('admin.drivers.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <h4>Data Personal</h4>
                <dl class="row">
                    <dt class="col-sm-4">Email</dt>
                    <dd class="col-sm-8">{{ $item->user->email ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">No. Telepon</dt>
                    <dd class="col-sm-8">{{ $item->user->no_telp ?? 'N/A' }}</dd>
                </dl>

                <hr>
                <h4>Data Kendaraan</h4>
                <dl class="row">
                    <dt class="col-sm-4">Nomor Plat</dt>
                    <dd class="col-sm-8"><span class="badge bg-dark">{{ $item->nomor_plat ?? '-' }}</span></dd>

                    <dt class="col-sm-4">Jenis Kendaraan</dt>
                    <dd class="col-sm-8">{{ $item->jenis_kendaraan ?? '-' }}</dd>

                    <dt class="col-sm-4">Warna Kendaraan</dt>
                    <dd class="col-sm-8">{{ $item->warna_kendaraan ?? '-' }}</dd>
                </dl>

                <hr>
                <h4>Informasi Lain</h4>
                <dl class="row">
                    <dt class="col-sm-4">Jadwal Aktif</dt>
                    <dd class="col-sm-8">
                        @if($item->jadwal_antar_jemput && $item->jadwal_antar_jemput->count() > 0)
                            <span class="badge bg-success">{{ $item->jadwal_antar_jemput->count() }} Jadwal Ditemukan</span>
                        @else
                            <span class="badge bg-warning">Belum ada jadwal.</span>
                        @endif
                    </dd>

                     {{-- <dt class="col-sm-4">Total Penghasilan</dt> --}}
                    {{-- <dd class="col-sm-8"> --}}
                         {{-- @if($item->penghasilan_driver && $item->penghasilan_driver->count() > 0) --}}
                            {{-- Asumsi Anda ingin menjumlahkan semua penghasilan --}}
                            {{-- Rp{{ number_format($item->penghasilan_driver->sum('jumlah'), 0, ',', '.') }} --}}
                        {{-- @else --}}
                           {{-- Rp0 --}}
                        {{-- @endif --}}
                    {{-- </dd> --}}
                </dl>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

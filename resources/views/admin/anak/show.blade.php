@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Detail Data Anak')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Informasi Lengkap: <strong>{{ $item->nama }}</strong></h3>
                <div class="card-tools">
                     <a href="{{ route('admin.anak.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                    </a>
                    <a href="{{ route('admin.anak.edit', $item->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit Data
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Nama Orang Tua</dt>
                    {{-- Menggunakan relasi untuk menampilkan nama orang tua --}}
                    <dd class="col-sm-8">{{ $item->orangTua->name ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Umur</dt>
                    <dd class="col-sm-8">{{ $item->umur ? $item->umur . ' tahun' : '-' }}</dd>

                    <dt class="col-sm-4">Jenis Kelamin</dt>
                    <dd class="col-sm-8">{{ $item->jenis_kelamin ?? '-' }}</dd>

                    <dt class="col-sm-4">Sekolah</dt>
                    <dd class="col-sm-8">{{ $item->sekolah ?? '-' }}</dd>

                    <dt class="col-sm-4">Kelas</dt>
                    <dd class="col-sm-8">{{ $item->kelas ?? '-' }}</dd>

                    <dt class="col-sm-4">Alamat Penjemputan</dt>
                    <dd class="col-sm-8">{{ $item->alamat_penjemputan ?? '-' }}</dd>

                    <dt class="col-sm-4">Catatan Tambahan</dt>
                    <dd class="col-sm-8">{{ $item->catatan ?? 'Tidak ada catatan.' }}</dd>

                    <dt class="col-sm-4 border-top pt-3 mt-3">Jadwal Antar Jemput</dt>
                    <dd class="col-sm-8 border-top pt-3 mt-3">
                        @if($item->jadwal_antar_jemput && $item->jadwal_antar_jemput->count() > 0)
                            <ul class="list-unstyled">
                            @foreach($item->jadwal_antar_jemput as $jadwal)
                                <li>
                                    <strong>{{ $jadwal->hari }}:</strong> Jemput pukul <strong>{{ $jadwal->jam_jemput }}</strong>, Antar pukul <strong>{{ $jadwal->jam_antar }}</strong>
                                </li>
                            @endforeach
                            </ul>
                        @else
                            Jadwal belum diatur.
                        @endif
                    </dd>
                </dl>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection


@extends('layouts.app')

@section('content-title', 'Detail Data Anak')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Informasi Lengkap: <strong>{{ $item->nama }}</strong></h3>
                <div class="card-tools">
                     <a href="{{ route('parent.anak.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <a href="{{ route('parent.anak.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                </div>
            </div>
            <div class="card-body">
                <h4>Data Diri Anak</h4>
                <dl class="row">
                    <dt class="col-sm-4">Nama Lengkap</dt>
                    <dd class="col-sm-8">{{ $item->nama }}</dd>

                    <dt class="col-sm-4">Umur</dt>
                    <dd class="col-sm-8">{{ $item->umur ? $item->umur . ' tahun' : '-' }}</dd>

                    <dt class="col-sm-4">Jenis Kelamin</dt>
                    <dd class="col-sm-8">{{ $item->jenis_kelamin ?? '-' }}</dd>

                    <dt class="col-sm-4">Sekolah</dt>
                    <dd class="col-sm-8">{{ $item->sekolah ?? '-' }}</dd>

                    <dt class="col-sm-4">Kelas</dt>
                    <dd class="col-sm-8">{{ $item->kelas ?? '-' }}</dd>
                </dl>
                <hr>
                <h4>Informasi Antar Jemput</h4>
                 <dl class="row">
                    <dt class="col-sm-4">Alamat Rumah</dt>
                    <dd class="col-sm-8">{{ $item->alamat_penjemputan ?? '-' }}</dd>
                    
                    <dt class="col-sm-4">Status Pendaftaran Layanan</dt>
                    <dd class="col-sm-8">
                        @if($item->pendaftaran_anak->first())
                             @php
                                $status = $item->pendaftaran_anak->first()->status;
                                $statusMap = ['pending' => 'warning', 'lunas' => 'success', 'expired' => 'danger'];
                            @endphp
                            <span class="badge bg-{{ $statusMap[$status] ?? 'secondary' }}">{{ ucfirst($status) }}</span>
                        @else
                            <span class="badge bg-secondary">Belum Terdaftar</span>
                        @endif
                    </dd>

                    <dt class="col-sm-4">Catatan</dt>
                    <dd class="col-sm-8">{{ $item->catatan ?? 'Tidak ada catatan.' }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection

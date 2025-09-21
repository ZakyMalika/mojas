@extends('layouts.app')

@section('content-title', 'Detail Data Orang Tua')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Informasi Lengkap: <strong>{{ $items->user->name ?? 'N/A' }}</strong></h3>
                <div class="card-tools">
                     <a href="{{ route('admin.orang_tua.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('admin.orang_tua.edit', $items) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Email</dt>
                    <dd class="col-sm-8">{{ $item->user->email ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">No. Telepon</dt>
                    <dd class="col-sm-8">{{ $item->user->no_telp ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Alamat</dt>
                    <dd class="col-sm-8">{{ $item->alamat ?? '-' }}</dd>

                    <dt class="col-sm-4">Catatan</dt>
                    <dd class="col-sm-8">{{ $item->catatan ?? 'Tidak ada catatan.' }}</dd>

                    <dt class="col-sm-4 border-top pt-3 mt-3">Anak Terdaftar</dt>
                    <dd class="col-sm-8 border-top pt-3 mt-3">
                        @if($items->anak && $items->count() > 0)
                            <ul class="list-unstyled">
                            @foreach($items->anak as $anak)
                                <li><i class="fas fa-child text-info mr-2"></i> {{ $anak->nama }} ({{ $anak->umur }} tahun)</li>
                            @endforeach
                            </ul>
                        @else
                            Belum ada anak yang terdaftar.
                        @endif
                    </dd>

                    <dt class="col-sm-4 border-top pt-3 mt-3">Riwayat Pembayaran</dt>
                    <dd class="col-sm-8 border-top pt-3 mt-3">
                         @if($items->pembayaran && $items->pembayaran->count() > 0)
                            <ul class="list-unstyled">
                            @foreach($items->pembayaran as $bayar)
                                <li><i class="fas fa-check-circle text-success mr-2"></i> {{ $bayar->deskripsi }} - Rp{{ number_format($bayar->jumlah, 0, ',', '.') }}</li>
                            @endforeach
                            </ul>
                        @else
                            Belum ada riwayat pembayaran.
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

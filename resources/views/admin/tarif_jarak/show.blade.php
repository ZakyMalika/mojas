@extends('layouts.app')

@section('content-title', 'Detail Tarif Jarak')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Detail Tarif ID: <strong>#{{ $item->id }}</strong></h3>
                <div class="card-tools">
                     <a href="{{ route('admin.tarif-jarak.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                     <a href="{{ route('admin.tarif-jarak.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                </div>
            </div>
            <div class="card-body">
                <h4>Detail Tarif</h4>
                <dl class="row">
                    <dt class="col-sm-4">Rentang Jarak</dt>
                    <dd class="col-sm-8"><strong>{{ $item->jarak_dari_km }} - {{ $item->jarak_sampai_km }} KM</strong></dd>

                    <dt class="col-sm-4">Tarif One Way</dt>
                    <dd class="col-sm-8">Rp{{ number_format($item->tarif_one_way, 0, ',', '.') }}</dd>

                    <dt class="col-sm-4">Tarif Two Way</dt>
                    <dd class="col-sm-8">Rp{{ number_format($item->tarif_two_way, 0, ',', '.') }}</dd>

                    <dt class="col-sm-4">Tarif per KM Tambahan</dt>
                    <dd class="col-sm-8">Rp{{ number_format($item->tarif_per_km, 0, ',', '.') }}</dd>
                </dl>
                <hr>
                <h4>Pendaftaran Terkait</h4>
                 @if($item->pendaftaran_anak && $item->pendaftaran_anak->count() > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($item->pendaftaran_anak as $pendaftaran)
                            <li class="list-group-item">
                                <a href="{{ route('admin.pendaftaran-anak.show', $pendaftaran->id) }}">
                                    ID Pendaftaran: #{{ $pendaftaran->id }} - Anak: {{ $pendaftaran->anak->nama ?? 'N/A' }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>Tidak ada pendaftaran yang menggunakan tarif ini.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

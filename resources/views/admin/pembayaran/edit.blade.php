@extends('layouts.app')

@section('content-title', 'Edit Pembayaran')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-warning">
            <div class="card-header"><h3 class="card-title">Formulir Edit Pembayaran ID: #{{ $item->id }}</h3></div>
            <form action="{{ route('admin.pembayaran.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h6><i class="icon fas fa-ban"></i><strong> Oops! Ada kesalahan.</strong></h6>
                            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="pendaftaran_anak_id">Pendaftaran Anak</label>
                        <select class="form-control @error('pendaftaran_anak_id') is-invalid @enderror" name="pendaftaran_anak_id">
                            <option value="{{ $item->pendaftaran_anak_id }}" selected>ID: {{ $item->pendaftaran_anak_id }} - {{ $item->pendaftaran_anak->anak->nama ?? 'Pendaftaran tidak ditemukan' }}</option>
                        </select>
                        @error('pendaftaran_anak_id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    
                     <div class="form-group">
                        <label for="orang_tua_id">Orang Tua</label>
                        <select class="form-control @error('orang_tua_id') is-invalid @enderror" name="orang_tua_id">
                            <option value="{{ $item->orang_tua_id }}" selected>{{ $item->orang_tua->user->name ?? 'Orang Tua tidak ditemukan' }}</option>
                        </select>
                        @error('orang_tua_id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="jumlah_bayar">Jumlah Bayar (Rp)</label>
                        <input type="number" class="form-control @error('jumlah_bayar') is-invalid @enderror" name="jumlah_bayar" value="{{ old('jumlah_bayar', $item->jumlah_bayar) }}">
                        @error('jumlah_bayar')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="metode_pembayaran">Metode Pembayaran</label>
                                <select class="form-control @error('metode_pembayaran') is-invalid @enderror" name="metode_pembayaran">
                                    @foreach(['cash', 'transfer', 'e-wallet'] as $metode)
                                        <option value="{{ $metode }}" {{ old('metode_pembayaran', $item->metode_pembayaran) == $metode ? 'selected' : '' }}>{{ ucfirst($metode) }}</option>
                                    @endforeach
                                </select>
                                @error('metode_pembayaran')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                             <div class="form-group">
                                <label for="tanggal_bayar">Tanggal Bayar</label>
                                <input type="date" class="form-control @error('tanggal_bayar') is-invalid @enderror" name="tanggal_bayar" value="{{ old('tanggal_bayar', \Carbon\Carbon::parse($item->tanggal_bayar)->format('Y-m-d')) }}">
                                @error('tanggal_bayar')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" name="status">
                            @foreach(['pending', 'sukses', 'gagal'] as $s)
                                <option value="{{ $s }}" {{ old('status', $item->status) == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                        @error('status')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                    <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

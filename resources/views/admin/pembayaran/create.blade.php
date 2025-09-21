@extends('layouts.app')

@section('content-title', 'Buat Pembayaran')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-primary">
            <div class="card-header"><h3 class="card-title">Formulir Pembayaran Baru</h3></div>
            <form action="{{ route('admin.pembayaran.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h6><i class="icon fas fa-ban"></i><strong> Oops! Ada kesalahan.</strong></h6>
                            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="pendaftaran_anak_id">Pendaftaran Anak</label>
                        {{-- PENTING: Anda perlu mengirimkan daftar pendaftaran dari controller --}}
                        <select class="form-control @error('pendaftaran_anak_id') is-invalid @enderror" name="pendaftaran_anak_id">
                            <option value="">Pilih Pendaftaran</option>
                            {{-- @foreach($pendaftarans as $pendaftaran) <option value="{{ $pendaftaran->id }}">ID: {{ $pendaftaran->id }} - {{ $pendaftaran->anak->nama }}</option> @endforeach --}}
                            <option value="1">Contoh: ID: 1 - Rizki Pratama</option>
                        </select>
                        @error('pendaftaran_anak_id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    
                     <div class="form-group">
                        <label for="orang_tua_id">Orang Tua</label>
                        {{-- PENTING: Anda perlu mengirimkan daftar orang tua dari controller --}}
                        <select class="form-control @error('orang_tua_id') is-invalid @enderror" name="orang_tua_id">
                            <option value="">Pilih Orang Tua</option>
                             {{-- @foreach($orangtuas as $ortu) <option value="{{ $ortu->id }}">{{ $ortu->user->name }}</option> @endforeach --}}
                            <option value="1">Contoh: Budi</option>
                        </select>
                        @error('orang_tua_id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="jumlah_bayar">Jumlah Bayar (Rp)</label>
                        <input type="number" class="form-control @error('jumlah_bayar') is-invalid @enderror" name="jumlah_bayar" value="{{ old('jumlah_bayar') }}" placeholder="Contoh: 150000">
                        @error('jumlah_bayar')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="metode_pembayaran">Metode Pembayaran</label>
                                <select class="form-control @error('metode_pembayaran') is-invalid @enderror" name="metode_pembayaran">
                                    @foreach(['cash', 'transfer', 'e-wallet'] as $metode)
                                        <option value="{{ $metode }}" {{ old('metode_pembayaran') == $metode ? 'selected' : '' }}>{{ ucfirst($metode) }}</option>
                                    @endforeach
                                </select>
                                @error('metode_pembayaran')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                             <div class="form-group">
                                <label for="tanggal_bayar">Tanggal Bayar</label>
                                <input type="date" class="form-control @error('tanggal_bayar') is-invalid @enderror" name="tanggal_bayar" value="{{ old('tanggal_bayar', date('Y-m-d')) }}">
                                @error('tanggal_bayar')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" name="status">
                            @foreach(['pending', 'sukses', 'gagal'] as $s)
                                <option value="{{ $s }}" {{ old('status', 'sukses') == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                        @error('status')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

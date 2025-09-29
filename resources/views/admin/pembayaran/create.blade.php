@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Buat Catatan Pembayaran')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Formulir Pembayaran Baru</h3>
            </div>
            <!-- /.card-header -->
            <form action="{{ route('admin.pembayaran.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h6><i class="icon fas fa-ban"></i><strong> Oops! Ada kesalahan.</strong></h6>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- PENTING: Anda perlu mengirimkan daftar pendaftaran ($pendaftaranList) dari controller --}}
                    <div class="form-group">
                        <label for="pendaftaran_anak_id">Pendaftaran Anak</label>
                        <select class="form-control @error('pendaftaran_anak_id') is-invalid @enderror" name="pendaftaran_anak_id" required>
                            <option value="">Pilih Pendaftaran (Anak - Layanan)</option>
                            @foreach($pendaftaranList as $pendaftaran)
                                <option value="{{ $pendaftaran->id }}" {{ old('pendaftaran_anak_id') == $pendaftaran->id ? 'selected' : '' }}>
                                    {{ $pendaftaran->anak->nama ?? 'N/A' }} - ({{ $pendaftaran->tipe_layanan }})
                                </option>
                            @endforeach
                        </select>
                        @error('pendaftaran_anak_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                     {{-- PENTING: Anda perlu mengirimkan daftar orang tua ($orangTuaList) dari controller --}}
                    <div class="form-group">
                        <label for="orang_tua_id">Orang Tua (Pembayar)</label>
                        <select class="form-control @error('orang_tua_id') is-invalid @enderror" name="orang_tua_id" required>
                            <option value="">Pilih Orang Tua</option>
                            @foreach($orangTuaList as $ortu)
                                <option value="{{ $ortu->id }}" {{ old('orang_tua_id') == $ortu->id ? 'selected' : '' }}>
                                    {{ $ortu->user->name ?? 'N/A' }}
                                </option>
                            @endforeach
                        </select>
                        @error('orang_tua_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="jumlah_bayar">Jumlah Bayar (Rp)</label>
                        <input type="number" class="form-control @error('jumlah_bayar') is-invalid @enderror" name="jumlah_bayar" value="{{ old('jumlah_bayar') }}" placeholder="Contoh: 150000" required>
                        @error('jumlah_bayar')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="metode_pembayaran">Metode Pembayaran</label>
                                <select class="form-control @error('metode_pembayaran') is-invalid @enderror" name="metode_pembayaran" required>
                                    @foreach(['cash', 'transfer', 'e-wallet'] as $metode)
                                        <option value="{{ $metode }}" {{ old('metode_pembayaran') == $metode ? 'selected' : '' }}>{{ ucfirst($metode) }}</option>
                                    @endforeach
                                </select>
                                @error('metode_pembayaran')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="tanggal_bayar">Tanggal Bayar</label>
                                <input type="date" class="form-control @error('tanggal_bayar') is-invalid @enderror" name="tanggal_bayar" value="{{ old('tanggal_bayar', date('Y-m-d')) }}">
                                @error('tanggal_bayar')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="status">Status Pembayaran</label>
                        <select class="form-control @error('status') is-invalid @enderror" name="status" required>
                            @foreach(['pending', 'sukses', 'gagal'] as $status)
                                <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                        @error('status')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan Pembayaran</button>
                    <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


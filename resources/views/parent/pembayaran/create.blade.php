@extends('layouts.app')

@section('content-title', 'Formulir Pembayaran')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Buat Transaksi Pembayaran Baru</h3>
            </div>
            <!-- /.card-header -->
            <form action="{{ route('parent.pembayaran.store') }}" method="POST">
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

                    {{-- PENTING: Anda perlu mengirimkan daftar pendaftaran anak milik parent dari controller --}}
                    <div class="form-group">
                        <label for="pendaftaran_anak_id">Pilih Pendaftaran Anak</label>
                        <select class="form-control @error('pendaftaran_anak_id') is-invalid @enderror" id="pendaftaran_anak_id" name="pendaftaran_anak_id" required>
                            <option value="">-- Pilih Anak & Periode --</option>
                            {{-- @foreach($pendaftaranList as $pendaftaran)
                                <option value="{{ $pendaftaran->id }}" {{ old('pendaftaran_anak_id') == $pendaftaran->id ? 'selected' : '' }}>
                                    {{ $pendaftaran->anak->nama }} - ({{ $pendaftaran->periode_mulai }} s/d {{ $pendaftaran->periode_selesai }})
                                </option>
                            @endforeach --}}
                             <option value="1">Contoh: Rizki Pratama (Juli 2024)</option>
                        </select>
                        @error('pendaftaran_anak_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jumlah_bayar">Jumlah Bayar</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Rp</span></div>
                            <input type="number" class="form-control @error('jumlah_bayar') is-invalid @enderror" id="jumlah_bayar" name="jumlah_bayar" placeholder="Contoh: 350000" value="{{ old('jumlah_bayar') }}" required>
                             @error('jumlah_bayar')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                         <small class="form-text text-muted">Jumlah pembayaran akan disesuaikan dengan tarif pendaftaran anak yang dipilih.</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="metode_pembayaran">Metode Pembayaran</label>
                        <select class="form-control @error('metode_pembayaran') is-invalid @enderror" id="metode_pembayaran" name="metode_pembayaran" required>
                            <option value="">Pilih Metode</option>
                            <option value="transfer" {{ old('metode_pembayaran') == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                            <option value="e-wallet" {{ old('metode_pembayaran') == 'e-wallet' ? 'selected' : '' }}>E-Wallet</option>
                            <option value="cash" {{ old('metode_pembayaran') == 'cash' ? 'selected' : '' }}>Cash (Tunai)</option>
                        </select>
                         @error('metode_pembayaran')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    
                     <div class="form-group">
                        <label for="tanggal_bayar">Tanggal Bayar</label>
                        <input type="date" class="form-control @error('tanggal_bayar') is-invalid @enderror" id="tanggal_bayar" name="tanggal_bayar" value="{{ old('tanggal_bayar', date('Y-m-d')) }}">
                        @error('tanggal_bayar')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    {{-- Status biasanya di-handle oleh sistem, tapi disertakan sesuai controller --}}
                    <input type="hidden" name="status" value="pending">
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Kirim Bukti Pembayaran</button>
                    <a href="{{ route('parent.pembayaran.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

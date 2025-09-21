@extends('layouts.app')

@section('content-title', 'Edit Pembayaran')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Edit Transaksi Pembayaran #{{ $item->id }}</h3>
            </div>
            <!-- /.card-header -->
            <form action="{{ route('parent.pembayaran.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
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

                    <div class="form-group">
                        <label>Pendaftaran Anak</label>
                        {{-- Data ini tidak bisa diubah untuk menjaga integritas --}}
                        <input type="text" class="form-control" value="{{ $item->pendaftaran_anak->anak->nama ?? 'N/A' }} - Periode ({{ $item->pendaftaran_anak->periode_mulai }})" disabled>
                        <input type="hidden" name="pendaftaran_anak_id" value="{{ $item->pendaftaran_anak_id }}">
                    </div>

                    <div class="form-group">
                        <label for="jumlah_bayar">Jumlah Bayar</label>
                        <div class="input-group">
                             <div class="input-group-prepend"><span class="input-group-text">Rp</span></div>
                            <input type="number" class="form-control @error('jumlah_bayar') is-invalid @enderror" id="jumlah_bayar" name="jumlah_bayar" value="{{ old('jumlah_bayar', $item->jumlah_bayar) }}" required>
                             @error('jumlah_bayar')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="metode_pembayaran">Metode Pembayaran</label>
                        <select class="form-control @error('metode_pembayaran') is-invalid @enderror" id="metode_pembayaran" name="metode_pembayaran" required>
                            <option value="transfer" {{ old('metode_pembayaran', $item->metode_pembayaran) == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                            <option value="e-wallet" {{ old('metode_pembayaran', $item->metode_pembayaran) == 'e-wallet' ? 'selected' : '' }}>E-Wallet</option>
                            <option value="cash" {{ old('metode_pembayaran', $item->metode_pembayaran) == 'cash' ? 'selected' : '' }}>Cash (Tunai)</option>
                        </select>
                         @error('metode_pembayaran')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    
                     <div class="form-group">
                        <label for="tanggal_bayar">Tanggal Bayar</label>
                        <input type="date" class="form-control @error('tanggal_bayar') is-invalid @enderror" id="tanggal_bayar" name="tanggal_bayar" value="{{ old('tanggal_bayar', $item->tanggal_bayar ? \Carbon\Carbon::parse($item->tanggal_bayar)->format('Y-m-d') : '') }}">
                        @error('tanggal_bayar')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    
                    {{-- Status hanya bisa diedit oleh admin, tapi disertakan sesuai controller --}}
                    <input type="hidden" name="status" value="{{ $item->status }}">
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Update Pembayaran</button>
                    <a href="{{ route('parent.pembayaran.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

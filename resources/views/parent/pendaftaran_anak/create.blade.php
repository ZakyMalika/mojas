@extends('layouts.app')

@section('content-title', 'Formulir Pendaftaran Layanan')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Daftarkan Anak ke Layanan Antar-Jemput</h3>
            </div>
            <!-- /.card-header -->
            <form action="{{ route('parent.pendaftaran-anak.store') }}" method="POST">
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

                    {{-- PERBAIKAN: Menggunakan variabel $anakList yang dikirim dari controller --}}
                    <div class="form-group">
                        <label for="anak_id">Pilih Anak</label>
                        <select class="form-control @error('anak_id') is-invalid @enderror" id="anak_id" name="anak_id" required>
                            <option value="">-- Pilih Anak --</option>
                            {{-- Loop menggunakan variabel yang benar --}}
                            @if(isset($anakList) && $anakList->count() > 0)
                                @foreach($anakList as $anak)
                                    <option value="{{ $anak->id }}" {{ old('anak_id') == $anak->id ? 'selected' : '' }}>{{ $anak->nama }}</option>
                                @endforeach
                            @else
                                <option value="" disabled>Anda belum memiliki data anak. Silakan tambah data anak terlebih dahulu.</option>
                            @endif
                        </select>
                         @error('anak_id') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="tarif_id">Jarak Rumah ke Sekolah (KM)</label>
                        <select class="form-control @error('tarif_id') is-invalid @enderror" id="tarif_id" name="tarif_id" required>
                            <option value="">Pilih Jarak</option>
                            @foreach($tarifList as $tarif)
                                <option value="{{ $tarif->id }}" {{ old('tarif_id') == $tarif->id ? 'selected' : '' }}>{{ $tarif->min_distance_km }} - {{ $tarif->max_distance_km }} KM</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Jarak ini akan menentukan tarif layanan.</small>
                        @error('tarif_id') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="tipe_layanan">Tipe Layanan</label>
                        <select class="form-control @error('tipe_layanan') is-invalid @enderror" id="tipe_layanan" name="tipe_layanan" required>
                            <option value="one_way" {{ old('tipe_layanan') == 'one_way' ? 'selected' : '' }}>One Way (Sekali Jalan)</option>
                            <option value="two_way" {{ old('tipe_layanan') == 'two_way' ? 'selected' : '' }}>Two Way (Pulang Pergi)</option>
                        </select>
                        @error('tipe_layanan') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="periode_mulai">Periode Mulai</label>
                        <input type="date" class="form-control @error('periode_mulai') is-invalid @enderror" id="periode_mulai" name="periode_mulai" value="{{ old('periode_mulai', date('Y-m-d')) }}" required>
                         @error('periode_mulai') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                    </div>

                    {{-- Hidden fields for default values --}}
                    <input type="hidden" name="tarif_bulanan" value="300000">
                    <input type="hidden" name="status" value="pending">
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Daftarkan</button>
                    <a href="{{ route('parent.pendaftaran-anak.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


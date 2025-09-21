@extends('layouts.app')

@section('content-title', 'Edit Pendaftaran Layanan')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Edit Pendaftaran untuk: {{ $item->anak->nama ?? 'N/A' }}</h3>
            </div>
            <!-- /.card-header -->
            <form action="{{ route('parent.pendaftaran-anak.update', $item->id) }}" method="POST">
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
                        <label>Anak</label>
                        <input type="text" class="form-control" value="{{ $item->anak->nama ?? 'N/A' }}" disabled>
                        <input type="hidden" name="anak_id" value="{{ $item->anak_id }}">
                    </div>

                    <div class="form-group">
                        <label for="jarak_km">Jarak Rumah ke Sekolah (KM)</label>
                        <input type="number" step="0.1" class="form-control @error('jarak_km') is-invalid @enderror" id="jarak_km" name="jarak_km" value="{{ old('jarak_km', $item->jarak_km) }}" required>
                         @error('jarak_km') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="tipe_layanan">Tipe Layanan</label>
                        <select class="form-control @error('tipe_layanan') is-invalid @enderror" id="tipe_layanan" name="tipe_layanan" required>
                            <option value="one_way" {{ old('tipe_layanan', $item->tipe_layanan) == 'one_way' ? 'selected' : '' }}>One Way (Sekali Jalan)</option>
                            <option value="two_way" {{ old('tipe_layanan', $item->tipe_layanan) == 'two_way' ? 'selected' : '' }}>Two Way (Pulang Pergi)</option>
                        </select>
                         @error('tipe_layanan') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="periode_mulai">Periode Mulai</label>
                        <input type="date" class="form-control @error('periode_mulai') is-invalid @enderror" id="periode_mulai" name="periode_mulai" value="{{ old('periode_mulai', $item->periode_mulai ? \Carbon\Carbon::parse($item->periode_mulai)->format('Y-m-d') : '') }}" required>
                        @error('periode_mulai') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                    </div>

                    {{-- Field tersembunyi sesuai controller --}}
                     <input type="hidden" name="tarif_id" value="{{ $item->tarif_id }}">
                    <input type="hidden" name="tarif_bulanan" value="{{ $item->tarif_bulanan }}">
                    <input type="hidden" name="status" value="{{ $item->status }}">
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Update Pendaftaran</button>
                    <a href="{{ route('parent.pendaftaran-anak.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

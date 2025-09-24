@extends('layouts.app')

@section('content-title', 'Tambah Tarif Jarak')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-primary">
            <div class="card-header"><h3 class="card-title">Formulir Tarif Jarak Baru</h3></div>
            <form action="{{ route('admin.tarif-jarak.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h6><i class="icon fas fa-ban"></i><strong> Oops! Ada kesalahan.</strong></h6>
                            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="min_distance_km">Jarak Dari (KM)</label>
                                <input type="number" step="0.1" class="form-control @error('min_distance_km') is-invalid @enderror" name="min_distance_km" value="{{ old('min_distance_km') }}" placeholder="Contoh: 0">
                                @error('min_distance_km')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                         <div class="col-sm-6">
                            <div class="form-group">
                                <label for="max_distance_km">Jarak Sampai (KM)</label>
                                <input type="number" step="0.1" class="form-control @error('max_distance_km') is-invalid @enderror" name="max_distance_km" value="{{ old('max_distance_km') }}" placeholder="Contoh: 5">
                                @error('max_distance_km')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="tarif_one_way">Tarif One Way (Rp)</label>
                                <input type="number" class="form-control @error('tarif_one_way') is-invalid @enderror" name="tarif_one_way" value="{{ old('tarif_one_way') }}" placeholder="Contoh: 150000">
                                @error('tarif_one_way')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                         <div class="col-sm-6">
                            <div class="form-group">
                                <label for="tarif_two_way">Tarif Two Way (Rp)</label>
                                <input type="number" class="form-control @error('tarif_two_way') is-invalid @enderror" name="tarif_two_way" value="{{ old('tarif_two_way') }}" placeholder="Contoh: 250000">
                                @error('tarif_two_way')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tarif_per_km">Tarif per KM Tambahan (Rp)</label>
                        <input type="number" class="form-control @error('tarif_per_km') is-invalid @enderror" name="tarif_per_km" value="{{ old('tarif_per_km') }}" placeholder="Contoh: 5000">
                         @error('tarif_per_km')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.tarif-jarak.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

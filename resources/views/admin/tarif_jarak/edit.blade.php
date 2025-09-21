@extends('layouts.app')

@section('content-title', 'Edit Tarif Jarak')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-warning">
            <div class="card-header"><h3 class="card-title">Formulir Edit Tarif ID: #{{ $item->id }}</h3></div>
            <form action="{{ route('admin.tarif-jarak.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
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
                                <label for="jarak_dari_km">Jarak Dari (KM)</label>
                                <input type="number" step="0.1" class="form-control @error('jarak_dari_km') is-invalid @enderror" name="jarak_dari_km" value="{{ old('jarak_dari_km', $item->jarak_dari_km) }}">
                                @error('jarak_dari_km')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                         <div class="col-sm-6">
                            <div class="form-group">
                                <label for="jarak_sampai_km">Jarak Sampai (KM)</label>
                                <input type="number" step="0.1" class="form-control @error('jarak_sampai_km') is-invalid @enderror" name="jarak_sampai_km" value="{{ old('jarak_sampai_km', $item->jarak_sampai_km) }}">
                                @error('jarak_sampai_km')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="tarif_one_way">Tarif One Way (Rp)</label>
                                <input type="number" class="form-control @error('tarif_one_way') is-invalid @enderror" name="tarif_one_way" value="{{ old('tarif_one_way', $item->tarif_one_way) }}">
                                @error('tarif_one_way')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                         <div class="col-sm-6">
                            <div class="form-group">
                                <label for="tarif_two_way">Tarif Two Way (Rp)</label>
                                <input type="number" class="form-control @error('tarif_two_way') is-invalid @enderror" name="tarif_two_way" value="{{ old('tarif_two_way', $item->tarif_two_way) }}">
                                @error('tarif_two_way')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tarif_per_km">Tarif per KM Tambahan (Rp)</label>
                        <input type="number" class="form-control @error('tarif_per_km') is-invalid @enderror" name="tarif_per_km" value="{{ old('tarif_per_km', $item->tarif_per_km) }}">
                         @error('tarif_per_km')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                    <a href="{{ route('admin.tarif-jarak.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

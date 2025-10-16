@extends('layouts.app')

@section('content-title', 'Edit Tarif Jarak')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-warning card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit"></i>
                    Edit Tarif Jarak #{{ $item->id }}
                </h3>
            </div>
            <form action="{{ route('admin.tarif-jarak.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h6><i class="icon fas fa-ban"></i><strong>Oops! Ada kesalahan</strong></h6>
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li><i class="fas fa-dot-circle mr-2"></i>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="min_distance_km">
                                    <i class="fas fa-map-marker-alt text-danger"></i>
                                    Jarak Minimal (KM)
                                </label>
                                <div class="input-group">
                                    <input type="number" 
                                           step="0.01" 
                                           class="form-control @error('min_distance_km') is-invalid @enderror" 
                                           name="min_distance_km" 
                                           id="min_distance_km"
                                           value="{{ old('min_distance_km', $item->min_distance_km) }}"
                                           required
                                           min="0">
                                    <div class="input-group-append">
                                        <span class="input-group-text">KM</span>
                                    </div>
                                </div>
                                @error('min_distance_km')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="max_distance_km">
                                    <i class="fas fa-map-marker text-success"></i>
                                    Jarak Maksimal (KM)
                                </label>
                                <div class="input-group">
                                    <input type="number" 
                                           step="0.01" 
                                           class="form-control @error('max_distance_km') is-invalid @enderror" 
                                           name="max_distance_km" 
                                           id="max_distance_km"
                                           value="{{ old('max_distance_km', $item->max_distance_km) }}"
                                           required
                                           min="0">
                                    <div class="input-group-append">
                                        <span class="input-group-text">KM</span>
                                    </div>
                                </div>
                                @error('max_distance_km')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="tarif_one_way">
                                    <i class="fas fa-arrow-right text-info"></i>
                                    Tarif One Way
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" 
                                           class="form-control @error('tarif_one_way') is-invalid @enderror" 
                                           name="tarif_one_way" 
                                           id="tarif_one_way"
                                           value="{{ old('tarif_one_way', $item->tarif_one_way) }}"
                                           min="0">
                                </div>
                                @error('tarif_one_way')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="tarif_two_way">
                                    <i class="fas fa-exchange-alt text-warning"></i>
                                    Tarif Two Way
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" 
                                           class="form-control @error('tarif_two_way') is-invalid @enderror" 
                                           name="tarif_two_way" 
                                           id="tarif_two_way"
                                           value="{{ old('tarif_two_way', $item->tarif_two_way) }}"
                                           min="0">
                                </div>
                                @error('tarif_two_way')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tarif_per_km">
                            <i class="fas fa-route text-primary"></i>
                            Tarif per KM Tambahan
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" 
                                   class="form-control @error('tarif_per_km') is-invalid @enderror" 
                                   name="tarif_per_km" 
                                   id="tarif_per_km"
                                   value="{{ old('tarif_per_km', $item->tarif_per_km) }}"
                                   min="0">
                            <div class="input-group-append">
                                <span class="input-group-text">/KM</span>
                            </div>
                        </div>
                        @error('tarif_per_km')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save mr-1"></i>
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.tarif-jarak.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times mr-1"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Validasi input jarak
    $('#jarak_dari_km, #jarak_sampai_km').on('input', function() {
        var jarakDari = parseFloat($('#jarak_dari_km').val()) || 0;
        var jarakSampai = parseFloat($('#jarak_sampai_km').val()) || 0;
        
        if (jarakDari > jarakSampai) {
            $('#jarak_sampai_km')[0].setCustomValidity('Jarak sampai harus lebih besar dari jarak dari');
        } else {
            $('#jarak_sampai_km')[0].setCustomValidity('');
        }
    });

    // Format angka rupiah
    function formatRupiah(angka) {
        var reverse = angka.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
        return 'Rp ' + ribuan.join('.').split('').reverse().join('');
    }

    // Update format saat input berubah
    $('#tarif_one_way, #tarif_two_way, #tarif_per_km').on('input', function() {
        var value = $(this).val();
        if (value) {
            $(this).attr('title', formatRupiah(value));
        }
    });

    // Validasi tarif two way lebih besar dari one way
    $('#tarif_one_way, #tarif_two_way').on('input', function() {
        var oneWay = parseFloat($('#tarif_one_way').val()) || 0;
        var twoWay = parseFloat($('#tarif_two_way').val()) || 0;
        
        if (twoWay <= oneWay) {
            $('#tarif_two_way')[0].setCustomValidity('Tarif two way harus lebih besar dari tarif one way');
        } else {
            $('#tarif_two_way')[0].setCustomValidity('');
        }
    });
});
</script>
@endpush
@extends('layouts.app')

@section('content-title', 'Edit Pendaftaran Anak')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-warning">
            <div class="card-header"><h3 class="card-title">Formulir Edit Pendaftaran ID: #{{ $item->id }}</h3></div>
            <form action="{{ route('admin.pendaftaran-anak.update', $item->id) }}" method="POST">
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
                        <label for="anak_id">Anak</label>
                        <select class="form-control @error('anak_id') is-invalid @enderror" name="anak_id" id="anak_id">
                            <option value="{{ $item->anak_id }}" selected>{{ $item->anak->nama ?? 'Anak tidak ditemukan' }}</option>
                        </select>
                        @error('anak_id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="school_id">Mitra Sekolah</label>
                        <select class="form-control @error('school_id') is-invalid @enderror" name="school_id" id="school_id">
                            <option value="">Pilih Mitra Sekolah (Opsional)</option>
                            @foreach($schools as $school)
                                @if($school->has_partnership)
                                    <option value="{{ $school->id }}" 
                                            data-one-way="{{ $school->one_way_price }}" 
                                            data-two-way="{{ $school->two_way_price }}"
                                            data-partnership-rate="{{ $school->partnership_rate }}"
                                            {{ old('school_id', $item->school_id) == $school->id ? 'selected' : '' }}>
                                        {{ $school->name }} - Partnership Rate: Rp{{ number_format($school->partnership_rate, 0, ',', '.') }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('school_id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                        <small class="form-text text-muted">Jika memilih mitra sekolah, tarif akan otomatis disesuaikan dan field lain akan terkunci.</small>
                    </div>
                     <div class="form-group">
                        <label for="tarif_id">Tarif Jarak</label>
                        <select class="form-control @error('tarif_id') is-invalid @enderror" name="tarif_id" id="tarif_id">
                            <option value="">Pilih Tarif Jarak</option>
                            @foreach($tarifs ?? [] as $tarif)
                                <option value="{{ $tarif->id }}" 
                                        data-min="{{ $tarif->min_distance_km }}"
                                        data-max="{{ $tarif->max_distance_km }}"
                                        data-one-way="{{ $tarif->tarif_one_way }}"
                                        data-two-way="{{ $tarif->tarif_two_way }}"
                                        data-per-km="{{ $tarif->tarif_per_km }}"
                                        {{ old('tarif_id', $item->tarif_id) == $tarif->id ? 'selected' : '' }}>
                                    {{ $tarif->min_distance_km }} - {{ $tarif->max_distance_km }} KM 
                                    (One Way: Rp{{ number_format($tarif->tarif_one_way, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                        @error('tarif_id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="jarak_km">Jarak Tempuh (KM)</label>
                                <div class="input-group">
                                    <input type="number" 
                                           step="0.1" 
                                           class="form-control @error('jarak_km') is-invalid @enderror" 
                                           name="jarak_km" 
                                           id="jarak_km" 
                                           value="{{ old('jarak_km', $item->jarak_km) }}"
                                           min="0">
                                    <div class="input-group-append">
                                        <span class="input-group-text">KM</span>
                                    </div>
                                </div>
                                @error('jarak_km')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                         <div class="col-sm-6">
                            <div class="form-group">
                                <label for="tarif_bulanan">Tarif Bulanan (Rp)</label>
                                <input type="number" class="form-control @error('tarif_bulanan') is-invalid @enderror" name="tarif_bulanan" id="tarif_bulanan" value="{{ old('tarif_bulanan', $item->tarif_bulanan) }}">
                                @error('tarif_bulanan')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tipe_layanan">Tipe Layanan</label>
                        <select class="form-control @error('tipe_layanan') is-invalid @enderror" name="tipe_layanan" id="tipe_layanan">
                            <option value="one_way" {{ old('tipe_layanan', $item->tipe_layanan) == 'one_way' ? 'selected' : '' }}>Sekali Jalan (One Way)</option>
                            <option value="two_way" {{ old('tipe_layanan', $item->tipe_layanan) == 'two_way' ? 'selected' : '' }}>Pulang Pergi (Two Way)</option>
                        </select>
                        @error('tipe_layanan')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                     <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="periode_mulai">Periode Mulai</label>
                                <input type="date" class="form-control @error('periode_mulai') is-invalid @enderror" name="periode_mulai" value="{{ old('periode_mulai', $item->periode_mulai) }}">
                                @error('periode_mulai')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                             <div class="form-group">
                                <label for="periode_selesai">Periode Selesai (Opsional)</label>
                                <input type="date" class="form-control @error('periode_selesai') is-invalid @enderror" name="periode_selesai" value="{{ old('periode_selesai', $item->periode_selesai) }}">
                                @error('periode_selesai')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" name="status">
                            @foreach(['pending', 'lunas', 'expired'] as $s)
                                <option value="{{ $s }}" {{ old('status', $item->status) == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                        @error('status')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                    <a href="{{ route('admin.pendaftaran-anak.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const schoolSelect = document.getElementById('school_id');
    const tarifSelect = document.getElementById('tarif_id');
    const jarakInput = document.getElementById('jarak_km');
    const tarifBulananInput = document.getElementById('tarif_bulanan');
    const tipeLayananSelect = document.getElementById('tipe_layanan');
    
    // Fields that should be disabled when school partnership is selected
    const fieldsToDisable = [tarifSelect, jarakInput];
    
    function toggleFields(isPartnershipSelected) {
        fieldsToDisable.forEach(field => {
            field.disabled = isPartnershipSelected;
            if (isPartnershipSelected) {
                field.classList.add('bg-light');
            } else {
                field.classList.remove('bg-light');
            }
        });
    }
    
    function calculateTarif() {
        const selectedTarif = tarifSelect.options[tarifSelect.selectedIndex];
        const jarak = parseFloat(jarakInput.value) || 0;
        const tipeLayanan = tipeLayananSelect.value;
        
        if (selectedTarif && selectedTarif.value && jarak > 0) {
            const minJarak = parseFloat(selectedTarif.dataset.min);
            const maxJarak = parseFloat(selectedTarif.dataset.max);
            
            if (jarak >= minJarak && jarak <= maxJarak) {
                let baseTarif = tipeLayanan === 'two_way' ? 
                    parseFloat(selectedTarif.dataset.twoWay) : 
                    parseFloat(selectedTarif.dataset.oneWay);
                
                // Tambahan tarif per KM jika melebihi jarak minimum
                if (jarak > minJarak) {
                    const extraKm = jarak - minJarak;
                    const extraCharge = extraKm * parseFloat(selectedTarif.dataset.perKm);
                    baseTarif += extraCharge;
                }
                
                tarifBulananInput.value = Math.round(baseTarif);
            }
        }
    }
    
    function updateTarifBasedOnSchool() {
        const selectedOption = schoolSelect.options[schoolSelect.selectedIndex];
        
        if (selectedOption.value && selectedOption.dataset.oneWay) {
            // School partnership selected
            toggleFields(true);
            
            // Auto-fill tarif based on service type
            const tipeLayanan = tipeLayananSelect.value;
            let tarif = 0;
            
            if (tipeLayanan === 'two_way') {
                tarif = parseFloat(selectedOption.dataset.twoWay);
            } else {
                tarif = parseFloat(selectedOption.dataset.oneWay);
            }
            
            tarifBulananInput.value = tarif;
            tarifBulananInput.readOnly = true;
            tarifBulananInput.classList.add('bg-light');
            
            // Clear and disable other fields
            tarifSelect.value = '';
            jarakInput.value = '';
            
        } else {
            // No school partnership selected
            toggleFields(false);
            tarifBulananInput.readOnly = false;
            tarifBulananInput.classList.remove('bg-light');
            calculateTarif(); // Hitung ulang tarif jika ada
        }
    }
    
    // Event listeners
    schoolSelect.addEventListener('change', updateTarifBasedOnSchool);
    tipeLayananSelect.addEventListener('change', function() {
        if (schoolSelect.value) {
            updateTarifBasedOnSchool();
        } else {
            calculateTarif();
        }
    });
    
    jarakInput.addEventListener('input', function() {
        if (!schoolSelect.value) {
            calculateTarif();
        }
    });
    
    tarifSelect.addEventListener('change', function() {
        if (!schoolSelect.value) {
            calculateTarif();
        }
    });
    
    // Initialize on page load
    updateTarifBasedOnSchool();
});
</script>
@endpush

@endsection

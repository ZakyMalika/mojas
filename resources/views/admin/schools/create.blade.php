@extends('layouts.app')

@section('content-title', 'Buat Pendaftaran Mitra Baru')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Formulir Pendaftaran Mitra Baru</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.schools.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Form untuk Menyimpan Data Baru --}}
                    <form action="{{ route('admin.schools.store') }}" method="POST">
                        @csrf

                        {{-- 1. Input Nama Mitra/Sekolah (name) --}}
                        <div class="form-group">
                            <label for="name">Nama Mitra/Sekolah</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}"
                                placeholder="Masukkan Nama Mitra/Sekolah" maxlength="255" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- 2. Input Tipe (type) --}}
                        <div class="form-group">
                            <label>Tipe Mitra <span class="text-danger">*</span></label>
                            <div class="d-flex flex-row">
                                <div class="form-check mr-3">
                                    <input class="form-check-input" type="radio" name="type" id="type_sekolah" value="sekolah"
                                        {{ old('type') == 'sekolah' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="type_sekolah">Sekolah</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" id="type_umum" value="umum"
                                        {{ old('type') == 'umum' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="type_umum">Umum</label>
                                </div>
                            </div>
                            @error('type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- 3. Input Alamat (address) --}}
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea name="address" id="address"
                                class="form-control @error('address') is-invalid @enderror"
                                rows="3" placeholder="Masukkan Alamat Mitra (Opsional)">{{ old('address') }}</textarea>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <hr>

                        {{-- 4. Checkbox Memiliki Kemitraan (has_partnership) --}}
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                {{-- Hidden field untuk memastikan nilai 0 terkirim jika checkbox tidak dicentang --}}
                                <input type="hidden" name="has_partnership" value="0">
                                <input type="checkbox" name="has_partnership" class="custom-control-input" id="has_partnership_switch" value="1"
                                    {{ old('has_partnership') == 1 ? 'checked' : '' }}>
                                <label class="custom-control-label" for="has_partnership_switch">Memiliki Kemitraan</label>
                            </div>
                            @error('has_partnership')
                                <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- 5. Input Partnership Rate (partnership_rate) - Tampil kondisional --}}
                        <div class="form-group" id="partnership_rate_group" style="{{ old('has_partnership') == 1 ? '' : 'display: none;' }}">
                            <label for="partnership_rate">Tarif Kemitraan</label>
                            <input type="number" name="partnership_rate" id="partnership_rate"
                                class="form-control @error('partnership_rate') is-invalid @enderror"
                                value="{{ old('partnership_rate') }}"
                                placeholder="Cth: 150000" min="0" step="any">
                            @error('partnership_rate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <small class="form-text text-muted">Isi dengan tarif bulanan kemitraan (misal: tarif per anak).</small>
                        </div>
                        
                        <hr>

                        <h4>Tarif Umum Non-Kemitraan (Perjalanan)</h4>

                        {{-- 8. Input General Rate (general_rate) --}}
                        <div class="form-group">
                            <label for="general_rate">Tarif Umum Perjalanan (Rupiah/KM/Anak - Wajib)</label>
                            <input type="number" name="general_rate" id="general_rate"
                                class="form-control @error('general_rate') is-invalid @enderror"
                                value="{{ old('general_rate') }}"
                                placeholder="Cth: 2000" min="0" step="any" >
                            @error('general_rate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- 6. Input One Way Price (one_way_price) --}}
                        <div class="form-group">
                            <label for="one_way_price">Harga Dasar Satu Arah (Rupiah/Bulan - Opsional)</label>
                            <input type="number" name="one_way_price" id="one_way_price"
                                class="form-control @error('one_way_price') is-invalid @enderror"
                                value="{{ old('one_way_price') }}"
                                placeholder="Cth: 50000" min="0" step="any">
                            @error('one_way_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <small class="form-text text-muted">Harga dasar bulanan untuk layanan satu arah (sebelum dihitung jarak).</small>
                        </div>

                        {{-- 7. Input Two Way Price (two_way_price) --}}
                        <div class="form-group">
                            <label for="two_way_price">Harga Dasar Dua Arah (Rupiah/Bulan - Opsional)</label>
                            <input type="number" name="two_way_price" id="two_way_price"
                                class="form-control @error('two_way_price') is-invalid @enderror"
                                value="{{ old('two_way_price') }}"
                                placeholder="Cth: 100000" min="0" step="any">
                            @error('two_way_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <small class="form-text text-muted">Harga dasar bulanan untuk layanan dua arah (sebelum dihitung jarak).</small>
                        </div>
                        
                        <hr>

                        {{-- 9. Checkbox Status Aktif (is_active) --}}
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                {{-- Hidden field untuk memastikan nilai 0 terkirim jika checkbox tidak dicentang --}}
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" class="custom-control-input" id="is_active_switch" value="1"
                                    {{ old('is_active') === null || old('is_active') == 1 ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active_switch">Status Aktif</label>
                            </div>
                            @error('is_active')
                                <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Tombol Submit --}}
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Simpan Pendaftaran
                        </button>

                    </form>
                </div>
                </div>
            </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const hasPartnershipSwitch = document.getElementById('has_partnership_switch');
            const partnershipRateGroup = document.getElementById('partnership_rate_group');

            // Function to toggle visibility
            function togglePartnershipRate() {
                if (hasPartnershipSwitch.checked) {
                    partnershipRateGroup.style.display = 'block';
                } else {
                    partnershipRateGroup.style.display = 'none';
                    // Optional: Clear the value when hidden to prevent sending obsolete data
                    document.getElementById('partnership_rate').value = '';
                }
            }

            // Initial state check (for persistent old input)
            togglePartnershipRate();

            // Event listener for the switch
            hasPartnershipSwitch.addEventListener('change', togglePartnershipRate);
        });
    </script>
@endpush
@extends('layouts.app')

@section('content-title', 'Buat Catatan Penghasilan')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-primary">
            <div class="card-header"><h3 class="card-title">Formulir Penghasilan Baru</h3></div>
            <form action="{{ route('driver.penghasilan.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h6><i class="icon fas fa-ban"></i><strong> Oops! Ada kesalahan.</strong></h6>
                            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                        </div>
                    @endif

                    {{-- Driver ID is handled by Auth in Controller --}}

                    <div class="form-group">
                        <label for="anak_id">Anak</label>
                        <select class="form-control @error('anak_id') is-invalid @enderror" name="anak_id" id="anak_id">
                            <option value="">Pilih Anak</option>
                            @foreach($anaks as $anak) <option value="{{ $anak->id }}">{{ $anak->nama }}</option> @endforeach
                        </select>
                        {{-- Note: we need to handle validation error helper for anak_id if it's not in the request validation rules, 
                             though we use it to load jadwals. Controller validation focuses on scheduling ID. --}}
                    </div>
                     <div class="form-group">
                        <label for="jadwal_id">Jadwal Terkait</label>
                        <select class="form-control @error('jadwal_id') is-invalid @enderror" name="jadwal_id" id="jadwal_id">
                            <option value="">Pilih Anak Terlebih Dahulu</option>
                        </select>
                        @error('jadwal_id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                        
                        <small class="text-muted">
                            Jadwal akan dimuat berdasarkan anak yang dipilih.
                        </small>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="tarif_per_trip">Tarif per Trip (Rp)</label>
                                <input type="number" class="form-control @error('tarif_per_trip') is-invalid @enderror" name="tarif_per_trip" value="{{ old('tarif_per_trip') }}" placeholder="Contoh: 25000">
                                @error('tarif_per_trip')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                         <div class="col-sm-6">
                            <div class="form-group">
                                <label for="deduction_percentage">Potongan</label>
                                <select id="deduction_percentage" name="deduction_percentage" class="form-control @error('deduction_percentage') is-invalid @enderror">
                                    <option value="0" {{ old('deduction_percentage') == '0' ? 'selected' : '' }}>Tidak Ada</option>
                                    <option value="5" {{ old('deduction_percentage') == '5' ? 'selected' : '' }}>5%</option>
                                    <option value="10" {{ old('deduction_percentage') == '10' ? 'selected' : '' }}>10%</option>
                                </select>
                                @error('deduction_percentage')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="gross_amount">Angka Penghasilan (Rp)</label>
                                <input id="gross_amount" type="number" step="0.01" class="form-control @error('gross_amount') is-invalid @enderror" name="gross_amount" value="{{ old('gross_amount') }}" placeholder="Contoh: 25000">
                                @error('gross_amount')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                       
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="komisi_akhir_display">Hasil Setelah Potongan (Rp)</label>
                                <input id="komisi_akhir_display" type="text" class="form-control" readonly value="{{ old('komisi_pengemudi') ? number_format(old('komisi_pengemudi'), 0, ',', '.') : '' }}">
                                <input id="komisi_pengemudi" type="hidden" name="komisi_pengemudi" value="{{ old('komisi_pengemudi') }}">
                                <small class="text-muted">Nilai otomatis terisi berdasarkan angka penghasilan dan potongan.</small>
                            </div>
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-sm-6">
                             <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status">
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="dibayar" {{ old('status') == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                                </select>
                                @error('status')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                             <div class="form-group">
                                <label for="tanggal_dibayar">Tanggal Dibayar (Opsional)</label>
                                <input type="date" class="form-control @error('tanggal_dibayar') is-invalid @enderror" name="tanggal_dibayar" value="{{ old('tanggal_dibayar') }}">
                                @error('tanggal_dibayar')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('driver.penghasilan.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const anakSelect = document.getElementById('anak_id');
    const jadwalSelect = document.getElementById('jadwal_id');
    
   
    // I will blindly use the AJAX for now but pointing to `{{ url('admin/penghasilan/jadwal-by-anak') }}` might be 403.
    // **Correction**: I see `Route::get('penghasilan/jadwal-by-anak/{anak}', ...)` inside Admin group.
    
    function loadJadwalByAnak(anakId) {
        jadwalSelect.innerHTML = '<option value="">Loading...</option>';
        if (!anakId) {
            jadwalSelect.innerHTML = '<option value="">Pilih Anak Terlebih Dahulu</option>';
            return;
        }
        
        // Use the Driver endpoint
        const url = `{{ url('driver/penghasilan/jadwal-by-anak') }}/${anakId}`;
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken || ''
            }
        })
            .then(response => {
                if (!response.ok) {
                     // Fallback/Silent fail -> just clear
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                jadwalSelect.innerHTML = '<option value="">Pilih Jadwal</option>';
                if (data.jadwals && data.jadwals.length > 0) {
                    data.jadwals.forEach(jadwal => {
                        const option = document.createElement('option');
                        option.value = jadwal.id;
                        option.textContent = `${jadwal.tanggal} - ${jadwal.jam_jemput} (${jadwal.status})`;
                        jadwalSelect.appendChild(option);
                    });
                } else {
                    jadwalSelect.innerHTML = '<option value="">Tidak ada jadwal tersedia</option>';
                }
            })
            .catch(error => {
                console.error('Error loading jadwal:', error);
                // Try simpler message
                jadwalSelect.innerHTML = '<option value="">Gagal memuat jadwal (Cek Izin)</option>';
            });
    }
    
    anakSelect.addEventListener('change', function() {
        loadJadwalByAnak(this.value);
    });
    
    if (anakSelect.value) {
        loadJadwalByAnak(anakSelect.value);
    }
    
    // --- Komputasi otomatis ---
    const grossInput = document.getElementById('gross_amount');
    const deductionSelect = document.getElementById('deduction_percentage');
    const komisiDisplay = document.getElementById('komisi_akhir_display');
    const komisiInput = document.getElementById('komisi_pengemudi');

    function formatRupiah(value) {
        if (value === null || value === undefined || isNaN(value)) return '';
        return new Intl.NumberFormat('id-ID').format(value);
    }

    function computeKomisi() {
        const gross = parseFloat(grossInput.value) || 0;
        const deduction = parseFloat(deductionSelect.value) || 0;
        const net = gross - (gross * (deduction / 100));
        komisiDisplay.value = net > 0 ? formatRupiah(net) : '';
        if (komisiInput) komisiInput.value = net.toFixed(2);
    }

    if (grossInput) grossInput.addEventListener('input', computeKomisi);
    if (deductionSelect) deductionSelect.addEventListener('change', computeKomisi);

    computeKomisi();
});
</script>
@endpush
@endsection

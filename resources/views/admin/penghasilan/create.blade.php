@extends('layouts.app')

@section('content-title', 'Buat Catatan Penghasilan')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-primary">
            <div class="card-header"><h3 class="card-title">Formulir Penghasilan Baru</h3></div>
            <form action="{{ route('admin.penghasilan.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h6><i class="icon fas fa-ban"></i><strong> Oops! Ada kesalahan.</strong></h6>
                            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="driver_id">Pengemudi</label>
                        {{-- PENTING: Anda perlu mengirimkan daftar pengemudi dari controller --}}
                        <select class="form-control @error('driver_id') is-invalid @enderror" name="driver_id">
                            <option value="">Pilih Pengemudi</option>
                            @foreach($drivers as $driver) <option value="{{ $driver->id }}">{{ $driver->user->name }}</option> @endforeach
                            {{-- <option value="1">Contoh: Jono</option> --}}
                        </select>
                        @error('driver_id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="anak_id">Anak</label>
                        {{-- PENTING: Anda perlu mengirimkan daftar anak dari controller --}}
                        <select class="form-control @error('anak_id') is-invalid @enderror" name="anak_id" id="anak_id">
                            <option value="">Pilih Anak</option>
                            @foreach($anaks as $anak) <option value="{{ $anak->id }}">{{ $anak->nama }}</option> @endforeach
                            {{-- <option value="1">Contoh: Budi</option> --}}
                        </select>
                        @error('anak_id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                     <div class="form-group">
                        <label for="jadwal_id">Jadwal Terkait</label>
                        <select class="form-control @error('jadwal_id') is-invalid @enderror" name="jadwal_id" id="jadwal_id">
                            <option value="">Pilih Anak Terlebih Dahulu</option>
                        </select>
                        @error('jadwal_id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                        
                        {{-- Debug info --}}
                        <small class="text-muted">
                            Debug: Jadwal akan dimuat berdasarkan anak yang dipilih
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
                                <label for="komisi_pengemudi">Komisi Pengemudi (Rp)</label>
                                <input type="number" class="form-control @error('komisi_pengemudi') is-invalid @enderror" name="komisi_pengemudi" value="{{ old('komisi_pengemudi') }}" placeholder="Contoh: 20000">
                                @error('komisi_pengemudi')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
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
                    <a href="{{ route('admin.penghasilan.index') }}" class="btn btn-secondary">Batal</a>
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
    
    console.log('Script loaded');
    
    // Function untuk load jadwal berdasarkan anak
    function loadJadwalByAnak(anakId) {
        console.log('Loading jadwal for anak ID:', anakId);
        
        // Reset jadwal select
        jadwalSelect.innerHTML = '<option value="">Loading...</option>';
        
        if (!anakId) {
            jadwalSelect.innerHTML = '<option value="">Pilih Anak Terlebih Dahulu</option>';
            return;
        }
        
        // AJAX call untuk mendapatkan jadwal
        const url = `{{ url('admin/test-jadwal') }}/${anakId}`;
        console.log('Fetching URL:', url);
        
        fetch(url)
            .then(response => {
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Jadwal data received:', data);
                
                jadwalSelect.innerHTML = '<option value="">Pilih Jadwal</option>';
                
                if (data.jadwals && data.jadwals.length > 0) {
                    console.log('Processing', data.jadwals.length, 'jadwals');
                    data.jadwals.forEach(jadwal => {
                        console.log('Adding jadwal:', jadwal);
                        const option = document.createElement('option');
                        option.value = jadwal.id;
                        option.textContent = `${jadwal.tanggal} - ${jadwal.jam_jemput} (${jadwal.status})`;
                        jadwalSelect.appendChild(option);
                    });
                } else {
                    console.log('No jadwals found');
                    jadwalSelect.innerHTML = '<option value="">Tidak ada jadwal tersedia</option>';
                }
            })
            .catch(error => {
                console.error('Error loading jadwal:', error);
                jadwalSelect.innerHTML = '<option value="">Error loading jadwal</option>';
            });
    }
    
    // Event listener untuk perubahan anak
    anakSelect.addEventListener('change', function() {
        console.log('Anak selection changed to:', this.value);
        loadJadwalByAnak(this.value);
    });
    
    // Load jadwal untuk anak yang sudah dipilih (jika ada old input)
    if (anakSelect.value) {
        loadJadwalByAnak(anakSelect.value);
    }
});
</script>
@endpush
@endsection

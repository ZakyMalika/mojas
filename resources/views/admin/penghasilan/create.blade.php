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
                            {{-- @foreach($drivers as $driver) <option value="{{ $driver->id }}">{{ $driver->user->name }}</option> @endforeach --}}
                            <option value="1">Contoh: Jono</option>
                        </select>
                        @error('driver_id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                     <div class="form-group">
                        <label for="jadwal_id">Jadwal Terkait</label>
                        {{-- PENTING: Anda perlu mengirimkan daftar jadwal dari controller --}}
                        <select class="form-control @error('jadwal_id') is-invalid @enderror" name="jadwal_id">
                            <option value="">Pilih Jadwal</option>
                            {{-- @foreach($jadwals as $jadwal) <option value="{{ $jadwal->id }}">ID: {{ $jadwal->id }} - {{ $jadwal->anak->nama }}</option> @endforeach --}}
                            <option value="1">Contoh: ID: 1 - Rizki Pratama</option>
                        </select>
                        @error('jadwal_id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
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
@endsection

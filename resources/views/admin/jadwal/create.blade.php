@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Tambah Jadwal Antar Jemput')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Formulir Jadwal Baru</h3>
            </div>
            <!-- /.card-header -->
            <form action="{{ route('admin.jadwal.store') }}" method="POST">
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

                    {{-- PENTING: Anda perlu mengirimkan daftar anak ($anakList) dan pengemudi ($driverList) dari controller --}}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="anak_id">Anak</label>
                                <select class="form-control @error('anak_id') is-invalid @enderror" name="anak_id" required>
                                    <option value="">Pilih Anak</option>
                                    @foreach($anakList as $anak) <option value="{{ $anak->id }}" {{ old('anak_id') == $anak->id ? 'selected' : '' }}>{{ $anak->nama }}</option> @endforeach
                                    {{-- <option value="1">Contoh: Rizki Pratama</option> --}}
                                </select>
                                @error('anak_id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                         <div class="col-sm-6">
                            <div class="form-group">
                                <label for="drivers_id">Pengemudi</label>
                                <select class="form-control @error('drivers_id') is-invalid @enderror" name="drivers_id" required>
                                    <option value="">Pilih Pengemudi</option>
                                    @foreach($driverList as $driver) <option value="{{ $driver->id }}" {{ old('drivers_id') == $driver->id ? 'selected' : '' }}>{{ $driver->user->name }}</option> @endforeach
                                    {{-- <option value="1">Contoh: Ahmad Driver</option> --}}
                                </select>
                                @error('drivers_id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                             <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                                @error('tanggal')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                         <div class="col-sm-6">
                             <div class="form-group">
                                <label for="hari">Hari</label>
                                <select class="form-control @error('hari') is-invalid @enderror" name="hari" required>
                                    @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                                        <option value="{{ $hari }}" {{ old('hari') == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                                    @endforeach
                                </select>
                                @error('hari')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-sm-6">
                             <div class="form-group">
                                <label for="jam_jemput">Jam Jemput</label>
                                <input type="time" class="form-control @error('jam_jemput') is-invalid @enderror" name="jam_jemput" value="{{ old('jam_jemput') }}" required>
                                @error('jam_jemput')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                         <div class="col-sm-6">
                             <div class="form-group">
                                <label for="jam_antar">Jam Antar</label>
                                <input type="time" class="form-control @error('jam_antar') is-invalid @enderror" name="jam_antar" value="{{ old('jam_antar') }}" required>
                                @error('jam_antar')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="lokasi_jemput">Lokasi Jemput</label>
                        <textarea class="form-control @error('lokasi_jemput') is-invalid @enderror" rows="2" name="lokasi_jemput" placeholder="Contoh: Sekolah Pelita Harapan">{{ old('lokasi_jemput') }}</textarea>
                        @error('lokasi_jemput')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="lokasi_antar">Lokasi Antar</label>
                        <textarea class="form-control @error('lokasi_antar') is-invalid @enderror" rows="2" name="lokasi_antar" placeholder="Contoh: Jl. Sudirman No. 123">{{ old('lokasi_antar') }}</textarea>
                        @error('lokasi_antar')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="status">Status Awal</label>
                        <select class="form-control @error('status') is-invalid @enderror" name="status" required>
                            @foreach(['menunggu', 'dijemput', 'perjalanan', 'selesai', 'dibatalkan'] as $status)
                                <option value="{{ $status }}" {{ old('status', 'menunggu') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                        @error('status')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="catatan">Catatan (Opsional)</label>
                        <textarea class="form-control @error('catatan') is-invalid @enderror" rows="3" name="catatan" placeholder="Catatan tambahan untuk pengemudi">{{ old('catatan') }}</textarea>
                        @error('catatan')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
                    <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@extends('layouts.app')

@section('content-title', 'Edit Pendaftaran Anak Melalui Mitra')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Data Pendaftaran: {{ $school->name ?? 'N/A' }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.schools.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Form untuk Update Data. Menggunakan metode POST dengan @method('PUT') untuk simulasi PUT/PATCH --}}
                    <form action="{{ route('admin.schools.update', $school->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Input Nama Sekolah --}}
                        <div class="form-group">
                            <label for="name">Nama Sekolah</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $school->name) }}"
                                placeholder="Masukkan Nama Sekolah" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Input Alamat Sekolah --}}
                        <div class="form-group">
                            <label for="address">Alamat Sekolah</label>
                            <textarea name="address" id="address"
                                class="form-control @error('address') is-invalid @enderror"
                                rows="3" placeholder="Masukkan Alamat Sekolah"
                                required>{{ old('address', $school->address) }}</textarea>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Input Nomor Telepon (Asumsi) --}}
                        <div class="form-group">
                            <label for="phone_number">Nomor Telepon</label>
                            {{-- Asumsi kolom phone_number ada di model School --}}
                            <input type="text" name="phone_number" id="phone_number"
                                class="form-control @error('phone_number') is-invalid @enderror"
                                value="{{ old('phone_number', $school->phone_number ?? '') }}"
                                placeholder="Masukkan Nomor Telepon">
                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Input Email Sekolah (Asumsi) --}}
                        <div class="form-group">
                            <label for="email">Email Sekolah</label>
                            {{-- Asumsi kolom email ada di model School --}}
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $school->email ?? '') }}"
                                placeholder="Masukkan Email Sekolah">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Tombol Submit --}}
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>

                    </form>
                </div>
                </div>
            </div>
    </div>
@endsection
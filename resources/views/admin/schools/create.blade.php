@extends('layouts.app')

@section('content-title', 'Buat Pendaftaran Anak Melalui Mitra Baru')

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
                    {{-- Form untuk Menyimpan Data Baru. Menggunakan metode POST ke route store --}}
                    <form action="{{ route('admin.schools.store') }}" method="POST">
                        @csrf

                        {{-- Input Nama Sekolah --}}
                        <div class="form-group">
                            <label for="name">Nama Sekolah</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}"
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
                                required>{{ old('address') }}</textarea>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Input Nomor Telepon (Asumsi) --}}
                        <div class="form-group">
                            <label for="phone_number">Nomor Telepon</label>
                            <input type="text" name="phone_number" id="phone_number"
                                class="form-control @error('phone_number') is-invalid @enderror"
                                value="{{ old('phone_number') }}"
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
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                placeholder="Masukkan Email Sekolah">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        {{-- Tombol Submit --}}
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-paper-plane"></i> Simpan Pendaftaran
                        </button>
                    </form>
                </div>
                </div>
            </div>
    </div>
@endsection
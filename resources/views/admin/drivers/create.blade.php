@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Tambah Data Pengemudi')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Formulir Tambah Pengemudi Baru</h3>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{ route('admin.drivers.store') }}" method="POST">
                @csrf
                <div class="card-body">

                    {{-- Menampilkan error validasi --}}
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

                    {{-- Bagian yang diubah dari dropdown menjadi input biasa --}}
                    <div class="form-group">
                        <label for="user_id">ID Akun Pengguna (User)</label>
                        <input type="number" class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" placeholder="Masukkan ID dari pengguna yang akan dijadikan pengemudi" value="{{ old('user_id') }}">
                        <small class="form-text text-muted">Pastikan ID pengguna yang dimasukkan sudah terdaftar dan memiliki peran 'pengemudi'.</small>
                        @error('user_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nomor_plat">Nomor Plat Kendaraan</label>
                        <input type="text" class="form-control @error('nomor_plat') is-invalid @enderror" id="nomor_plat" name="nomor_plat" placeholder="Contoh: BP 1234 ABC" value="{{ old('nomor_plat') }}">
                        @error('nomor_plat')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="jenis_kendaraan">Jenis Kendaraan</label>
                                <input type="text" class="form-control" id="jenis_kendaraan" name="jenis_kendaraan" placeholder="Contoh: Toyota Avanza" value="{{ old('jenis_kendaraan') }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="warna_kendaraan">Warna Kendaraan</label>
                                <input type="text" class="form-control" id="warna_kendaraan" name="warna_kendaraan" placeholder="Contoh: Hitam" value="{{ old('warna_kendaraan') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.drivers.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection


@extends('layouts.app')

@section('content-title', 'Tambah Data Pengemudi')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Formulir Tambah Pengemudi Baru</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('admin.drivers.store') }}" method="POST">
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

                    <div class="form-group">
                        <label for="user_id">Akun Pengguna (User)</label>
                        {{-- PENTING: Anda perlu mengirimkan daftar user dari controller agar dropdown ini dinamis --}}
                        <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                            <option value="">Pilih Akun Pengguna</option>
                            {{-- Contoh statis, ganti dengan data dinamis dari controller --}}
                            {{-- @foreach($users as $user) --}}
                            {{-- <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option> --}}
                            {{-- @endforeach --}}
                            <option value="1">Contoh: Jono (jono@example.com)</option>
                        </select>
                        @error('user_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nomor_plat">Nomor Plat Kendaraan</label>
                        <input type="text" class="form-control @error('nomor_plat') is-invalid @enderror" id="nomor_plat" name="nomor_plat" placeholder="Contoh: BP 1234 XY" value="{{ old('nomor_plat') }}">
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
                                <input type="text" class="form-control" id="warna_kendaraan" name="warna_kendaraan" placeholder="Contoh: Hitam Metalik" value="{{ old('warna_kendaraan') }}">
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

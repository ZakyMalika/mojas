@extends('layouts.app')

@section('content-title', 'Edit Data Orang Tua')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Formulir Edit Orang Tua: <strong>{{ $item->user->name ?? '' }}</strong></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('admin.orang_tua.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
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
                        {{-- PENTING: Anda perlu mengirimkan daftar user dari controller --}}
                        <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                            <option value="">Pilih Akun Pengguna</option>
                            {{-- Contoh statis, ganti dengan data dinamis --}}
                            {{-- @foreach($users as $user) --}}
                            {{-- <option value="{{ $user->id }}" {{ old('user_id', $item->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option> --}}
                            {{-- @endforeach --}}
                             <option value="{{ $item->user_id }}" selected>{{ $item->user->name ?? 'User tidak ditemukan' }}</option>
                        </select>
                        @error('user_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat Lengkap</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" rows="4" id="alamat" name="alamat" placeholder="Masukkan alamat lengkap">{{ old('alamat', $item->alamat) }}</textarea>
                        @error('alamat')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="catatan">Catatan (Opsional)</label>
                        <textarea class="form-control" rows="3" id="catatan" name="catatan" placeholder="Catatan tambahan">{{ old('catatan', $item->catatan) }}</textarea>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                    <a href="{{ route('admin.orang_tua.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

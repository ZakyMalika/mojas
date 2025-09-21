@extends('layouts.app')

@section('content-title', 'Edit Jadwal Antar Jemput')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-warning">
            <div class="card-header"><h3 class="card-title">Formulir Edit Jadwal</h3></div>
            <form action="{{ route('admin.jadwal.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h6><i class="icon fas fa-ban"></i><strong> Oops! Ada kesalahan.</strong></h6>
                            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="anak_id">Anak</label>
                                {{-- PENTING: Anda perlu mengirimkan daftar anak dari controller --}}
                                <select class="form-control @error('anak_id') is-invalid @enderror" id="anak_id" name="anak_id">
                                    {{-- @foreach($anaks as $anak) <option value="{{ $anak->id }}" {{ old('anak_id', $item->anak_id) == $anak->id ? 'selected' : '' }}>{{ $anak->nama }}</option> @endforeach --}}
                                    <option value="{{ $item->anak_id }}" selected>{{ $item->anak->nama ?? 'Anak tidak ditemukan' }}</option>
                                </select>
                                @error('anak_id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="drivers_id">Pengemudi</label>
                                <select class="form-control @error('drivers_id') is-invalid @enderror" id="drivers_id" name="drivers_id">
                                    {{-- @foreach($drivers as $driver) <option value="{{ $driver->id }}" {{ old('drivers_id', $item->drivers_id) == $driver->id ? 'selected' : '' }}>{{ $driver->user->name }}</option> @endforeach --}}
                                    <option value="{{ $item->drivers_id }}" selected>{{ $item->driver->user->name ?? 'Driver tidak ditemukan' }}</option>
                                </select>
                                 @error('drivers_id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                    </div>
                     <div class="row">
                         <div class="col-sm-6">
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $item->tanggal) }}">
                                @error('tanggal')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                         <div class="col-sm-6">
                            <div class="form-group">
                                <label for="hari">Hari</label>
                                <select class="form-control @error('hari') is-invalid @enderror" id="hari" name="hari">
                                    @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                                        <option value="{{ $day }}" {{ old('hari', $item->hari) == $day ? 'selected' : '' }}>{{ $day }}</option>
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
                                <input type="time" class="form-control @error('jam_jemput') is-invalid @enderror" id="jam_jemput" name="jam_jemput" value="{{ old('jam_jemput', \Carbon\Carbon::parse($item->jam_jemput)->format('H:i')) }}">
                                @error('jam_jemput')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                         <div class="col-sm-6">
                           <div class="form-group">
                                <label for="jam_antar">Jam Antar</label>
                                <input type="time" class="form-control @error('jam_antar') is-invalid @enderror" id="jam_antar" name="jam_antar" value="{{ old('jam_antar', \Carbon\Carbon::parse($item->jam_antar)->format('H:i')) }}">
                                @error('jam_antar')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                            @foreach(['menunggu', 'dijemput', 'perjalanan', 'selesai', 'dibatalkan'] as $s)
                                <option value="{{ $s }}" {{ old('status', $item->status) == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                        @error('status')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                    <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

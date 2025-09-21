@extends('layouts.app')

@section('content-title', 'Tambah Log Jadwal')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-primary">
            <div class="card-header"><h3 class="card-title">Formulir Tambah Log Baru</h3></div>
            <form action="{{ route('admin.log-jadwal.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h6><i class="icon fas fa-ban"></i><strong> Oops! Ada kesalahan.</strong></h6>
                            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="jadwal_id">Jadwal Terkait</label>
                        {{-- PENTING: Anda perlu mengirimkan daftar jadwal dari controller --}}
                        <select class="form-control @error('jadwal_id') is-invalid @enderror" id="jadwal_id" name="jadwal_id">
                            <option value="">Pilih Jadwal</option>
                            {{-- @foreach($jadwals as $jadwal) <option value="{{ $jadwal->id }}">ID:{{ $jadwal->id }} - {{ $jadwal->anak->nama }}</option> @endforeach --}}
                            <option value="1">Contoh: ID:1 - Rizki Pratama</option>
                        </select>
                        @error('jadwal_id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="driver_id">Pengemudi</label>
                         {{-- PENTING: Anda perlu mengirimkan daftar driver dari controller --}}
                        <select class="form-control @error('driver_id') is-invalid @enderror" id="driver_id" name="driver_id">
                            <option value="">Pilih Pengemudi</option>
                            {{-- @foreach($drivers as $driver) <option value="{{ $driver->id }}">{{ $driver->user->name }}</option> @endforeach --}}
                            <option value="1">Contoh: Jono</option>
                        </select>
                        @error('driver_id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="status_lama">Status Lama</label>
                                <select class="form-control @error('status_lama') is-invalid @enderror" name="status_lama">
                                    @foreach(['menunggu', 'dijemput', 'diantar', 'selesai', 'batal'] as $status)
                                        <option value="{{ $status }}" {{ old('status_lama') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                                @error('status_lama')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="status_baru">Status Baru</label>
                                <select class="form-control @error('status_baru') is-invalid @enderror" name="status_baru">
                                    @foreach(['menunggu', 'dijemput', 'diantar', 'selesai', 'batal'] as $status)
                                        <option value="{{ $status }}" {{ old('status_baru') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                                @error('status_baru')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                    </div>

                     <div class="form-group">
                        <label for="keterangan">Keterangan (Opsional)</label>
                        <textarea class="form-control" rows="3" name="keterangan" placeholder="Contoh: Pengemudi mengubah status menjadi dijemput">{{ old('keterangan') }}</textarea>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.log-jadwal.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

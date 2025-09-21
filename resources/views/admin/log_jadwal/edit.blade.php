@extends('layouts.app')

@section('content-title', 'Edit Log Jadwal')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-warning">
            <div class="card-header"><h3 class="card-title">Formulir Edit Log ID: {{ $item->id }}</h3></div>
            <form action="{{ route('admin.log-jadwal.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h6><i class="icon fas fa-ban"></i><strong> Oops! Ada kesalahan.</strong></h6>
                            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="jadwal_id">Jadwal Terkait</label>
                        <select class="form-control @error('jadwal_id') is-invalid @enderror" id="jadwal_id" name="jadwal_id">
                           <option value="{{ $item->jadwal_id }}" selected>ID:{{ $item->jadwal_id }} - {{ $item->jadwal->anak->nama ?? 'Jadwal tidak ditemukan' }}</option>
                        </select>
                        @error('jadwal_id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="driver_id">Pengemudi</label>
                        <select class="form-control @error('driver_id') is-invalid @enderror" id="driver_id" name="driver_id">
                           <option value="{{ $item->driver_id }}" selected>{{ $item->driver->user->name ?? 'Driver tidak ditemukan' }}</option>
                        </select>
                        @error('driver_id')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="status_lama">Status Lama</label>
                                <select class="form-control @error('status_lama') is-invalid @enderror" name="status_lama">
                                    @foreach(['menunggu', 'dijemput', 'diantar', 'selesai', 'batal'] as $status)
                                        <option value="{{ $status }}" {{ old('status_lama', $item->status_lama) == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
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
                                        <option value="{{ $status }}" {{ old('status_baru', $item->status_baru) == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                                @error('status_baru')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                    </div>

                     <div class="form-group">
                        <label for="keterangan">Keterangan (Opsional)</label>
                        <textarea class="form-control" rows="3" name="keterangan">{{ old('keterangan', $item->keterangan) }}</textarea>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                    <a href="{{ route('admin.log-jadwal.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

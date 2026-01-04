@extends('layouts.app')

@section('content-title', 'Edit Jadwal')

@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Edit Jadwal: <strong>{{ $item->anak->nama ?? 'Jadwal' }}</strong></h3>
            </div>
            
            <form action="{{ route('driver.jadwal.update', $item->id) }}" method="POST">
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
                        <label>Anak</label>
                        <select name="anak_id" class="form-control" required>
                            <option value="">Pilih Anak</option>
                            @foreach($anaks as $anak)
                                <option value="{{ $anak->id }}" {{ $item->anak_id == $anak->id ? 'selected' : '' }}>{{ $anak->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" value="{{ $item->tanggal }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                             <div class="form-group">
                                <label>Hari</label>
                                <select name="hari" class="form-control" required>
                                    @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                                        <option value="{{ $hari }}" {{ $item->hari == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jam Jemput</label>
                                <input type="time" name="jam_jemput" class="form-control" value="{{ \Carbon\Carbon::parse($item->jam_jemput)->format('H:i') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jam Antar</label>
                                <input type="time" name="jam_antar" class="form-control" value="{{ \Carbon\Carbon::parse($item->jam_antar)->format('H:i') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Lokasi Jemput</label>
                        <input type="text" name="lokasi_jemput" class="form-control" value="{{ $item->lokasi_jemput }}">
                    </div>

                    <div class="form-group">
                        <label>Lokasi Antar</label>
                        <input type="text" name="lokasi_antar" class="form-control" value="{{ $item->lokasi_antar }}">
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="menunggu" {{ $item->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="dijemput" {{ $item->status == 'dijemput' ? 'selected' : '' }}>Dijemput</option>
                            <option value="perjalanan" {{ $item->status == 'perjalanan' ? 'selected' : '' }}>Perjalanan</option>
                            <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="dibatalkan" {{ $item->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea name="catatan" class="form-control" rows="3">{{ $item->catatan }}</textarea>
                    </div>

                    {{-- Hidden field for diambil_pengemudi if needed, generally kept separate logic --}}

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Update Jadwal</button>
                    <a href="{{ route('driver.jadwal.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

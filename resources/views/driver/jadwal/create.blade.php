@extends('layouts.app')

@section('content-title', 'Buat Jadwal Antar Jemput')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Jadwal Baru</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('driver.jadwal.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label>Anak</label>
                        <select name="anak_id" class="form-control" required>
                            <option value="">Pilih Anak</option>
                            @foreach($anaks as $anak)
                                <option value="{{ $anak->id }}">{{ $anak->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                             <div class="form-group">
                                <label>Hari</label>
                                <select name="hari" class="form-control" required>
                                    <option value="">Pilih Hari</option>
                                    @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                                        <option value="{{ $hari }}">{{ $hari }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jam Jemput</label>
                                <input type="time" name="jam_jemput" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jam Antar</label>
                                <input type="time" name="jam_antar" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Lokasi Jemput</label>
                        <input type="text" name="lokasi_jemput" class="form-control" placeholder="Contoh: Rumah">
                    </div>

                    <div class="form-group">
                        <label>Lokasi Antar</label>
                        <input type="text" name="lokasi_antar" class="form-control" placeholder="Contoh: Sekolah">
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="menunggu">Menunggu</option>
                            <option value="dijemput">Dijemput</option>
                            <option value="perjalanan">Perjalanan</option>
                            <option value="selesai">Selesai</option>
                            <option value="dibatalkan">Dibatalkan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea name="catatan" class="form-control" rows="3"></textarea>
                    </div>

                    {{-- Diambil Pengemudi usually auto-filled or manual? Left optional --}}
                    {{-- <div class="form-group">
                        <label>Diambil Pengemudi (Tanggal)</label> --}}
                        <input type="hidden" name="diambil_pengemudi" class="form-control">
                    {{-- </div> --}}

                    <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
                    <a href="{{ route('driver.jadwal.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

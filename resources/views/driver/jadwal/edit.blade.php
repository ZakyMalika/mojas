@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Update Status Jadwal')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Update Status untuk: <strong>{{ $item->anak->nama ?? 'Jadwal' }}</strong></h3>
            </div>
            <!-- /.card-header -->
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

                    {{-- Menampilkan detail jadwal sebagai read-only --}}
                    <h5>Detail Jadwal</h5>
                    <dl class="row mb-4">
                        <dt class="col-sm-4">Anak</dt>
                        <dd class="col-sm-8">{{ $item->anak->nama ?? 'N/A' }}</dd>

                        <dt class="col-sm-4">Hari, Tanggal</dt>
                        <dd class="col-sm-8">{{ $item->hari }}, {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</dd>

                        <dt class="col-sm-4">Jam Jemput / Antar</dt>
                        <dd class="col-sm-8">{{ \Carbon\Carbon::parse($item->jam_jemput)->format('H:i') }} / {{ \Carbon\Carbon::parse($item->jam_antar)->format('H:i') }}</dd>
                        
                        <dt class="col-sm-4">Lokasi Jemput</dt>
                        <dd class="col-sm-8">{{ $item->lokasi_jemput ?? $item->anak->sekolah ?? 'N/A' }}</dd>

                        <dt class="col-sm-4">Lokasi Antar</dt>
                        <dd class="col-sm-8">{{ $item->lokasi_antar ?? $item->anak->alamat_penjemputan ?? 'N/A' }}</dd>
                    </dl>

                    {{-- Bagian yang bisa di-edit --}}
                    <hr>
                    <div class="form-group">
                        <label for="status">Update Status Perjalanan</label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                            {{-- Driver hanya bisa mengubah ke status berikutnya --}}
                            <option value="dijemput" {{ old('status', $item->status) == 'dijemput' ? 'selected' : '' }}>Sudah Dijemput</option>
                            <option value="perjalanan" {{ old('status', $item->status) == 'perjalanan' ? 'selected' : '' }}>Dalam Perjalanan</option>
                            <option value="selesai" {{ old('status', $item->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="dibatalkan" {{ old('status', $item->status) == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="catatan">Catatan (Opsional)</label>
                        <textarea class="form-control" rows="3" id="catatan" name="catatan" placeholder="Tambahkan catatan jika ada kendala atau informasi penting lainnya">{{ old('catatan', $item->catatan) }}</textarea>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Update Status</button>
                    <a href="{{ route('driver.jadwal.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection


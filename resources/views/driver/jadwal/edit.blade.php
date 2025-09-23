@extends('layouts.app')

@section('content-title', 'Update Status Jadwal')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Update Status untuk: <strong>{{ $item->anak->nama ?? 'N/A' }}</strong></h3>
            </div>
            <!-- /.card-header -->
            {{-- Form ini akan mengirim data ke method 'update' di controller jadwal driver --}}
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

                    {{-- Menampilkan detail jadwal yang tidak bisa diubah --}}
                    <h5>Detail Jadwal</h5>
                    <dl class="row bg-light p-3 rounded mb-4">
                        <dt class="col-sm-4">Nama Anak</dt>
                        <dd class="col-sm-8">{{ $item->anak->nama ?? 'N/A' }}</dd>

                        <dt class="col-sm-4">Hari & Tanggal</dt>
                        <dd class="col-sm-8">{{ $item->hari }}, {{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</dd>

                        <dt class="col-sm-4">Jam Jemput</dt>
                        <dd class="col-sm-8">{{ \Carbon\Carbon::parse($item->jam_jemput)->format('H:i') }} WIB</dd>

                        <dt class="col-sm-4">Jam Antar</dt>
                        <dd class="col-sm-8">{{ \Carbon\Carbon::parse($item->jam_antar)->format('H:i') }} WIB</dd>
                    </dl>
                    <hr>

                    {{-- Form untuk update status --}}
                    <h5>Update Status</h5>
                    <div class="form-group">
                        <label for="status">Ubah Status Perjalanan</label>
                        <select class="form-control form-control-lg @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="menunggu" {{ old('status', $item->status) == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="dijemput" {{ old('status', $item->status) == 'dijemput' ? 'selected' : '' }}>Sudah Dijemput</option>
                            <option value="perjalanan" {{ old('status', 'perjalanan') == 'perjalanan' ? 'selected' : '' }}>Dalam Perjalanan</option>
                            <option value="selesai" {{ old('status', $item->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="dibatalkan" {{ old('status', $item->status) == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan (Opsional)</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" rows="3" placeholder="Contoh: Anak dijemput sedikit lebih awal karena ada kegiatan tambahan.">{{ old('keterangan', $item->keterangan) }}</textarea>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Update Status</button>
                    <a href="{{ route('driver.jadwal.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection


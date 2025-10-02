@extends('layouts.app')

@section('content-title', 'Tambah Data Anak')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Formulir Tambah Data Anak</h3>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{ route('admin.anak.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Oops!</strong> Ada kesalahan validasi.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>- {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="orang_tua_id">Orang Tua</label>
                        <select class="form-control" id="orang_tua_id" name="orang_tua_id">
                            <option value="orang_tua_id">-- Pilih Orang Tua --</option>
                            @foreach ($orang_tua as $ortu)
                                <option value="{{ $ortu->id }}" {{ old('orang_tua_id') == $ortu->id ? 'selected' : '' }}>
                                    {{ $ortu->user->name ?? '-' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Anak</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap anak">
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="umur">Umur</label>
                                <input type="number" class="form-control" id="umur" name="umur" value="{{ old('umur') }}" placeholder="Contoh: 5">
                            </div>
                        </div>
                        {{-- <div class="col-sm-6">
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="">-- Pilih --</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                        </div> --}}
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="sekolah">Sekolah</label>
                                <input type="text" class="form-control" id="sekolah" name="sekolah" value="{{ old('sekolah') }}" placeholder="Contoh: TK Pelita Harapan">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <input type="text" class="form-control" id="kelas" name="kelas" value="{{ old('kelas') }}" placeholder="Contoh: A1">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="alamat_penjemputan">Alamat Penjemputan</label>
                        <textarea class="form-control" rows="3" id="alamat_penjemputan" name="alamat_penjemputan" placeholder="Alamat lengkap penjemputan">{{ old('alamat_penjemputan') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <textarea class="form-control" rows="3" id="catatan" name="catatan" placeholder="Catatan tambahan (opsional)">{{ old('catatan') }}</textarea>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a href="{{ route('admin.anak.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

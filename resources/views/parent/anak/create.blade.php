@extends('layouts.app')

@section('content-title', 'Tambah Data Anak')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Formulir Pendaftaran Anak</h3>
            </div>
            <!-- /.card-header -->
            <form action="{{ route('parent.anak.store') }}" method="POST">
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
                        <label for="nama">Nama Lengkap Anak</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukkan nama lengkap anak" value="{{ old('nama') }}" required>
                        @error('nama')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="umur">Umur (Tahun)</label>
                                <input type="number" class="form-control @error('umur') is-invalid @enderror" id="umur" name="umur" placeholder="Contoh: 5" value="{{ old('umur') }}">
                                @error('umur')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                             <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="sekolah">Sekolah</label>
                                <input type="text" class="form-control" id="sekolah" name="sekolah" placeholder="Contoh: TK Pelita Harapan" value="{{ old('sekolah') }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Contoh: A1" value="{{ old('kelas') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="alamat_penjemputan">Alamat Rumah (Untuk Pengantaran)</label>
                        <textarea class="form-control" rows="3" id="alamat_penjemputan" name="alamat_penjemputan" placeholder="Masukkan alamat lengkap rumah">{{ old('alamat_penjemputan') }}</textarea>
                    </div>

                     <div class="form-group">
                        <label for="catatan">Catatan (Opsional)</label>
                        <textarea class="form-control" rows="3" id="catatan" name="catatan" placeholder="Catatan tambahan seperti alergi, dll.">{{ old('catatan') }}</textarea>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('parent.anak.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

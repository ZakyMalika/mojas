@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Tambah Data Anak')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Formulir Tambah Anak Baru</h3>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{ route('admin.anak.store') }}" method="POST">
                @csrf
                <div class="card-body">

                    {{-- Menampilkan error validasi --}}
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
                        <label for="orang_tua_id">Orang Tua</label>
                        {{-- PENTING: Anda perlu mengirimkan daftar orang tua dari controller --}}
                        <select class="form-control @error('orang_tua_id') is-invalid @enderror" id="orang_tua_id" name="orang_tua_id">
                            <option value="">Pilih Orang Tua</option>
                            {{-- @foreach($orangTuaList as $ortu) --}}
                            {{-- <option value="{{ $ortu->id }}" {{ old('orang_tua_id') == $ortu->id ? 'selected' : '' }}>{{ $ortu->nama }}</option> --}}
                            {{-- @endforeach --}}
                            <option value="1">Contoh: Budi</option> {{-- Hapus ini jika sudah dinamis --}}
                        </select>
                        @error('orang_tua_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Anak</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukkan nama lengkap anak" value="{{ old('nama') }}">
                        @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="umur">Umur (Tahun)</label>
                                <input type="number" class="form-control @error('umur') is-invalid @enderror" id="umur" name="umur" placeholder="Contoh: 5" value="{{ old('umur') }}">
                                @error('umur')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">  
                             <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                        <label for="alamat_penjemputan">Alamat Penjemputan</label>
                        <textarea class="form-control" rows="3" id="alamat_penjemputan" name="alamat_penjemputan" placeholder="Masukkan alamat lengkap penjemputan">{{ old('alamat_penjemputan') }}</textarea>
                    </div>

                     <div class="form-group">
                        <label for="catatan">Catatan (Opsional)</label>
                        <textarea class="form-control" rows="3" id="catatan" name="catatan" placeholder="Catatan tambahan seperti alergi, dll.">{{ old('catatan') }}</textarea>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.anak.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

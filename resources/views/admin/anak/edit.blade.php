@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Edit Data Anak')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Formulir Edit Data: <strong>{{ $item->nama }}</strong></h3>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{ route('admin.anak.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Method spoofing untuk update --}}
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

                    <<div class="form-group">
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
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukkan nama lengkap anak" value="{{ old('nama', $item->nama) }}">
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
                                <input type="number" class="form-control @error('umur') is-invalid @enderror" id="umur" name="umur" placeholder="Contoh: 5" value="{{ old('umur', $item->umur) }}">
                                 @error('umur')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="col-sm-6">  
                             <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin', $item->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin', $item->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="sekolah">Sekolah</label>
                                <input type="text" class="form-control" id="sekolah" name="sekolah" placeholder="Contoh: TK Pelita Harapan" value="{{ old('sekolah', $item->sekolah) }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Contoh: A1" value="{{ old('kelas', $item->kelas) }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="alamat_penjemputan">Alamat Penjemputan</label>
                        <textarea class="form-control" rows="3" id="alamat_penjemputan" name="alamat_penjemputan" placeholder="Masukkan alamat lengkap penjemputan">{{ old('alamat_penjemputan', $item->alamat_penjemputan) }}</textarea>
                    </div>

                     <div class="form-group">
                        <label for="catatan">Catatan (Opsional)</label>
                        <textarea class="form-control" rows="3" id="catatan" name="catatan" placeholder="Catatan tambahan seperti alergi, dll.">{{ old('catatan', $item->catatan) }}</textarea>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Update Data</button>
                    <a href="{{ route('admin.anak.show', $item->id) }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection


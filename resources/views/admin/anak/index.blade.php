@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Manajemen Data Anak')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Semua Anak</h3>
                <!-- Removed Add Button -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Oops! Ada kesalahan validasi.</strong> Silakan periksa kembali data di formulir.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <table id="anak-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Anak</th>
                            <th>Orang Tua</th>
                            <th>Sekolah</th>
                            <th>Kelas</th>
                            <th>Jadwal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->orangTua->user->name ?? 'N/A' }}</td>
                                <td>{{ $item->sekolah ?? '-' }}</td>
                                <td>{{ $item->kelas ?? '-' }}</td>
                                <td>
                                    @if($item->jadwal_antar_jemput && $item->jadwal_antar_jemput->count() > 0)
                                        
                                        <br><p class="text-muted">{{ $item->jadwal_antar_jemput->first()->jam_jemput ?? '' }}</p>
                                    @else
                                        <span class="text-muted">Belum ada jadwal</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">Tidak ada data anak yang tersedia.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection




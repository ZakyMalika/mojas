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

                <!-- Search Form -->
                <div class="mb-3">
                    <form action="{{ route('admin.anak.index') }}" method="GET" class="form-inline justify-content-end">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari anak..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                @if($items->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
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
                                @foreach ($items as $key => $item)
                                    <tr>
                                        <td>{{ $items->firstItem() + $key }}</td>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted">
                            Menampilkan {{ $items->firstItem() }} sampai {{ $items->lastItem() }} 
                            dari {{ $items->total() }} total data
                        </div>
                        <div>
                            {{ $items->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-child fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Tidak ada data anak yang tersedia.</h5>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection




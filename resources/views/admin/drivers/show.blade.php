@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Manajemen Data Pengemudi')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Semua Pengemudi</h3>
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

                <table id="drivers-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Nomor Plat</th>
                            <th>Warna Kendaraan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href="{{ route('admin.drivers.show', $item->id) }}">{{ $item->user->name ?? 'N/A' }}</a>
                                </td>
                                <td>{{ $item->user->email ?? 'N/A' }}</td>
                                <td><span class="badge bg-secondary">{{ $item->nomor_plat ?? 'N/A' }}</span></td>
                                <td>{{ $item->warna_kendaraan ?? '-' }}</td>
                                 <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.drivers.edit', $item) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">Tidak ada data pengemudi yang tersedia.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

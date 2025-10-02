@extends('layouts.app')
@section('content-title', 'Manajemen Mitra')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Mitra</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.schools.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Buat Pendaftaran
                        </a>
                    </div>
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

                    <table id="schools-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Sekolah</th>
                                <th>Alamat Sekolah</th>
                                <th>Tarif Kemitraan</th>
                                <th style="width: 20%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($schools as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name ?? 'N/A' }}</td>
                                    <td>{{ Str::limit($item->address, 50) ?? 'N/A' }}</td>
                                    <td>
                                        @if ($item->type == 'sekolah' && $item->partnership_rate)
                                            Rp{{ number_format($item->partnership_rate, 0, ',', '.') }}/bulan
                                        @elseif ($item->type == 'umum' && $item->general_rate)
                                            Rp{{ number_format($item->general_rate, 0, ',', '.') }}/hari
                                        @else
                                            N/A
                                        @endif
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.schools.show', $item->id) }}"
                                                class="btn btn-info btn-sm" title="Detail"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('admin.schools.edit', $item->id) }}"
                                                class="btn btn-warning btn-sm" title="Edit"><i
                                                    class="fas fa-edit"></i></a>
                                            <form action="{{ route('admin.schools.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus pendaftaran ini?');"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data pendaftaran</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

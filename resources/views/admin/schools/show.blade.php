@extends('layouts.app')

@section('content-title', 'Detail Mitra')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Pendaftaran: {{ $school->name ?? 'N/A' }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.schools.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                        </a>
                        <a href="{{ route('admin.schools.edit', $school->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit Data
                        </a>
                        {{-- Form untuk Hapus --}}
                        <form action="{{ route('admin.schools.destroy', $school->id) }}" method="POST"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus pendaftaran ini?');"
                              style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width: 20%;">ID Pendaftaran</th>
                                        <td>{{ $school->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Sekolah</th>
                                        <td>{{ $school->name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat Sekolah</th>
                                        <td>{{ $school->address ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Telepon</th>
                                        {{-- Asumsi ada kolom phone_number di tabel schools --}}
                                        <td>{{ $school->phone_number ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email Sekolah</th>
                                        {{-- Asumsi ada kolom email di tabel schools --}}
                                        <td>{{ $school->email ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Dibuat</th>
                                        <td>{{ $school->created_at ? $school->created_at->format('d M Y H:i:s') : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Terakhir Diperbarui</th>
                                        <td>{{ $school->updated_at ? $school->updated_at->format('d M Y H:i:s') : 'N/A' }}</td>
                                    </tr>
                                    {{-- Anda bisa menambahkan detail lain yang relevan di sini --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
            </div>
    </div>
@endsection

@push('scripts')
    {{-- Tambahkan skrip khusus jika ada, misalnya untuk konfirmasi hapus kustom --}}
@endpush
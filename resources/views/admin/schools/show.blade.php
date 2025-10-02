@extends('layouts.app')

@section('content-title', 'Detail Mitra')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Mitra: **{{ $school->name ?? 'N/A' }}**</h3>
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
                                        <th style="width: 25%;">ID Mitra</th>
                                        <td>{{ $school->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Mitra</th>
                                        <td>{{ $school->name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tipe Mitra</th>
                                        <td>
                                            @if ($school->type == 'sekolah')
                                                <span class="badge badge-primary">Sekolah</span>
                                            @elseif ($school->type == 'umum')
                                                <span class="badge badge-info">Umum</span>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>{{ $school->address ?? 'N/A' }}</td>
                                    </tr>
                                    
                                    {{-- Data Kemitraan --}}
                                    <tr>
                                        <th>Status Kemitraan</th>
                                        <td>
                                            @if ($school->has_partnership)
                                                <span class="badge badge-success">Ya (Aktif)</span>
                                            @else
                                                <span class="badge badge-danger">Tidak</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($school->has_partnership)
                                    <tr>
                                        <th>Tarif Kemitraan (Bulan)</th>
                                        <td>{{ $school->partnership_rate !== null ? 'Rp ' . number_format($school->partnership_rate, 0, ',', '.') : 'Tidak Ditetapkan' }}</td>
                                    </tr>
                                    @endif

                                    {{-- Data Harga Perjalanan --}}
                                    <tr class="table-info">
                                        <th colspan="2" class="text-center">Informasi Tarif Perjalanan</th>
                                    </tr>
                                    <tr>
                                        <th>Tarif Umum Perjalanan (Per KM)</th>
                                        <td>**Rp {{ number_format($school->general_rate, 0, ',', '.') }}** (Wajib)</td>
                                    </tr>
                                    <tr>
                                        <th>Harga Dasar Satu Arah (Bulan)</th>
                                        <td>{{ $school->one_way_price !== null ? 'Rp ' . number_format($school->one_way_price, 0, ',', '.') : 'Tidak Ditetapkan' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Harga Dasar Dua Arah (Bulan)</th>
                                        <td>{{ $school->two_way_price !== null ? 'Rp ' . number_format($school->two_way_price, 0, ',', '.') : 'Tidak Ditetapkan' }}</td>
                                    </tr>

                                    {{-- Data Kontak (dipertahankan dari template lama) --}}
                                    <tr>
                                        <th>Nomor Telepon</th>
                                        <td>{{ $school->phone_number ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $school->email ?? 'N/A' }}</td>
                                    </tr>

                                    {{-- Status Aktif --}}
                                    <tr>
                                        <th>Status Aktif Sistem</th>
                                        <td>
                                            @if ($school->is_active)
                                                <span class="badge badge-success">Aktif</span>
                                            @else
                                                <span class="badge badge-danger">Nonaktif</span>
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- Timestamp --}}
                                    <tr>
                                        <th>Tanggal Dibuat</th>
                                        <td>{{ $school->created_at ? $school->created_at->format('d M Y H:i:s') : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Terakhir Diperbarui</th>
                                        <td>{{ $school->updated_at ? $school->updated_at->format('d M Y H:i:s') : 'N/A' }}</td>
                                    </tr>
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
    {{-- Tambahkan skrip khusus jika ada --}}
@endpush
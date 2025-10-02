@extends('layouts.app')

@section('content-title', 'Profil Saya')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Profil: <strong>{{ $user->name }}</strong></h3>
                <div class="card-tools">
                    <a href="{{ route('profile.edit') }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit Profil
                    </a>
                </div>
            </div>
            <div class="card-body">
                <h4>Informasi Dasar</h4>
                <dl class="row">
                    <dt class="col-sm-4">Nama Lengkap</dt>
                    <dd class="col-sm-8">{{ $user->name }}</dd>

                    <dt class="col-sm-4">Username</dt>
                    <dd class="col-sm-8">{{ $user->username }}</dd>

                    <dt class="col-sm-4">Email</dt>
                    <dd class="col-sm-8">{{ $user->email }}</dd>

                    <dt class="col-sm-4">No. Telepon</dt>
                    <dd class="col-sm-8">{{ $user->no_telp }}</dd>

                    <dt class="col-sm-4">Role</dt>
                    <dd class="col-sm-8">
                        @php
                            $roleClass = 'secondary';
                            $roleText = ucfirst($user->role);
                            if ($user->role == 'admin') {
                                $roleClass = 'danger';
                                $roleText = 'Admin';
                            } elseif ($user->role == 'pengemudi') {
                                $roleClass = 'warning';
                                $roleText = 'Pengemudi';
                            } elseif ($user->role == 'orang_tua') {
                                $roleClass = 'info';
                                $roleText = 'Orang Tua';
                            }
                        @endphp
                        <span class="badge bg-{{ $roleClass }}">{{ $roleText }}</span>
                    </dd>

                    <dt class="col-sm-4">Bergabung Sejak</dt>
                    <dd class="col-sm-8">{{ $user->created_at->format('d F Y') }}</dd>
                </dl>

                @if($user->role == 'pengemudi' && $user->driver)
                    <hr>
                    <h4>Informasi Driver</h4>
                    <dl class="row">
                        <dt class="col-sm-4">Nomor Plat</dt>
                        <dd class="col-sm-8">
                            {{ $user->driver->nomor_plat ?: 'Belum diisi' }}
                        </dd>

                        <dt class="col-sm-4">Status Driver</dt>
                        <dd class="col-sm-8">
                            <span class="badge bg-success">Aktif</span>
                        </dd>

                        <dt class="col-sm-4">Total Jadwal</dt>
                        <dd class="col-sm-8">
                            @php
                                $jadwalCount = $user->driver->jadwal_antar_jemput()->count();
                            @endphp
                            {{ $jadwalCount }} jadwal
                        </dd>
                    </dl>
                @endif

                @if($user->role == 'orang_tua' && $user->orangTua)
                    <hr>
                    <h4>Informasi Orang Tua</h4>
                    <dl class="row">
                        <dt class="col-sm-4">Alamat</dt>
                        <dd class="col-sm-8">{{ $user->orangTua->alamat ?: 'Belum diisi' }}</dd>

                        <dt class="col-sm-4">Catatan</dt>
                        <dd class="col-sm-8">{{ $user->orangTua->catatan ?: 'Tidak ada catatan' }}</dd>

                        <dt class="col-sm-4">Jumlah Anak</dt>
                        <dd class="col-sm-8">
                            @php
                                $anakCount = $user->orangTua->anak()->count();
                            @endphp
                            {{ $anakCount }} anak
                        </dd>
                    </dl>

                    @if($user->orangTua->anak && $user->orangTua->anak->count() > 0)
                        <h5>Daftar Anak</h5>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Anak</th>
                                        <th>Umur</th>
                                        <th>Alamat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->orangTua->anak as $anak)
                                        <tr>
                                            <td>{{ $anak->nama }}</td>
                                            <td>{{ $anak->umur }} tahun</td>
                                            <td>{{ $anak->alamat }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                @endif

                @if($user->role == 'admin')
                    <hr>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <strong>Info:</strong> Anda memiliki akses administrator penuh ke sistem.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
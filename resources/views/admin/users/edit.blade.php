@extends('layouts.app')

@section('content-title', 'Edit Pengguna')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Form Edit Pengguna: <strong>{{ $user->name }}</strong></h3>
                <div class="card-tools">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i> Lihat Detail
                    </a>
                </div>
            </div>
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $user->name) }}" 
                                       placeholder="Masukkan nama lengkap"
                                       required>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Username <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('username') is-invalid @enderror" 
                                       id="username" 
                                       name="username" 
                                       value="{{ old('username', $user->username) }}" 
                                       placeholder="Masukkan username"
                                       required>
                                @error('username')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', $user->email) }}" 
                                       placeholder="Masukkan email"
                                       required>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_telp">No. Telepon <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('no_telp') is-invalid @enderror" 
                                       id="no_telp" 
                                       name="no_telp" 
                                       value="{{ old('no_telp', $user->no_telp) }}" 
                                       placeholder="Contoh: 081234567890"
                                       required>
                                @error('no_telp')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role">Role <span class="text-danger">*</span></label>
                                <select class="form-control @error('role') is-invalid @enderror" 
                                        id="role" 
                                        name="role" 
                                        required>
                                    <option value="">Pilih Role</option>
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="pengemudi" {{ old('role', $user->role) == 'pengemudi' ? 'selected' : '' }}>Pengemudi</option>
                                    <option value="orang_tua" {{ old('role', $user->role) == 'orang_tua' ? 'selected' : '' }}>Orang Tua</option>
                                </select>
                                @error('role')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">
                                    Role saat ini: <strong>{{ ucfirst($user->role) }}</strong>
                                </small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password Baru</label>
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       placeholder="Kosongkan jika tidak ingin mengubah password">
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">
                                    Kosongkan jika tidak ingin mengubah password
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Peringatan!</strong>
                        <ul class="mb-0 mt-2">
                            <li>Mengubah role dapat mempengaruhi akses pengguna ke sistem</li>
                            <li>Jika mengubah dari <strong>pengemudi</strong> ke role lain, data driver akan tetap ada</li>
                            <li>Jika mengubah dari <strong>orang_tua</strong> ke role lain, data orang tua akan tetap ada</li>
                            <li>Password akan tetap sama jika field password dikosongkan</li>
                        </ul>
                    </div>

                    @if($user->role == 'pengemudi' && $user->driver)
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            <strong>Info Driver:</strong> User ini memiliki profil driver aktif
                            (Plat: {{ $user->driver->nomor_plat }})
                        </div>
                    @endif

                    @if($user->role == 'orang_tua' && $user->orangTua)
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            <strong>Info Orang Tua:</strong> User ini memiliki profil orang tua aktif
                            ({{ $user->orangTua->anak->count() }} anak terdaftar)
                        </div>
                    @endif
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-info">
                        <i class="fas fa-eye"></i> Lihat Detail
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Show role-specific information
    $('#role').on('change', function() {
        let role = $(this).val();
        let currentRole = '{{ $user->role }}';
        let infoText = '';
        
        if (role !== currentRole) {
            if (role === 'admin') {
                infoText = 'Mengubah ke Admin: User akan mendapat akses penuh ke semua fitur sistem.';
            } else if (role === 'pengemudi') {
                infoText = 'Mengubah ke Pengemudi: Jika belum ada, profil driver akan dibuat otomatis.';
            } else if (role === 'orang_tua') {
                infoText = 'Mengubah ke Orang Tua: Jika belum ada, profil orang tua akan dibuat otomatis.';
            }
            
            if (infoText) {
                if (!$('#role-change-info').length) {
                    $(this).parent().append('<div id="role-change-info" class="alert alert-warning mt-2"><small></small></div>');
                }
                $('#role-change-info small').text(infoText);
            }
        } else {
            $('#role-change-info').remove();
        }
    });

    // Confirm form submission if role changed
    $('form').on('submit', function(e) {
        let currentRole = '{{ $user->role }}';
        let newRole = $('#role').val();
        
        if (newRole !== currentRole) {
            if (!confirm('Anda akan mengubah role dari "' + currentRole + '" ke "' + newRole + '". Yakin ingin melanjutkan?')) {
                e.preventDefault();
                return false;
            }
        }
    });
});
</script>
@endsection
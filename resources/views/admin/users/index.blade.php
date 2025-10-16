@extends('layouts.app')
@section('content-title', 'Daftar Pengguna')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Manajemen Pengguna</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Pengguna
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <form action="{{ route('admin.users.index') }}" method="GET" class="form-inline justify-content-end">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari pengguna..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="users-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>No. Telepon</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->no_telp }}</td>
                                    <td>
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
                                    </td>
                                    <td>
                                        @if($user->role == 'pengemudi' && $user->driver)
                                            <span class="badge bg-success">Driver: Aktif</span>
                                        @elseif($user->role == 'orang_tua' && $user->orangTua)
                                            <span class="badge bg-success">Parent: Aktif</span>
                                        @elseif($user->role == 'admin')
                                            <span class="badge bg-success">Admin: Aktif</span>
                                        @else
                                            <span class="badge bg-warning">Profile: Belum Lengkap</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.users.show', $user) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" 
                                                  style="display: inline;" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data pengguna</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($users->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted">
                            Menampilkan {{ $users->firstItem() ?? 0 }} sampai {{ $users->lastItem() ?? 0 }} dari {{ $users->total() }} data
                        </div>
                        <div>
                            {{ $users->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#users-table').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "paging": false,
        "info": false,
        "searching": false,
        "ordering": true,
        "language": {
            "emptyTable": "Tidak ada data yang ditemukan"
        },
        "order": [[0, 'desc']] // Urutkan berdasarkan ID secara descending
    });

    // Tambahkan class untuk styling pagination
    $('.pagination').addClass('mb-0');
    
    // Tambahkan class active ke tombol sortir yang aktif
    $('.dataTable thead th').click(function() {
        $('.dataTable thead th').removeClass('sorting-active');
        if ($(this).hasClass('sorting_asc') || $(this).hasClass('sorting_desc')) {
            $(this).addClass('sorting-active');
        }
    });
});
</script>
@endsection

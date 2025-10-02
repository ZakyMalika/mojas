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
                            @foreach($users as $user)
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-center mt-3">
                    {{ $users->links() }}
                </div>
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
        "searching": true,
        "ordering": true,
        "language": {
            "search": "Cari:",
            "zeroRecords": "Tidak ada data yang ditemukan",
            "emptyTable": "Tidak ada data dalam tabel"
        }
    });
});
</script>
@endsection

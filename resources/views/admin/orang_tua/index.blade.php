@extends('layouts.app')

@section('content-title', 'Daftar Data Orang Tua')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Daftar Orang Tua</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.orang_tua.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Orang Tua
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @if($items->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No. Telepon</th>
                                    <th>Alamat</th>
                                    <th>Jumlah Anak</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $key => $item)
                                <tr>
                                    <td>{{ $items->firstItem() + $key }}</td>
                                    <td>{{ $item->user->name ?? 'N/A' }}</td>
                                    <td>{{ $item->user->email ?? 'N/A' }}</td>
                                    <td>{{ $item->user->no_telp ?? 'N/A' }}</td>
                                    <td>{{ Str::limit($item->alamat, 50) ?? '-' }}</td>
                                    <td>
                                        <span class="badge badge-info">
                                            {{ $item->anak->count() }} anak
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.orang_tua.show', $item) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                        <a href="{{ route('admin.orang_tua.edit', $item) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            Menampilkan {{ $items->firstItem() }} sampai {{ $items->lastItem() }} 
                            dari {{ $items->total() }} total data
                        </div>
                        <div>
                            {{ $items->links() }}
                        </div>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada data orang tua</h5>
                        <p class="text-muted">Klik tombol "Tambah Orang Tua" untuk menambah data baru.</p>
                    </div>
                @endif
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content-title', 'Daftar Data Orang Tua')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Daftar Orang Tua</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                {{-- Flash Messages --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fas fa-check"></i> {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fas fa-exclamation-triangle"></i> {{ session('error') }}
                    </div>
                @endif

                <!-- Search Form -->
                <div class="mb-3">
                    <form action="{{ route('admin.orang_tua.index') }}" method="GET" class="form-inline justify-content-end">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari orang tua..." value="{{ request('search') }}">
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
                                    <th style="width: 5%">No</th>
                                    <th style="width: 20%">Nama</th>
                                    <th style="width: 20%">Email</th>
                                    <th style="width: 15%">No. Telepon</th>
                                    <th style="width: 25%">Alamat</th>
                                    <th style="width: 15%">Jumlah Anak</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $key => $item)
                                <tr>
                                    <td>{{ $items->firstItem() + $key }}</td>
                                    <td>
                                        <a href="{{ route('admin.orang_tua.show', $item) }}">{{ $item->user->name ?? 'N/A' }}</a>
                                    </td>
                                    <td>{{ $item->user->email ?? 'N/A' }}</td>
                                    <td>{{ $item->user->no_telp ?? 'N/A' }}</td>
                                    <td>{{ Str::limit($item->alamat, 50) ?? '-' }}</td>
                                    <td>
                                        <span class="badge badge-info">
                                            {{ $item->anak->count() }} anak
                                        </span>
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
                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Tidak ada data orang tua yang tersedia.</h5>
                    </div>
                @endif
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

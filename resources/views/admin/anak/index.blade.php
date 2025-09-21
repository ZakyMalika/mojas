@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Manajemen Data Anak')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Semua Anak</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.anak.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Data Anak
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                {{-- Notifikasi sukses --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                        {{ session('success') }}
                    </div>
                @endif

                <table id="anak-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Anak</th>
                            <th>Orang Tua</th>
                            <th>Sekolah</th>
                            <th>Kelas</th>
                            <th style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                {{-- Menggunakan null safe operator atau optional() untuk menghindari error jika relasi kosong --}}
                                <td>{{ $item->orangTua->name ?? 'N/A' }}</td>
                                <td>{{ $item->sekolah ?? '-' }}</td>
                                <td>{{ $item->kelas ?? '-' }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.anak.show', $item->id) }}" class="btn btn-info btn-sm" title="Detail">
                                            <i class="fas fa-eye"></i> Show
                                        </a>
                                        <a href="{{ route('admin.anak.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        {{-- Form untuk tombol Hapus --}}
                                        <form action="{{ route('admin.anak.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data anak.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                {{-- Link Paginasi --}}
                {{ $items->links() }}
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

{{-- Push script jika Anda menggunakan DataTables --}}
@push('scripts')
<script>
    $(function () {
      $("#anak-table").DataTable({
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#anak-table_wrapper .col-md-6:eq(0)');
    });
</script>
@endpush


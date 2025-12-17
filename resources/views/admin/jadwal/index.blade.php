@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Manajemen Jadwal Antar Jemput')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Semua Jadwal</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Jadwal
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

                    <table id="jadwal-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Anak</th>
                                <th>Pengemudi</th>
                                <th>Hari/Tanggal</th>
                                <th>Jam Jemput</th>
                                <th>Status</th>
                                <th style="width: 20%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                                <tr>
                                    <td>{{ $items->firstItem() + $loop->index }}</td>
                                    <td>{{ $item->anak->nama ?? 'N/A' }}</td>
                                    <td>{{ $item->driver->user->name ?? 'N/A' }}</td>
                                    <td>{{ $item->hari ?? '' }},
                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->jam_jemput)->format('H:i') }}</td>
                                    <td>
                                        @php
                                            $statusClass = 'secondary';
                                            if ($item->status == 'menunggu') {
                                                $statusClass = 'warning';
                                            } elseif ($item->status == 'dijemput' || $item->status == 'perjalanan') {
                                                $statusClass = 'info';
                                            } elseif ($item->status == 'selesai') {
                                                $statusClass = 'success';
                                            } elseif ($item->status == 'dibatalkan') {
                                                $statusClass = 'danger';
                                            }
                                        @endphp
                                        <span class="badge bg-{{ $statusClass }}">{{ ucfirst($item->status) }}</span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.jadwal.show', $item->id) }}"
                                                class="btn btn-info btn-sm" title="Detail"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('admin.jadwal.edit', $item->id) }}"
                                                class="btn btn-warning btn-sm" title="Edit"><i
                                                    class="fas fa-edit"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm delete-btn" data-toggle="modal"
                                                data-target="#deleteConfirmationModal"
                                                data-action="{{ route('admin.jadwal.destroy', $item->id) }}"
                                                data-name="Jadwal untuk {{ $item->anak->nama ?? 'data ini' }} pada {{ $item->hari }}"
                                                title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada data jadwal.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data: <strong id="dataNameToDelete"></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $("#jadwal-table").DataTable({
                paging: false,
                searching: false,
                info: false,
                responsive: true,
                autoWidth: false,
                buttons: ["pdf", "excel", "print"]
            }).buttons().container().appendTo('#jadwal-table_wrapper .col-md-6:eq(0)');

            // LOGIKA HAPUS DENGAN MODAL (SOLUSI DEFINITIF)
            let urlToDelete = null;
            $('#jadwal-table tbody').on('click', '.delete-btn', function(event) {
                event.preventDefault();
                urlToDelete = $(this).data('action');
                let dataName = $(this).data('name');
                $('#dataNameToDelete').text(dataName);
            });
            $('#confirmDeleteButton').on('click', function(e) {
                e.preventDefault();
                if (urlToDelete) {
                    let form = $('<form>', {
                        'method': 'POST',
                        'action': urlToDelete,
                        'style': 'display:none;'
                    });
                    form.append($('<input>', {
                        'type': 'hidden',
                        'name': '_token',
                        'value': '{{ csrf_token() }}'
                    }));
                    form.append($('<input>', {
                        'type': 'hidden',
                        'name': '_method',
                        'value': 'DELETE'
                    }));
                    $('body').append(form);
                    form.submit();
                }
            });
        });
    </script>
@endpush

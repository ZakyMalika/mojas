@extends('layouts.app')

{{-- Judul untuk header konten --}}
@section('content-title', 'Riwayat Penghasilan Saya')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Semua Penghasilan yang Tercatat</h3>
                    <div class="card-tools">
                        <a href="{{ route('driver.penghasilan.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Catat Penghasilan
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

                    <div class="mb-2 d-flex align-items-center justify-content-between">
                        <div>
                            <form method="GET" id="perPageForm" class="form-inline">
                                <label for="per_page" class="mr-2">Tampilkan</label>
                                <select name="per_page" id="per_page" class="form-control form-control-sm mr-2"
                                    onchange="document.getElementById('perPageForm').submit()">
                                    <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request('per_page') == '25' ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('per_page') == '50' ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request('per_page') == '100' ? 'selected' : '' }}>100
                                    </option>
                                    <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>Semua
                                    </option>
                                </select>
                                <small class="text-muted">data</small>
                            </form>
                        </div>

                        <div>
                            <button id="bulkDeleteBtn" class="btn btn-danger btn-sm" style="display: none;">
                                <i class="fas fa-trash"></i> Hapus Terpilih (<span id="selectedCount">0</span>)
                            </button>
                        </div>
                    </div>

                    <table id="penghasilan-driver-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="selectAll">
                                        <label class="custom-control-label" for="selectAll"></label>
                                    </div>
                                </th>
                                <th>ID</th>
                                <th>Tanggal Jadwal</th>
                                <th>Anak</th>
                                <th>Komisi Diterima</th>
                                <th>Status</th>
                                <th>Tanggal Dibayar</th>
                                <th style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input select-item"
                                                id="check_{{ $item->id }}" value="{{ $item->id }}">
                                            <label class="custom-control-label" for="check_{{ $item->id }}"></label>
                                        </div>
                                    </td>
                                    <td>#{{ $item->id }}</td>
                                    <td>{{ $item->jadwal->tanggal ? \Carbon\Carbon::parse($item->jadwal->tanggal)->format('d M Y') : 'N/A' }}
                                    </td>
                                    <td>{{ $item->jadwal->anak->nama ?? 'N/A' }}</td>
                                    <td><strong>Rp{{ number_format($item->komisi_pengemudi, 0, ',', '.') }}</strong></td>
                                    <td>
                                        @php
                                            $statusClass = $item->status == 'pending' ? 'warning' : 'success';
                                        @endphp
                                        <span class="badge bg-{{ $statusClass }}">{{ ucfirst($item->status) }}</span>
                                    </td>
                                    <td>{{ $item->tanggal_dibayar ? \Carbon\Carbon::parse($item->tanggal_dibayar)->format('d M Y') : 'Belum dibayar' }}
                                    </td>
                                    <td>
                                        <a href="{{ route('driver.penghasilan.show', $item->id) }}"
                                            class="btn btn-info btn-xs" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('driver.penghasilan.edit', $item->id) }}"
                                            class="btn btn-warning btn-xs" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('driver.penghasilan.destroy', $item->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada riwayat penghasilan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if($items instanceof \Illuminate\Pagination\LengthAwarePaginator && $items->hasPages())
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="text-muted">
                                Menampilkan {{ $items->firstItem() ?? 0 }} sampai {{ $items->lastItem() ?? 0 }} dari {{ $items->total() }} data
                            </div>
                            <div>
                                {{ $items->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    @endif

                </div>

                <!-- Modal Konfirmasi Bulk Hapus -->
                <div class="modal fade" id="bulkConfirmModal" tabindex="-1" role="dialog"
                    aria-labelledby="bulkConfirmLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="bulkConfirmLabel">Konfirmasi Hapus Massal</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus <strong id="bulkConfirmCount"></strong> data penghasilan
                                yang dipilih? Tindakan ini tidak dapat dibatalkan.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-danger" id="confirmBulkDelete">Ya, Hapus
                                    Semua</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $("#penghasilan-driver-table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "paging": false,
                "info": false,
                "searching": false,
                "order": [
                    [1, "desc"]
                ] // Urutkan berdasarkan ID terbaru (kolom ID di index 1 karena index 0 adalah checkbox)
            });

            // LOGIKA SELECT ALL
            $('#selectAll').click(function() {
                $('.select-item').prop('checked', this.checked);
                toggleBulkDeleteButton();
            });

            // Check individual item
            $(document).on('change', '.select-item', function() {
                toggleBulkDeleteButton();
                // Uncheck "select all" if one is unchecked
                if (false == $(this).prop("checked")) {
                    $("#selectAll").prop('checked', false);
                }
                // Check "select all" if all are checked
                if ($('.select-item:checked').length == $('.select-item').length) {
                    $("#selectAll").prop('checked', true);
                }
            });

            function toggleBulkDeleteButton() {
                var count = $('.select-item:checked').length;
                if (count > 0) {
                    $('#bulkDeleteBtn').show();
                    $('#selectedCount').text(count);
                } else {
                    $('#bulkDeleteBtn').hide();
                }
            }

            // BULK DELETE
            $('#bulkDeleteBtn').click(function() {
                var ids = [];
                $('.select-item:checked').each(function() {
                    ids.push($(this).val());
                });

                if (ids.length > 0) {
                    $('#bulkConfirmModal').modal('show');
                    $('#bulkConfirmCount').text(ids.length);
                }
            });

            $('#confirmBulkDelete').click(function() {
                var ids = [];
                $('.select-item:checked').each(function() {
                    ids.push($(this).val());
                });

                if (ids.length > 0) {
                    // Safe CSRF check
                    const metaCsrf = document.querySelector('meta[name="csrf-token"]');
                    const csrfToken = metaCsrf ? metaCsrf.getAttribute('content') : "{{ csrf_token() }}";

                    $.ajax({
                        url: "{{ route('driver.penghasilan.bulkDestroy') }}",
                        type: 'POST',
                        data: {
                            _token: csrfToken,
                            _method: 'DELETE',
                            ids: ids
                        },
                        success: function(response) {
                            location.reload();
                        },
                        error: function(xhr) {
                            alert('Terjadi kesalahan saat menghapus data.');
                            console.error(xhr);
                        }
                    });
                }
            });
        });
    </script>
@endpush

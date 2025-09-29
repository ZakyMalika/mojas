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
                    {{-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#anakFormModal">
                        <i class="fas fa-plus"></i> Tambah Data Anak
                    </button> --}}
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
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Oops! Ada kesalahan validasi.</strong> Silakan periksa kembali data di formulir.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
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
                            <th>Jadwal</th>
                            <th style="width: 22%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->orangTua->user->name ?? 'N/A' }}</td>
                                <td>{{ $item->sekolah ?? '-' }}</td>
                                <td>{{ $item->kelas ?? '-' }}</td>
                                <td>
                                    @if($item->jadwal_antar_jemput && $item->jadwal_antar_jemput->count() > 0)
                                        
                                        <br><p class="text-muted">{{ $item->jadwal_antar_jemput->first()->jam_jemput ?? '' }}</p>
                                    @else
                                        <span class="text-muted">Belum ada jadwal</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.anak.show', $item->id) }}" class="btn btn-info btn-sm" title="Detail"><i class="fas fa-eye"></i> Show</a>
                                        <a href="{{ route('admin.anak.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i> Edit</a>
                                        <a href="#" class="btn btn-danger btn-sm delete-btn"
                                           data-toggle="modal"
                                           data-target="#deleteConfirmationModal"
                                           data-action="{{ route('admin.anak.destroy', $item->id) }}"
                                           data-name="{{ $item->nama }}"
                                           title="Hapus">
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center">Belum ada data anak.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Form HANYA UNTUK Tambah -->
<div class="modal fade" id="anakFormModal" tabindex="-1" role="dialog" aria-labelledby="anakModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="anakModalLabel">Formulir Data Anak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="anakForm" method="POST" action="{{ route('admin.anak.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="orang_tua_id">Orang Tua</label>
                        <select class="form-control" id="orang_tua_id" name="orang_tua_id">
                            <option value="">Pilih Orang Tua</option>
                            <option value="1">Contoh: Budi</option>
                        </select>
                    </div>
                    <div class="form-group"><label for="nama">Nama Anak</label><input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap anak"></div>
                    <div class="row">
                        <div class="col-sm-6"><div class="form-group"><label for="umur">Umur</label><input type="number" class="form-control" id="umur" name="umur" placeholder="Contoh: 5"></div></div>
                        <div class="col-sm-6"><div class="form-group"><label for="jenis_kelamin">Jenis Kelamin</label><select class="form-control" id="jenis_kelamin" name="jenis_kelamin"><option value="">Pilih</option><option value="Laki-laki">Laki-laki</option><option value="Perempuan">Perempuan</option></select></div></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6"><div class="form-group"><label for="sekolah">Sekolah</label><input type="text" class="form-control" id="sekolah" name="sekolah" placeholder="Contoh: TK Pelita Harapan"></div></div>
                        <div class="col-sm-6"><div class="form-group"><label for="kelas">Kelas</label><input type="text" class="form-control" id="kelas" name="kelas" placeholder="Contoh: A1"></div></div>
                    </div>
                    <div class="form-group"><label for="alamat_penjemputan">Alamat</label><textarea class="form-control" rows="3" id="alamat_penjemputan" name="alamat_penjemputan" placeholder="Alamat lengkap penjemputan"></textarea></div>
                    <div class="form-group"><label for="catatan">Catatan</label><textarea class="form-control" rows="3" id="catatan" name="catatan" placeholder="Catatan tambahan (opsional)"></textarea></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="submitButton">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
$(function () {
    // Inisialisasi DataTable
    // $("#anak-table").DataTable({
    //     "responsive": true, "lengthChange": false, "autoWidth": false,
    //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    // }).buttons().container().appendTo('#anak-table_wrapper .col-md-6:eq(0)');

    // ======================================================================
    // SOLUSI DEFINITIF UNTUK FUNGSI HAPUS
    // ======================================================================
    let urlToDelete = null; // Siapkan variabel di luar scope untuk menyimpan URL

    // 1. Saat tombol 'Hapus' di tabel diklik, kita siapkan datanya
    // Event delegation '.on()' pada tabel adalah kunci agar ini berfungsi
    // bahkan setelah DataTables mengurutkan atau memfilter data.
    $('#anak-table tbody').on('click', '.delete-btn', function (event) {
        event.preventDefault(); // Mencegah aksi default dari link <a>

        // Simpan URL dari tombol yang diklik ke variabel
        urlToDelete = $(this).data('action');

        let dataName = $(this).data('name');

        // Tampilkan nama di modal untuk konfirmasi
        $('#dataNameToDelete').text(dataName);
    });

    // 2. Saat tombol "Ya, Hapus" di dalam modal diklik, kita jalankan aksi
    $('#confirmDeleteButton').on('click', function(e) {
        e.preventDefault();

        // Cek apakah URL sudah tersimpan dengan benar
        if (urlToDelete) {
            // Buat form dinamis di memory (ini adalah metode paling andal)
            let form = $('<form>', {
                'method': 'POST',
                'action': urlToDelete, // Gunakan URL yang sudah kita simpan
                'style': 'display:none;'
            });

            // Tambahkan token CSRF
            form.append($('<input>', {
                'type': 'hidden', 'name': '_token', 'value': '{{ csrf_token() }}'
            }));

            // Tambahkan method spoofing untuk DELETE
            form.append($('<input>', {
                'type': 'hidden', 'name': '_method', 'value': 'DELETE'
            }));

            // Tempelkan form ke body, kirim, lalu hapus
            $('body').append(form);
            form.submit();
        } else {
            // Fallback jika URL tidak ditemukan
            console.error("Delete URL not set. Cannot proceed.");
            alert("Terjadi kesalahan. URL untuk menghapus data tidak ditemukan.");
        }
    });
    // ======================================================================

    // LOGIKA HANYA UNTUK MODAL TAMBAH
    $('#anakFormModal').on('show.bs.modal', function (event) {
        $('#anakForm')[0].reset();
    });
});
</script>
@endpush


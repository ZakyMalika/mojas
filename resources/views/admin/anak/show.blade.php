{{-- Halaman ini menampilkan detail lengkap dari satu data anak. --}}
<div class="p-8">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">{{ $item->nama }}</h1>
                <p class="text-md text-gray-500">Detail Lengkap Data Anak</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.anak.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-300">
                    Kembali
                </a>
                 <a href="{{ route('admin.anak.edit', $item->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                    Edit
                </a>
            </div>
        </div>

        <div class="border-t border-gray-200 pt-6">
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-8">
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Nama Orang Tua</dt>
                    <dd class="mt-1 text-lg text-gray-900">{{ $item->orangTua->nama ?? 'N/A' }}</dd>
                </div>
                 <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Umur</dt>
                    <dd class="mt-1 text-lg text-gray-900">{{ $item->umur ? $item->umur . ' tahun' : '-' }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Sekolah</dt>
                    <dd class="mt-1 text-lg text-gray-900">{{ $item->sekolah ?? '-' }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Kelas</dt>
                    <dd class="mt-1 text-lg text-gray-900">{{ $item->kelas ?? '-' }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Alamat Penjemputan</dt>
                    <dd class="mt-1 text-lg text-gray-900 whitespace-pre-wrap">{{ $item->alamat_penjemputan ?? '-' }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Catatan Tambahan</dt>
                    <dd class="mt-1 text-lg text-gray-900 whitespace-pre-wrap">{{ $item->catatan ?? 'Tidak ada catatan.' }}</dd>
                </div>

                {{-- Menampilkan data relasi --}}
                <div class="sm:col-span-2 border-t pt-4 mt-4">
                    <dt class="text-sm font-medium text-gray-500">Jadwal Antar Jemput</dt>
                    <dd class="mt-1 text-lg text-gray-900">
                        @if($item->jadwal_antar_jemput && $item->jadwal_antar_jemput->count() > 0)
                            <ul class="list-disc pl-5">
                            @foreach($item->jadwal_antar_jemput as $jadwal)
                                <li>{{ $jadwal->hari }}: Jemput pukul {{ $jadwal->jam_penjemputan }}, Antar pukul {{ $jadwal->jam_pengantaran }}</li>
                            @endforeach
                            </ul>
                        @else
                            Jadwal belum diatur.
                        @endif
                    </dd>
                </div>
                 <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Status Pendaftaran</dt>
                    <dd class="mt-1 text-lg text-gray-900">
                        {{ $item->pendaftaran_anak->status ?? 'Belum terdaftar' }}
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</div>

{{-- Halaman ini akan menampilkan daftar semua data anak dalam bentuk tabel. --}}
<div class="p-8">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Data Anak</h1>
            <a href="{{ route('admin.anak.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                + Tambah Anak
            </a>
        </div>

        <!-- Tabel Data Anak -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 border-b text-left text-sm font-semibold text-gray-600">No</th>
                        <th class="py-3 px-4 border-b text-left text-sm font-semibold text-gray-600">Nama Anak</th>
                        <th class="py-3 px-4 border-b text-left text-sm font-semibold text-gray-600">Orang Tua</th>
                        <th class="py-3 px-4 border-b text-left text-sm font-semibold text-gray-600">Sekolah</th>
                        <th class="py-3 px-4 border-b text-left text-sm font-semibold text-gray-600">Kelas</th>
                        <th class="py-3 px-4 border-b text-center text-sm font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($items as $index => $item)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 border-b">{{ $items->firstItem() + $index }}</td>
                            <td class="py-3 px-4 border-b">{{ $item->nama }}</td>
                            <td class="py-3 px-4 border-b">{{ $item->orangTua->nama ?? 'N/A' }}</td>
                            <td class="py-3 px-4 border-b">{{ $item->sekolah ?? '-' }}</td>
                            <td class="py-3 px-4 border-b">{{ $item->kelas ?? '-' }}</td>
                            <td class="py-3 px-4 border-b text-center">
                                <div class="flex justify-center items-center space-x-2">
                                    <a href="{{ route('admin.anak.show', $item->id) }}" class="text-blue-500 hover:text-blue-700 font-semibold">Show</a>
                                    <span class="text-gray-300">|</span>
                                    <a href="{{ route('admin.anak.edit', $item->id) }}" class="text-yellow-500 hover:text-yellow-700 font-semibold">Edit</a>
                                    <span class="text-gray-300">|</span>
                                    <form action="{{ route('admin.anak.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-semibold">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 px-4 text-center text-gray-500">
                                Data anak tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $items->links() }}
        </div>
    </div>
</div>

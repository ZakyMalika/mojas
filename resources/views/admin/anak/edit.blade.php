{{-- Halaman ini mirip dengan create, tapi formnya sudah terisi dengan data anak yang akan di-edit. --}}
<div class="p-8">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Data Anak: {{ $item->nama }}</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                <ul class="mt-3 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.anak.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                {{-- Field Orang Tua --}}
                {{-- PENTING: Anda perlu mengirimkan daftar orang tua dari controller --}}
                <div>
                    <label for="orang_tua_id" class="block text-sm font-medium text-gray-700 mb-1">Orang Tua</label>
                    <select id="orang_tua_id" name="orang_tua_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Orang Tua</option>
                        {{-- @foreach($orangTuaList as $ortu) --}}
                        {{-- <option value="{{ $ortu->id }}" {{ old('orang_tua_id', $item->orang_tua_id) == $ortu->id ? 'selected' : '' }}>{{ $ortu->nama }}</option> --}}
                        {{-- @endforeach --}}
                        <option value="1" {{ old('orang_tua_id', $item->orang_tua_id) == 1 ? 'selected' : '' }}>Contoh: Budi</option>
                    </select>
                     @error('orang_tua_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Field Nama Anak --}}
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Anak</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $item->nama) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Field Umur --}}
                <div>
                    <label for="umur" class="block text-sm font-medium text-gray-700 mb-1">Umur (Tahun)</label>
                    <input type="number" id="umur" name="umur" value="{{ old('umur', $item->umur) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('umur') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                 {{-- Field Sekolah dan Kelas --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="sekolah" class="block text-sm font-medium text-gray-700 mb-1">Sekolah</label>
                        <input type="text" id="sekolah" name="sekolah" value="{{ old('sekolah', $item->sekolah) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="kelas" class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                        <input type="text" id="kelas" name="kelas" value="{{ old('kelas', $item->kelas) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                {{-- Field Alamat Penjemputan --}}
                <div>
                    <label for="alamat_penjemputan" class="block text-sm font-medium text-gray-700 mb-1">Alamat Penjemputan</label>
                    <textarea id="alamat_penjemputan" name="alamat_penjemputan" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('alamat_penjemputan', $item->alamat_penjemputan) }}</textarea>
                </div>

                {{-- Field Catatan --}}
                <div>
                    <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1">Catatan (Opsional)</label>
                    <textarea id="catatan" name="catatan" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('catatan', $item->catatan) }}</textarea>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('admin.anak.show', $item->id) }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-300">
                    Batal
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

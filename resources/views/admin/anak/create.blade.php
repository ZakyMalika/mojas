{{-- ... existing code ... --}}
                {{-- Field Umur --}}
                <div>
                    <label for="umur" class="block text-sm font-medium text-gray-700 mb-1">Umur (Tahun)</label>
                    <input type="number" id="umur" name="umur" value="{{ old('umur') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: 5">
                    @error('umur') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Field Jenis Kelamin --}}
                <div>
                    <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    {{-- Anda perlu menambahkan validasi untuk 'jenis_kelamin' di controller --}}
                    @error('jenis_kelamin') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Field Sekolah dan Kelas --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
{{-- ... existing code ... --}}


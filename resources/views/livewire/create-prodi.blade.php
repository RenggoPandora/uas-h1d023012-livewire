<flux:modal name="create-prodi" class="md:w-96">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Create Prodi</flux:heading>
            <flux:text class="mt-2">Tambah data program studi baru.</flux:text>
        </div>

        {{-- Nama Prodi --}}
        <flux:input 
            label="Nama Prodi" 
            placeholder="Contoh: Teknik Informatika" 
            wire:model.defer="nama_prod" 
        />
        @error('nama_prod')
            <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
        @enderror

        {{-- Fakultas --}}
        <div>
            <label for="fakultas_id" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Fakultas</label>
            <select id="fakultas_id" wire:model.defer="fakultas_id" class="w-full border rounded p-2 bg-white dark:bg-gray-800 dark:text-white">
                <option value="">-- Pilih Fakultas --</option>
                @foreach ($fakultasList as $fak)
                    <option value="{{ $fak->id }}">{{ $fak->nama_fak }}</option>
                @endforeach
            </select>
            @error('fakultas_id')
                <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tombol Simpan --}}
        <div class="flex">
            <flux:spacer />
            <flux:button type="submit" variant="primary" wire:click="create">Simpan</flux:button>
        </div>
    </div>
</flux:modal>

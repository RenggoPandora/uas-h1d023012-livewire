<div>
    <flux:modal name="edit-mahasiswa" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edit Mahasiswa</flux:heading>
                <flux:text class="mt-2">Perbarui data mahasiswa.</flux:text>
            </div>

            <flux:input label="Nama Mahasiswa" wire:model.defer="nama_mhs" />
            @error('nama_mhs') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror

            <flux:input label="Email" wire:model.defer="email" />
            @error('email') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror

            <flux:input label="Angkatan" type="number" wire:model.defer="angkatan" />
            @error('angkatan') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror

            <div class="space-y-1">
                <label class="text-sm font-medium">Program Studi</label>
                <flux:select wire:model.defer="prodi_id">
                    <option value="">Pilih Prodi</option>
                    @foreach ($listProdi as $prodi)
                        <option value="{{ $prodi->id }}">{{ $prodi->nama_prod }}</option>
                    @endforeach
                </flux:select>
                @error('prodi_id') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" wire:click="update">Update</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
<div>
    <flux:modal name="edit-prodi" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edit Prodi</flux:heading>
                <flux:text class="mt-2">Perbarui data Prodi.</flux:text>
            </div>

            <flux:input 
                label="Nama Prodi" 
                placeholder="Contoh: Sistem Informasi" 
                wire:model.defer="nama_prod" 
            />
            @error('nama_prod') 
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p> 
            @enderror

            <div class="space-y-1">
                <flux:select label="Fakultas" wire:model="fakultas_id">
                    <option value="">Pilih Fakultas</option>
                    @foreach ($fakultasList as $fak)
                        <option value="{{ $fak->id }}">{{ $fak->nama_fak }}</option>
                    @endforeach
                </flux:select>
                @error('fakultas_id') 
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" wire:click="update">Update</flux:button>
            </div>
        </div>
    </flux:modal>
</div>

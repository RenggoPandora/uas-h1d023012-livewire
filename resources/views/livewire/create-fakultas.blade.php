<div>
    <flux:modal 
        name="create-fakultas" 
        class="md:w-96" 
        wire:closed="$dispatch('modalClosed')"
    >
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Create Fakultas</flux:heading>
                <flux:text class="mt-2">Tambahkan Data Fakultas.</flux:text>
            </div>

            <flux:input 
                label="Nama Fakultas"
                placeholder="Fakultas (Nama Fakultas)"
                wire:model.defer="nama_fak"
            />
            @error('nama_fak')
                <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
            @enderror

            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" wire:click="create">Add</flux:button>
            </div>
        </div>
    </flux:modal>

</div>

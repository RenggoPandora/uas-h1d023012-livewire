<div>
    <flux:modal name="create-mahasiswa" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Tambah Mahasiswa</flux:heading>
                <flux:text class="mt-2">Isi data mahasiswa baru.</flux:text>
            </div>

            <flux:input label="Nama Mahasiswa" placeholder="Nama lengkap" wire:model.defer="nama_mhs" />

            <flux:input label="Email" placeholder="email@example.com" wire:model.defer="email" />

            <flux:input label="Angkatan" type="number" placeholder="Contoh: 2023" wire:model.defer="angkatan" />

            <div class="space-y-1">
                <label class="text-sm font-medium">Program Studi</label>
                <flux:select wire:model.defer="prodi_id">
                    <option value="">Pilih Prodi</option>
                    @foreach ($listProdi as $prodi)
                        <option value="{{ $prodi->id }}">{{ $prodi->nama_prod }}</option>
                    @endforeach
                </flux:select>
            </div>

            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" wire:click="store">Simpan</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
<div>
    <flux:modal name="create-mk" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Tambah Matakuliah</flux:heading>
                <flux:text class="mt-2">Masukkan informasi matakuliah baru.</flux:text>
            </div>

            <flux:input label="Kode" wire:model.defer="kode" placeholder="Contoh: IF101" />
            <flux:input label="Nama Matakuliah" wire:model.defer="nama_mk" placeholder="Contoh: Struktur Data" />
            <flux:input label="SKS" type="number" wire:model.defer="sks" />
            <flux:select label="Tipe" wire:model.defer="tipe">
                <option value="">Pilih Tipe</option>
                <option value="wajib">Wajib</option>
                <option value="pilihan">Pilihan</option>
            </flux:select>
        
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" wire:click="store">Simpan</flux:button>
            </div>
        </div>
    </flux:modal>
</div>

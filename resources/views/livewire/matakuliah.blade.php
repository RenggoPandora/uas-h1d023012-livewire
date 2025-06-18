<div class="relative mb-6 w-full">
    <flux:heading size="xl" level="1">{{ __('Matakuliah') }}</flux:heading>
    <flux:separator variant="subtle" />

    <flux:modal.trigger name="create-mk">
        <flux:button class="mt-4">Tambah Matakuliah</flux:button>
    </flux:modal.trigger>

    @if (session()->has('success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 2500)"
        class="fixed top-5 right-5 bg-green-500 text-white py-2 px-4 rounded shadow-md"
    >
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <livewire:create-mk />
    <livewire:edit-mk />

    <div class="overflow-x-auto mt-6 rounded-lg shadow ring-1 ring-black/10 dark:ring-white/10">
        <table class="min-w-full text-sm text-left divide-y divide-gray-300 dark:divide-gray-700">
            <thead class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Kode</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">SKS</th>
                    <th class="px-4 py-3">Tipe</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($matakuliah as $index => $mk)
                <tr class="hover:bg-gray-500 transition">
                    <td class="px-4 py-3">{{ $matakuliah->firstItem() + $index }}</td>
                    <td class="px-4 py-3">{{ $mk->kode }}</td>
                    <td class="px-4 py-3">{{ $mk->nama_mk }}</td>
                    <td class="px-4 py-3">{{ $mk->sks }}</td>
                    <td class="px-4 py-3 capitalize">{{ $mk->tipe }}</td>
                    <td class="px-4 py-3 text-center space-x-2">
                        <flux:button size="sm" variant="primary" wire:click="edit({{ $mk->id }})">Edit</flux:button>
                        <flux:button size="sm" variant="danger" wire:click="delete({{ $mk->id }})">Delete</flux:button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-gray-500 py-3">Tidak ada data matakuliah.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-end">
        {{ $matakuliah->links('pagination::tailwind') }}
    </div>

    <flux:modal name="delete-mk" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Hapus Matakuliah?</flux:heading>
                <flux:text class="mt-2">Tindakan ini tidak dapat dibatalkan.</flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close><flux:button variant="ghost">Cancel</flux:button></flux:modal.close>
                <flux:button type="submit" variant="danger" wire:click="deleteMatakuliah">Hapus</flux:button>
            </div>
        </div>
    </flux:modal>
</div>

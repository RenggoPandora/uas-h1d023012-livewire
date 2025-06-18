<div class="relative mb-6 w-full">
    <flux:heading size="xl" level="1">Mahasiswa</flux:heading>
    <flux:separator variant="subtle" />

    <flux:modal.trigger name="create-mahasiswa">
        <flux:button class="mt-4">Create Mahasiswa</flux:button>
    </flux:modal.trigger>

    @if (session()->has('success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 2500)"
        class="fixed top-5 right-5 bg-green-500 dark:bg-green-600 text-white py-2 px-4 rounded shadow-md transition-opacity"
        role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <livewire:create-mahasiswa />
    <livewire:edit-mahasiswa />

    <div class="overflow-x-auto mt-6 rounded-lg shadow ring-1 ring-black/10 dark:ring-white/10">
        <table class="min-w-full text-sm text-left divide-y divide-gray-300 dark:divide-gray-700">
            <thead class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">NIM</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Prodi</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($mahasiswa as $index => $mhs)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                    <td class="px-4 py-3">{{ $mahasiswa->firstItem() + $index }}</td>
                    <td class="px-4 py-3">{{ $mhs->nim }}</td>
                    <td class="px-4 py-3">{{ $mhs->nama_mhs }}</td>
                    <td class="px-4 py-3">{{ $mhs->email }}</td>
                    <td class="px-4 py-3">{{ $mhs->prodi->nama_prod ?? '-' }}</td>
                    <td class="px-4 py-3">{{ ucfirst($mhs->status) }}</td>
                    <td class="px-4 py-3 text-center space-x-2">
                        <flux:button size="sm" variant="primary" wire:click="edit({{ $mhs->id }})">Edit</flux:button>
                        <flux:button size="sm" variant="danger" wire:click="delete({{ $mhs->id }})">Delete</flux:button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                        Tidak ada data mahasiswa.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-end">
        {{ $mahasiswa->links('pagination::tailwind') }}
    </div>

    <flux:modal name="delete-mahasiswa" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete Mahasiswa?</flux:heading>
                <flux:text class="mt-2">
                    <p>Anda akan menghapus data mahasiswa ini.</p>
                    <p>Tindakan ini tidak dapat dikembalikan.</p>
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="danger" wire:click="deleteMahasiswa">Hapus</flux:button>
            </div>
        </div>
    </flux:modal>
</div>

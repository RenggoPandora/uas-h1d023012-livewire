<div class="relative mb-6 w-full">
    {{-- Heading --}}
    <flux:heading size="xl" level="1">{{ __('Prodi') }}</flux:heading>
    <flux:separator variant="subtle" />

    {{-- Button trigger modal --}}
    <flux:modal.trigger name="create-prodi">
        <flux:button class="mt-4">Create Prodi</flux:button>
    </flux:modal.trigger>

    {{-- Success Alert --}}
    @if (session()->has('success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 2500)"
        class="fixed top-5 right-5 bg-green-500 dark:bg-green-600 text-white py-2 px-4 rounded shadow-md transition-opacity"
        role="alert"
    >
        <p>{{ session('success') }}</p>
    </div>
@endif

    {{-- Livewire Modal --}}
    <livewire:create-prodi />
    <livewire:edit-prodi />


    {{-- Table --}}
    <div class="overflow-x-auto mt-6 rounded-lg shadow ring-1 ring-black/10 dark:ring-white/10">
        <table class="min-w-full text-sm text-left divide-y divide-gray-300 dark:divide-gray-700">
            <thead class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Nama Prodi</th>
                    <th class="px-4 py-3">Fakultas</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($prodi as $index => $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                        <td class="px-4 py-3">{{ $prodi->firstItem() + $index }}</td>
                        <td class="px-4 py-3">{{ $item->nama_prod }}</td>
                        <td class="px-4 py-3">{{ $item->fakultas->nama_fak ?? '-' }}</td>
                        <td class="px-4 py-3 text-center space-x-2">
                            <flux:button size="sm" variant="primary" wire:click="edit({{ $item->id }})">Edit</flux:button>
                            <flux:button size="sm" variant="danger" wire:click="delete({{ $item->id }})">Delete</flux:button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                            Tidak ada data prodi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6 flex justify-end">
        {{ $prodi->links('pagination::tailwind') }}
    </div>

    {{-- Delete Modal --}}
    <flux:modal name="delete-prodi" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete Prodi?</flux:heading>
                <flux:text class="mt-2">
                    <p>Anda akan menghapus data prodi ini.</p>
                    <p>Tindakan ini tidak dapat dikembalikan.</p>
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
            </div>
        </div>
    </flux:modal>
</div>

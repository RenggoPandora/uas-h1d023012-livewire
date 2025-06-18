<div class="relative mb-6 w-full">
    {{-- Heading --}}
    <flux:heading size="xl" level="1">{{ __('Fakultas') }}</flux:heading>
    <flux:separator variant="subtle" />

    {{-- Button trigger modal --}}
    <flux:modal.trigger name="create-fakultas">
        <flux:button class="mt-4">Create Fakultas</flux:button>
    </flux:modal.trigger>

    {{-- Success Alert --}}
    @session('success')
        <div
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 2500)"
            class="fixed top-5 right-5 bg-green-500 dark:bg-green-600 text-white py-2 px-4 rounded shadow-md transition-opacity"
            role="alert"
        >
            <p>{{ $value }}</p>
        </div>
    @endsession

    {{-- Livewire Modal --}}
    <livewire:create-fakultas />
    <livewire:edit-fakultas />

    {{-- Table --}}
    <div class="overflow-x-auto mt-6 rounded-lg shadow ring-1 ring-black/10 dark:ring-white/10">
        <table class="min-w-full text-sm text-left divide-y divide-gray-300 dark:divide-gray-700">
            <thead class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Nama Fakultas</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($fakultas as $index => $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                        <td class="px-4 py-3">{{ $fakultas->firstItem() + $index }}</td>
                        <td class="px-4 py-3">{{ $item->nama_fak }}</td>
                        <td class="px-4 py-3 text-center space-x-2">
                            <flux:button wire:click="edit({{ $item->id }})" size="sm">Edit</flux:button>
                            <flux:button size="sm" variant="danger">Delete</flux:button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                            Tidak ada data fakultas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6 flex justify-end">
        {{ $fakultas->links('pagination::tailwind') }}
    </div>
</div>

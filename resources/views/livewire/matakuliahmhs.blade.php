<div class="relative mb-6 w-full">
    <flux:heading size="xl" level="1">Mata Kuliah Saya - Semester {{ $semester }}</flux:heading>
    <flux:separator variant="subtle" />

    @if (session('success'))
        <div class="text-green-600 mt-4">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="text-red-600 mt-4">{{ session('error') }}</div>
    @endif

    @if (count($matkulDiambil) > 0)
        <div class="overflow-x-auto mt-4 rounded-lg shadow ring-1 ring-black/10 dark:ring-white/10">
            <table class="min-w-full text-sm text-left divide-y divide-gray-300 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 uppercase tracking-wider">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Nama Mata Kuliah</th>
                        <th class="px-4 py-3">SKS</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($matkulDiambil as $index => $krs)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $krs->matakuliah->nama_mk }}</td>
                            <td class="px-4 py-3">{{ $krs->matakuliah->sks }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            <button wire:click="resetKrs" onclick="confirm('Yakin ingin reset KRS semester ini?') || event.stopImmediatePropagation()" 
                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                Reset KRS Semester Ini
            </button>
        </div>
    @else
        <div class="mt-6 text-gray-600 dark:text-gray-400">
            Anda belum mengambil mata kuliah pada semester ini.
        </div>
    @endif
</div>

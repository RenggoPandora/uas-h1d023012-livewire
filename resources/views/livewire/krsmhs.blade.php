<div class="relative mb-6 w-full">
    <flux:heading size="xl" level="1">Ajukan KRS</flux:heading>
    <flux:subheading>{{ __('Matakuliah yang Tersedia') }}</flux:subheading>
    <flux:separator variant="subtle" />

    @if (session('success'))
        <div class="mt-4 bg-green-100 text-green-700 px-4 py-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mt-4 bg-red-100 text-red-700 px-4 py-2 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if($totalSks >= 24)
        <div class="mt-4 text-red-600 font-semibold">
            Anda telah mengambil maksimal SKS (24 SKS) untuk semester ini.
        </div>
    @elseif(count($matkulList) === 0)
        <div class="mt-4 text-gray-500">
            Tidak ada mata kuliah yang tersedia untuk diambil pada semester ini.
        </div>
    @else
        <form wire:submit.prevent="submit">
            <div class="overflow-x-auto mt-6 rounded-lg shadow ring-1 ring-black/10 dark:ring-white/10">
                <table class="min-w-full text-sm text-left divide-y divide-gray-300 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 uppercase tracking-wider">
                        <tr>
                            <th class="px-4 py-3 text-center">Pilih</th>
                            <th class="px-4 py-3">Kode</th>
                            <th class="px-4 py-3">Nama Mata Kuliah</th>
                            <th class="px-4 py-3">Semester</th>
                            <th class="px-4 py-3">SKS</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($matkulList as $mk)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-4 py-3 text-center">
                                    <input type="checkbox" wire:model="selectedMatkul" value="{{ $mk->id }}" id="mk{{ $mk->id }}">
                                </td>
                                <td class="px-4 py-3">{{ $mk->kode }}</td>
                                <td class="px-4 py-3">{{ $mk->nama_mk }}</td>
                                <td class="px-4 py-3">Semester {{ $mk->semester }}</td>
                                <td class="px-4 py-3">{{ $mk->sks }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex justify-between items-center">
                <div class="text-sm">
                    <strong>Total SKS:</strong> {{ $totalSks }} dari maksimal 24 SKS
                </div>
                <flux:button type="submit" variant="primary">Simpan KRS</flux:button>
            </div>
        </form>
    @endif
</div>

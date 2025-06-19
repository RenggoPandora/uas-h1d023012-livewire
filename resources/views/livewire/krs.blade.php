<div class="relative mb-6 w-full">
    <flux:heading size="xl" level="1">Rekap KRS Mahasiswa</flux:heading>
    <flux:subheading>Daftar mahasiswa aktif dan SKS yang telah diambil semester ini.</flux:subheading>
    <flux:separator variant="subtle" />

    <div class="flex gap-4 mt-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-white">Filter Fakultas</label>
            <select wire:model="selectedFakultas" class="mt-1 rounded-md shadow-sm border-gray-300 dark:bg-gray-800 dark:text-white">
                <option value="">Semua Fakultas</option>
                @foreach ($listFakultas as $fak)
                    <option value="{{ $fak->id }}">{{ $fak->nama_fak }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-white">Filter Semester</label>
            <select wire:model="selectedSemester" class="mt-1 rounded-md shadow-sm border-gray-300 dark:bg-gray-800 dark:text-white">
                <option value="">Semua Semester</option>
                @foreach ($listSemester as $sem)
                    <option value="{{ $sem }}">Semester {{ $sem }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="overflow-x-auto mt-6 rounded-lg shadow ring-1 ring-black/10 dark:ring-white/10">
        <table class="min-w-full text-sm text-left divide-y divide-gray-300 dark:divide-gray-700">
            <thead class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">NIM</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Prodi</th>
                    <th class="px-4 py-3">Fakultas</th>
                    <th class="px-4 py-3">Semester</th>
                    <th class="px-4 py-3">Total SKS</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($mahasiswaList as $index => $mhs)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="px-4 py-3">{{ $index + 1 }}</td>
                        <td class="px-4 py-3">{{ $mhs->nim }}</td>
                        <td class="px-4 py-3">{{ $mhs->nama_mhs }}</td>
                        <td class="px-4 py-3">{{ $mhs->prodi->nama_prod ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $mhs->prodi->fakultas->nama_fak ?? '-' }}</td>
                        <td class="px-4 py-3">Semester {{ $mhs->current_semester }}</td>
                        <td class="px-4 py-3">{{ $mhs->sks_semester_ini }} SKS</td>
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
</div>

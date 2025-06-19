<div class="p-4 space-y-4">
    <!-- Filter -->
    <div class="flex gap-4">
        <select wire:model="fakultas_id" class="border px-2 py-1 rounded">
            <option value="">-- Semua Fakultas --</option>
            @foreach($fakultasList as $fak)
                <option value="{{ $fak->id }}">{{ $fak->nama_fak }}</option>
            @endforeach
        </select>

        <select wire:model="semester" class="border px-2 py-1 rounded">
            <option value="">-- Semua Semester --</option>
            @for($i = 1; $i <= 14; $i++)
                <option value="{{ $i }}">Semester {{ $i }}</option>
            @endfor
        </select>
    </div>

    <!-- Table Mahasiswa -->
    <table class="w-full border border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-2 py-1">NIM</th>
                <th class="border px-2 py-1">Nama</th>
                <th class="border px-2 py-1">Fakultas</th>
                <th class="border px-2 py-1">Prodi</th>
                <th class="border px-2 py-1">Semester Saat Ini</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mahasiswas as $mhs)
                <tr>
                    <td class="border px-2 py-1">{{ $mhs->nim }}</td>
                    <td class="border px-2 py-1">{{ $mhs->nama_mhs }}</td>
                    <td class="border px-2 py-1">{{ $mhs->prodi->fakultas->nama_fak ?? '-' }}</td>
                    <td class="border px-2 py-1">{{ $mhs->prodi->nama_prod ?? '-' }}</td>
                    <td class="border px-2 py-1">{{ $mhs->semester }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-2">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

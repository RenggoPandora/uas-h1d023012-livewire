<?php

namespace App\Livewire;

use App\Models\Krs as KrsModel;
use App\Models\Matakuliah;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;


class Krsmhs extends Component
{
    public $selectedMatkul = [];
    public $matkulList = [];
    public $totalSks = 0;
    public $semester;

   public function mount()
{
    $mahasiswa = Mahasiswa::where('email', Auth::user()->email)->firstOrFail();
    $this->semester = $mahasiswa->semester;
    Log::debug("Semester saat mount(): {$this->semester}");

    // Total SKS semester ini (sebelum submit)
    $this->totalSks = $mahasiswa->krs()
        ->where('semester', $this->semester)
        ->with('matakuliah')
        ->get()
        ->sum(fn($k) => $k->matakuliah->sks ?? 0);

    // Ambil daftar mata kuliah yang sudah diambil semester ini
    $matkulDiambil = $mahasiswa->krs()
        ->where('semester', $this->semester)
        ->pluck('matakuliah_id')
        ->toArray();

    // Ambil matkul yang SESUAI semester ganjil/genap DAN belum diambil
    $this->matkulList = Matakuliah::whereRaw('semester % 2 = ?', [$this->semester % 2])
        ->whereNotIn('id', $matkulDiambil)
        ->get();
}

    public function updatedSelectedMatkul()
    {
        $this->totalSks = Matakuliah::whereIn('id', $this->selectedMatkul)->sum('sks');

        if ($this->totalSks > 24) {
            session()->flash('error', 'Total SKS tidak boleh lebih dari 24');
        }
    }

    

public function submit()
{
    Log::debug('Memulai submit KRS');

    $mahasiswa = Mahasiswa::where('email', Auth::user()->email)->first();

    if (!$mahasiswa) {
        Log::error('Mahasiswa tidak ditemukan untuk email: ' . Auth::user()->email);
        session()->flash('error', 'Data mahasiswa tidak ditemukan');
        return;
    }

    $this->totalSks = Matakuliah::whereIn('id', $this->selectedMatkul)->sum('sks');
    Log::debug('Total SKS: ' . $this->totalSks);

    if ($this->totalSks > 24) {
        session()->flash('error', 'Total SKS melebihi batas maksimal');
        Log::warning('SKS melebihi batas: ' . $this->totalSks);
        return;
    }

    foreach ($this->selectedMatkul as $id) {
        Log::debug("Menyimpan KRS untuk matakuliah_id $id | semester = {$this->semester}");

        KrsModel::create([
            'mahasiswa_id'   => $mahasiswa->id,
            'matakuliah_id'  => $id,
            'semester'       => $this->semester,
        ]);
    }

    Log::debug('KRS berhasil disimpan ke database');

    // ✅ Refresh daftar matkul agar yang sudah diambil langsung hilang
    $sudahDiambil = KrsModel::where('mahasiswa_id', $mahasiswa->id)
        ->where('semester', $this->semester)
        ->pluck('matakuliah_id');

    $this->matkulList = Matakuliah::where('semester', $this->semester)
        ->whereNotIn('id', $sudahDiambil)
        ->get();

    // ✅ Reset input user
    $this->reset(['selectedMatkul', 'totalSks']);

    // ✅ Ambil ulang SKS dari database untuk real-time akurat
    $this->totalSks = $mahasiswa->krs()
        ->where('semester', $this->semester)
        ->with('matakuliah')
        ->get()
        ->sum(fn ($krs) => $krs->matakuliah->sks ?? 0);

    session()->flash('success', 'KRS berhasil disimpan.');
}


    public function render()
    {
        return view('livewire.krsmhs');
    }
}

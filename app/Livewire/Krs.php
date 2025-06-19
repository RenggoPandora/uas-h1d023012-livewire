<?php

namespace App\Livewire;

use App\Models\Fakultas;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Collection;

class Krs extends Component
{
    public $selectedFakultas = null;
    public $selectedSemester = null;

    public $listFakultas;
    public $listSemester = [1,2,3,4,5,6,7,8];

    public function mount()
    {
        $this->listFakultas = Fakultas::all();
    }

    public function updatedSelectedFakultas()
    {
        // Trigger render
    }

    public function updatedSelectedSemester()
    {
        // Trigger render
    }

    public function render()
    {
        $query = Mahasiswa::with(['prodi.fakultas', 'krs.matakuliah'])
            ->where('status', 'aktif');

        if ($this->selectedFakultas) {
            $query->whereHas('prodi.fakultas', function ($q) {
                $q->where('id', $this->selectedFakultas);
            });
        }

        $mahasiswaList = $query->get()->map(function ($mhs) {
            $mhs->current_semester = $mhs->semester;
            $mhs->sks_semester_ini = $mhs->krs
                ->where('semester', $mhs->semester)
                ->map(fn($krs) => $krs->matakuliah->sks ?? 0)
                ->sum();
            return $mhs;
        });

        if ($this->selectedSemester) {
            $mahasiswaList = $mahasiswaList->where('current_semester', $this->selectedSemester);
        }

        return view('livewire.krs', [
            'mahasiswaList' => $mahasiswaList,
        ]);
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Mahasiswa;
use App\Models\Fakultas;

class MahasiswaList extends Component
{
    public $fakultas_id = '';
    public $semester = '';

    public function render()
    {
        $query = Mahasiswa::query()->with('prodi.fakultas');

        if ($this->fakultas_id != '') {
            $query->whereHas('prodi.fakultas', function ($q) {
                $q->where('id', $this->fakultas_id);
            });
        }

        // Ambil semua mahasiswa, lalu filter manual berdasarkan semester saat ini
        $mahasiswas = $query->get()->filter(function ($mhs) {
            return $this->semester === '' || $mhs->semester == $this->semester;
        });

        return view('livewire.mahasiswa-list', [
            'mahasiswas' => $mahasiswas,
            'fakultasList' => Fakultas::all(),
        ]);
    }
}

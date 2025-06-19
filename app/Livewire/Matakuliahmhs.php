<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Mahasiswa;
use App\Models\Krs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Matakuliahmhs extends Component
{
    public $matkulDiambil = [];
    public $semester;

    public function mount()
    {
        $mahasiswa = Mahasiswa::where('email', Auth::user()->email)->firstOrFail();
        $this->semester = $mahasiswa->semester;

        $this->matkulDiambil = Krs::with('matakuliah')
            ->where('mahasiswa_id', $mahasiswa->id)
            ->where('semester', $this->semester)
            ->get();
    }

    public function resetKrs()
    {
        $mahasiswa = Mahasiswa::where('email', Auth::user()->email)->first();

        if (!$mahasiswa) {
            session()->flash('error', 'Data mahasiswa tidak ditemukan');
            return;
        }

        Krs::where('mahasiswa_id', $mahasiswa->id)
            ->where('semester', $this->semester)
            ->delete();

        session()->flash('success', 'KRS berhasil direset');

        // Refresh data
        $this->matkulDiambil = [];
    }

    public function render()
    {
        return view('livewire.matakuliahmhs');
    }
}

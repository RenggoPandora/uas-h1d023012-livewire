<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Matakuliah;
use Flux\Flux;

class CreateMk extends Component
{
    public $kode, $nama_mk, $sks, $tipe;

    public function store()
    {
        $this->validate([
            'kode' => 'required|string|unique:matakuliah,kode',
            'nama_mk' => 'required|string',
            'sks' => 'required|integer|min:1|max:6',
            'tipe' => 'required|in:wajib,pilihan',
        ]);

        Matakuliah::create([
            'kode' => $this->kode,
            'nama_mk' => $this->nama_mk,
            'sks' => $this->sks,
            'tipe' => $this->tipe,
        ]);

        Flux::modal('create-mk')->close();
        session()->flash('success', 'Matakuliah berhasil ditambahkan');
        return redirect()->route('matakuliah');
    }

    public function render()
    {
        return view('livewire.create-mk');
    }
}

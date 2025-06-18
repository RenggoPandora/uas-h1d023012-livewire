<?php

namespace App\Livewire;

use App\Models\Prodi;
use App\Models\Fakultas;
use Livewire\Component;
use Flux\Flux;

class CreateProdi extends Component
{
    public $nama_prod;
    public $fakultas_id;
    public $fakultasList = [];

    protected function rules()
    {
        return [
            'nama_prod' => 'required|string|unique:prodi,nama_prod',
            'fakultas_id' => 'required|exists:fakultas,id',
        ];
    }

    public function mount()
    {
        $this->fakultasList = Fakultas::all(); // load semua fakultas untuk dropdown
    }

    public function create()
    {
        $this->validate();

        Prodi::create([
            'nama_prod' => $this->nama_prod,
            'fakultas_id' => $this->fakultas_id,
        ]);

        $this->resetForm();
        Flux::modal('create-prodi')->close();
        session()->flash('success', 'Prodi berhasil ditambahkan');

        $this->redirectRoute('prodi');
    }

    public function resetForm()
    {
        $this->reset('nama_prod');
        $this->resetValidation(); // optional, untuk bersihkan error lama
    }

    public function render()
    {
        return view('livewire.create-prodi');
    }
}

<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\Fakultas;
use Flux\Flux;

class CreateFakultas extends Component
{
    public $nama_fak;

    protected $listeners = ['modalClosed' => 'resetForm'];

    protected function rules()
    {
        return [
            'nama_fak' => 'required|string|unique:fakultas,nama_fak'
        ];
    }

    public function messages()
    {
        return [
            'nama_fak.required' => 'Nama fakultas harus diisi',
            'nama_fak.unique' => 'Nama fakultas sudah digunakan',
        ];
    }

    public function create()
    {
        $this->validate();

        Fakultas::create([
            'nama_fak' => $this->nama_fak,
        ]);

        $this->resetForm();
        Flux::modal('create-fakultas')->close();
        session()->flash('success', 'Fakultas berhasil ditambahkan');

        $this->redirectRoute('fakultas');
    }

    public function resetForm()
    {
        $this->reset('nama_fak');
        $this->resetValidation(); // optional, untuk bersihkan error lama
    }

    public function render()
    {
        return view('livewire.create-fakultas');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Prodi as ProdiModel;
use App\Models\Fakultas;
use Flux\Flux;
use Livewire\Attributes\On;

class EditProdi extends Component
{

    public $prodId, $nama_prod, $fakultas_id;
    public $fakultasList = [];

    #[On('edit-prodi')]

    public function edit($id)
    {
        //dd("edit on this {$id}");
        $prodi = ProdiModel::findOrFail($id);
        $this->prodId = $id;
        $this->nama_prod = $prodi->nama_prod;
        $this->fakultas_id = $prodi->fakultas_id;
        Flux::modal('edit-prodi')->show();
    }

    public function update()
    {
        $this->validate([
            'nama_prod' => 'required',
            'fakultas_id' => 'required',
        ]);

        $prodi = ProdiModel::findOrFail($this->prodId);
        $prodi-> nama_prod = $this->nama_prod;
        $prodi-> fakultas_id = $this->fakultas_id;
        $prodi->save();

        Flux::modal('edit-prodi')->close();
        session()->flash('success', 'Prodi berhasil diperbarui');
        $this->redirectRoute('prodi');
        
    }

    public function mount()
    {
        $this->fakultasList = Fakultas::all();
    }
    public function render()
    {
        return view('livewire.edit-prodi');
    }
}


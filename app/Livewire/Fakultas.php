<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Fakultas as FakultasModel;

class Fakultas extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.fakultas', [
            'fakultas' => FakultasModel::paginate(8)
        ]);
    }

    public function edit($id)
    {
        $fakultas = FakultasModel::find($id);
        //dd($id);
        $this->dispatch('edit-fakultas', $id);
    }
}

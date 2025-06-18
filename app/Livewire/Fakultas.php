<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Fakultas as FakultasModel;
use Flux\Flux;

class Fakultas extends Component
{
    use WithPagination;

    public $fakId;

    public function render()
    {
        return view('livewire.fakultas', [
            'fakultas' => FakultasModel::paginate(8)
        ]);
    }

    public function delete($id){
        //dd($id);
        $this->fakId = $id;
        Flux::modal('delete-fakultas')->show();
    }

    public function deleteFakultas()
    {
        FakultasModel::find($this->fakId)->delete();
        Flux::modal('delete-fakultas')->close();
           session()->flash('success', 'Fakultas berhasil dihapus');
           $this->redirectRoute('fakultas');
    }
}

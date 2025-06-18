<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Prodi as ProdiModels;
use Flux\Flux;

class Prodi extends Component
{
    public $prodId;
    public function render()
    {
        return view('livewire.prodi', [
            'prodi' => ProdiModels::paginate(8)
        ]);
    }

    public function delete($id){
        //dd($id);
        $this->prodId = $id;
        Flux::modal('delete-prodi')->show();
    }

    public function deleteProdi()
    {
        ProdiModels::find($this->prodId)->delete();
        Flux::modal('delete-prodi')->close();
           session()->flash('success', 'Fakultas berhasil dihapus');
           $this->redirectRoute('prodi');
    }
}

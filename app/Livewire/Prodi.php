<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Prodi as ProdiModels;
use Flux\Flux;
use Livewire\WithPagination;

class Prodi extends Component
{
    use WithPagination;
    
    public $prodId;
    public $nama_prod;
    public $fakultas_id;
    public $fakultasList = [];
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

    protected $listeners = ['editProdi' => 'setProdi'];

    public function edit($id)
{
    //dd($id);
    $this->dispatch('edit-prodi', $id);
}


}

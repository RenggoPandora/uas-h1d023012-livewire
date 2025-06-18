<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Matakuliah as MatakuliahModel;
use Flux\Flux;
use Livewire\WithPagination;

class Matakuliah extends Component
{
    use WithPagination;

    public $mkId;
    public $kode, $nama_mk, $sks, $tipe;

    public function render()
    {
        return view('livewire.matakuliah', [
            'matakuliah' => MatakuliahModel::paginate(8)
        ]);
    }

    public function delete($id)
    {
        $this->mkId = $id;
        Flux::modal('delete-mk')->show();
    }

    public function deleteMatakuliah()
    {
        MatakuliahModel::findOrFail($this->mkId)->delete();
        Flux::modal('delete-mk')->close();
        session()->flash('success', 'Matakuliah berhasil dihapus');
        return redirect()->route('matakuliah');
    }

    public function edit($id)
    {
        $this->dispatch('edit-mk', $id);
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Mahasiswa as MahasiswaModel;
use Flux\Flux;
use Livewire\WithPagination;

class Mahasiswa extends Component
{
    use WithPagination;

    public $mhsId;

    public function render()
    {
        return view('livewire.mahasiswa', [
            'mahasiswa' => MahasiswaModel::with('prodi')->paginate(8),
        ]);
    }

    public function delete($id)
    {
        $this->mhsId = $id;
        Flux::modal('delete-mahasiswa')->show();
    }

    public function deleteMahasiswa()
    {
        MahasiswaModel::findOrFail($this->mhsId)->delete();
        Flux::modal('delete-mahasiswa')->close();
        session()->flash('success', 'Mahasiswa berhasil dihapus');
        return redirect()->route('mahasiswa');
    }

    public function edit($id)
    {
        $this->dispatch('edit-mahasiswa', $id);
    }
}

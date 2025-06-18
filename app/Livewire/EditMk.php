<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Matakuliah as MatakuliahModel;
use Flux\Flux;
use Livewire\Attributes\On;

class EditMk extends Component
{
    public $mkId, $kode, $nama_mk, $sks, $tipe;

    #[On('edit-mk')]
    public function edit($id)
    {
        $mk = MatakuliahModel::findOrFail($id);
        $this->mkId = $mk->id;
        $this->kode = $mk->kode;
        $this->nama_mk = $mk->nama_mk;
        $this->sks = $mk->sks;
        $this->tipe = $mk->tipe;

        Flux::modal('edit-mk')->show();
    }

    public function update()
    {
        $this->validate([
            'kode' => 'required|string|unique:matakuliah,kode,' . $this->mkId,
            'nama_mk' => 'required|string',
            'sks' => 'required|integer|min:1|max:6',
            'tipe' => 'required|in:wajib,pilihan',
        ]);

        $matakuliah = MatakuliahModel::findOrFail($this->mkId);
        $matakuliah-> kode = $this->kode;
        $matakuliah-> nama_mk = $this->nama_mk;
        $matakuliah-> sks = $this->sks;
        $matakuliah-> tipe = $this->tipe;
        $matakuliah->save();

        Flux::modal('edit-mk')->close();
        session()->flash('success', 'Matakuliah berhasil diperbarui');
        $this->redirectRoute('matakuliah');
    }

    public function render()
    {
        return view('livewire.edit-mk');
    }
}

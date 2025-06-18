<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Mahasiswa as MahasiswaModel;
use App\Models\Prodi;
use App\Models\Fakultas;
use Carbon\Carbon;
use Flux\Flux;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;

class EditMahasiswa extends Component
{
    public $mhsId, $nama_mhs, $email, $prodi_id, $status, $tanggal_masuk_mhs, $angkatan;
    public $listProdi = [];

    #[On('edit-mahasiswa')]
    public function edit($id)
    {
        $mhs = MahasiswaModel::findOrFail($id);
        $this->mhsId = $mhs->id;
        $this->nama_mhs = $mhs->nama_mhs;
        $this->email = $mhs->email;
        $this->prodi_id = $mhs->prodi_id;
        $this->status = $mhs->status;
        $this->angkatan = date('Y', strtotime($mhs->tanggal_masuk_mhs));


        $this->listProdi = Prodi::all();
        Flux::modal('edit-mahasiswa')->show();
    }

    public function update()
{
    Log::debug('Update method triggered');

    $this->validate([
        'nama_mhs' => 'required|string',
        'email' => 'required|email|unique:mahasiswa,email,' . $this->mhsId,
        'prodi_id' => 'required|exists:prodi,id',
        'angkatan' => 'required|digits:4|integer|min:2000|max:' . now()->year,
    ]);

    Log::debug('Validasi update berhasil');

    // Ambil data mahasiswa yang akan di-update
    $mahasiswa = MahasiswaModel::findOrFail($this->mhsId);

    // Ambil data prodi & fakultas
    $prodi = Prodi::with('fakultas')->find($this->prodi_id);
    $fakultasId = $prodi?->fakultas?->id ?? '0';

    // Hitung jumlah mahasiswa yang masuk pada tahun angkatan ini
    $jumlah = MahasiswaModel::whereYear('tanggal_masuk_mhs', $this->angkatan)->count();

    // Jika data yang di-edit adalah bagian dari perhitungan, kurangi 1
    if (Carbon::parse($mahasiswa->tanggal_masuk_mhs)->format('Y') == $this->angkatan) {
    $jumlah -= 1;
    }
    $jumlah += 1;

    // Generate ulang NIM
    $nim = str_pad($fakultasId, 1, '0', STR_PAD_LEFT) .
           str_pad($this->prodi_id, 1, '0', STR_PAD_LEFT) .
           substr($this->angkatan, -2) .
           str_pad($jumlah, 3, '0', STR_PAD_LEFT);

    Log::debug("NIM yang diregenerate: {$nim}");

    // Update data mahasiswa
    $mahasiswa->update([
        'nim' => $nim,
        'nama_mhs' => $this->nama_mhs,
        'email' => $this->email,
        'prodi_id' => $this->prodi_id,
        'tanggal_masuk_mhs' => $this->angkatan . '-08-20',
    ]);

    Log::debug('Data mahasiswa berhasil diperbarui');

    \Flux\Flux::modal('edit-mahasiswa')->close();
    session()->flash('success', 'Data mahasiswa berhasil diperbarui');
    return redirect()->route('mahasiswa');
}


    public function render()
    {
        return view('livewire.edit-mahasiswa');
    }
}

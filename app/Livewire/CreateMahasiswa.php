<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Fakultas;
use Flux\Flux;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class CreateMahasiswa extends Component
{
    public $nama_mhs, $email, $angkatan, $prodi_id, $fakultas_id;
    public $listProdi = [], $listFakultas = [];

    public function mount()
    {
        $this->listFakultas = Fakultas::pluck('nama_fak', 'id')->toArray();
        $this->listProdi = Prodi::all();
    }

public function store()
{
    Log::debug('Store method triggered');
    
    $this->validate([
        'nama_mhs' => 'required|string',
        'email' => 'required|email|unique:mahasiswa,email',
        'prodi_id' => 'required|exists:prodi,id',
        'angkatan' => 'required|digits:4|integer|min:2000|max:' . now()->year,
    ]);

    Log::debug('Validasi berhasil');

    // Ambil prodi & fakultas terkait
    $prodi = Prodi::with('fakultas')->find($this->prodi_id);
    $fakultasId = $prodi?->fakultas?->id ?? '0';

    Log::debug("Fakultas ID dari relasi: {$fakultasId}");

    // Hitung jumlah mahasiswa di tahun angkatan yang sama
    $jumlah = Mahasiswa::whereYear('tanggal_masuk_mhs', $this->angkatan)->count() + 1;

    // Format NIM: FakultasID (1 digit) + ProdiID (1 digit) + Tahun (2 digit) + Urutan (3 digit)
    $nim = str_pad($fakultasId, 1, '0', STR_PAD_LEFT) .
           str_pad($this->prodi_id, 1, '0', STR_PAD_LEFT) .
           substr($this->angkatan, -2) .
           str_pad($jumlah, 3, '0', STR_PAD_LEFT);

    Log::debug("NIM yang dihasilkan: {$nim}");

    Mahasiswa::create([
        'nim' => $nim,
        'nama_mhs' => $this->nama_mhs,
        'email' => $this->email,
        'prodi_id' => $this->prodi_id,
        'tanggal_masuk_mhs' => $this->angkatan . '-08-20',
        'status' => 'aktif',
    ]);

    Log::debug('Data mahasiswa berhasil disimpan ke database');

    
    \Flux\Flux::modal('create-mahasiswa')->close();
    session()->flash('success', 'Mahasiswa berhasil ditambahkan');
    Log::debug('Store method selesai dengan sukses');
    return redirect()->route('mahasiswa');
}



    public function render()
    {
        return view('livewire.create-mahasiswa');
    }
}

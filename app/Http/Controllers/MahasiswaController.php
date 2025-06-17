<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|unique:mahasiswa,email',
            'password' => 'required|string|min:8|confirmed',
            'fakultas_id' => 'required|exists:fakultas,id',
            'prodi_id' => 'required|exists:prodi,id',
            'angkatan' => 'required|integer|min:2000|max:' . date('Y'),
        ]);

        $user = User::create([
            'name' => $validated['nama'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'mhs',
        ]);

        $jumlah = Mahasiswa::whereYear('tanggal_masuk_mhs', $validated['angkatan'])->count() + 1;

        $nim = 
            str_pad($validated['fakultas_id'], 1, '0', STR_PAD_LEFT) .
            str_pad($validated['prodi_id'], 1, '0', STR_PAD_LEFT) .
            substr($validated['angkatan'], -2) .
            str_pad($jumlah, 3, '0', STR_PAD_LEFT);

        $tanggalMasuk = $validated['angkatan'] . '-08-20';

        Mahasiswa::create([
            'nim' => $nim,
            'nama_mhs' => $validated['nama'],
            'email' => $validated['email'],
            'prodi_id' => $validated['prodi_id'],
            'tanggal_masuk_mhs' => $tanggalMasuk,
            'status' => 'aktif',
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil didaftarkan.');
    }
}

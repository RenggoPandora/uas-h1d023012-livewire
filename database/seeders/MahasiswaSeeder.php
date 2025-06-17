<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        Mahasiswa::insert([
            [
                'nim' => 'H1D023001',
                'nama_mhs' => 'Budi Santoso',
                'email' => 'budi@gmail.com',
                'prodi_id' => 1,
                'tanggal_masuk_mhs' => '2023-08-20',
                'status' => 'aktif',
            ],
            [
                'nim' => 'H1D022002',
                'nama_mhs' => 'Siti Aminah',
                'email' => 'siti@gmail.com',
                'prodi_id' => 2,
                'tanggal_masuk_mhs' => '2022-08-20',
                'status' => 'aktif',
            ],
        ]);
    }
}


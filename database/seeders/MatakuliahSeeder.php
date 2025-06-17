<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Matakuliah;

class MatakuliahSeeder extends Seeder
{
    public function run()
    {
        Matakuliah::insert([
            ['kode' => 'MK001', 'nama_mk' => 'Pemrograman Dasar', 'sks' => 3, 'tipe' => 'wajib'],
            ['kode' => 'MK002', 'nama_mk' => 'Sistem Basis Data', 'sks' => 3, 'tipe' => 'wajib'],
            ['kode' => 'MK003', 'nama_mk' => 'Kewirausahaan', 'sks' => 2, 'tipe' => 'pilihan'],
        ]);
    }
}


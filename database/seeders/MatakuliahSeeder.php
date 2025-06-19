<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Matakuliah;

class MatakuliahSeeder extends Seeder
{
    public function run()
    {
        Matakuliah::insert([
            ['kode' => 'MK001', 'nama_mk' => 'Pemrograman Dasar', 'sks' => 3, 'tipe' => 'wajib', 'semester' => 1],
            ['kode' => 'MK002', 'nama_mk' => 'Sistem Basis Data', 'sks' => 3, 'tipe' => 'wajib', 'semester' => 1],
            ['kode' => 'MK003', 'nama_mk' => 'Kewirausahaan', 'sks' => 2, 'tipe' => 'pilihan', 'semester' => 1],
            ['kode' => 'MK004', 'nama_mk' => 'Pemrograman Web I', 'sks' => 3, 'tipe' => 'wajib', 'semester' => 1],
            ['kode' => 'MK005', 'nama_mk' => 'Sistem Basis Data I', 'sks' => 3, 'tipe' => 'wajib', 'semester' => 1],
            ['kode' => 'MK006', 'nama_mk' => 'Bahasa Indonesia', 'sks' => 2, 'tipe' => 'pilihan', 'semester' => 2],
            ['kode' => 'MK007', 'nama_mk' => 'Pemrograman Web II', 'sks' => 3, 'tipe' => 'wajib', 'semester' => 2],
            ['kode' => 'MK008', 'nama_mk' => 'Sistem Basis Data II', 'sks' => 3, 'tipe' => 'wajib', 'semester' => 2],
            ['kode' => 'MK009', 'nama_mk' => 'Bahasa Inggris', 'sks' => 2, 'tipe' => 'pilihan', 'semester' => 2],
            ['kode' => 'MK010', 'nama_mk' => 'Pemrograman Web III', 'sks' => 3, 'tipe' => 'wajib', 'semester' => 2],
            ['kode' => 'MK011', 'nama_mk' => 'Sistem Basis Data III', 'sks' => 3, 'tipe' => 'wajib', 'semester' => 3],
            ['kode' => 'MK012', 'nama_mk' => 'Bahasa Inggris', 'sks' => 2, 'tipe' => 'pilihan', 'semester' => 3],
            ['kode' => 'MK013', 'nama_mk' => 'Pemrograman Web IV', 'sks' => 3, 'tipe' => 'wajib', 'semester' => 3],

        ]);
    }
}


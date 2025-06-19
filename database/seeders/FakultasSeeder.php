<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fakultas;

class FakultasSeeder extends Seeder
{
    public function run()
    {
        Fakultas::insert([
            ['nama_fak' => 'Fakultas Teknik'],
            ['nama_fak' => 'Fakultas Ekonomi dan Bisnis'],
            ['nama_fak' => 'Fakultas Kedokteran'],
            ['nama_fak' => 'Fakultas Ilmu Sosial dan Politik'],
            ['nama_fak' => 'Fakultas Ilmu Kesehatan'],
            ['nama_fak' => 'Fakultas Biologi'],
            ['nama_fak' => 'Fakultas Perikanan'],
            ['nama_fak' => 'Fakultas Matematika dan Ilmu Pengetahuan Alam'],
        ]);
    }
}



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
            ['nama_fak' => 'Fakultas Ekonomi'],
            ['nama_fak' => 'Fakultas Ilmu Komputer'],
        ]);
    }
}



<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prodi;

class ProdiSeeder extends Seeder
{
    public function run()
    {
        Prodi::insert([
            ['nama_prod' => 'Teknik Informatika', 'fakultas_id' => 1],
            ['nama_prod' => 'Kedokteran Umum', 'fakultas_id' => 3],
            ['nama_prod' => 'Teknik Mesin', 'fakultas_id' => 1],
        ]);
    }
}


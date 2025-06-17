<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\FakultasSeeder;
use Database\Seeders\ProdiSeeder;
use Database\Seeders\MahasiswaSeeder;
use Database\Seeders\MatakuliahSeeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([
        FakultasSeeder::class,
        ProdiSeeder::class,
        MahasiswaSeeder::class,
        MatakuliahSeeder::class,
        UserSeeder::class,
    ]);
    }
}

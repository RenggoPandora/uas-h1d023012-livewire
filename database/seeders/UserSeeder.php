<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('qwerty123'),
            'role' => 'admin'
        ]);

        User::create([
            'email' => 'budi@gmail.com',
            'password' => Hash::make('qwerty123'), // Password default, bisa diganti
            'role' => 'mhs'
        ]);
    }
}


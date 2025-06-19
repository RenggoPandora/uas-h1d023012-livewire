<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Middleware\RoleMiddleware;
use App\Livewire\Fakultas;
use App\Livewire\Krs;
use App\Livewire\Krsmhs;
use App\Livewire\Mahasiswa;
use App\Livewire\Matakuliah;
use App\Livewire\Matakuliahmhs;
use App\Livewire\Prodi;
use Illuminate\Support\Facades\Log;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Admin Routes (Role: admin)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', \App\Http\Middleware\RoleMiddleware::class.':admin'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // Admin Subpages
    Route::get('dashboard/prodi', Prodi::class)->name('prodi');
    Route::get('dashboard/fakultas', Fakultas::class)->name('fakultas');
    Route::get('dashboard/matakuliah', Matakuliah::class)->name('matakuliah');
    Route::get('dashoard/mahasiswa', Mahasiswa::class)->name('mahasiswa');
    Route::get('dashboard/krs', Krs::class)->name('krs');
});

/*
|--------------------------------------------------------------------------
| Mahasiswa Routes (Role: mhs)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', \App\Http\Middleware\RoleMiddleware::class.':mhs'])->group(function () {
    Route::view('home', 'home')->name('home');

    // Mhs Subpages
    Route::get('home/matakuliah', Matakuliahmhs::class)->name('matakuliahmhs');
    Route::get('home/krs', Krsmhs::class)->name('krsmhs');
});

/*
|--------------------------------------------------------------------------
| User Settings Routes (All Authenticated Users)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::get('/logtest', function () {
    Log::info('Coba log jalan!');
    return 'Log ditulis';
});


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Middleware\RoleMiddleware;

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
    Route::view('dashboard/prodi', 'prodi')->name('prodi');
    Route::view('dashboard/fakultas', 'fakultas')->name('fakultas');
    Route::view('dashboard/matakuliah', 'matakuliah')->name('matakuliah');
    Route::view('dashboard/mahasiswa', 'mahasiswa')->name('mahasiswa');
    Route::view('dashboard/krs', 'krs')->name('krs');
});

/*
|--------------------------------------------------------------------------
| Mahasiswa Routes (Role: mhs)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', \App\Http\Middleware\RoleMiddleware::class.':mhs'])->group(function () {
    Route::view('mhs/dashboard', 'mhs.dashboard')->name('mhs.dashboard');

    Route::view('mhs/dashboard/matakuliah', 'mhs.matakuliah')->name('mhs.matakuliah');
    Route::view('mhs/dashboard/krs', 'mhs.krs')->name('mhs.krs');
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

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

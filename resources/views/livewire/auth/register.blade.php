<?php

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $angkatan = '';
    public string $fakultas_id = '';
    public string $prodi_id = '';

    public array $listFakultas = [];
    public array $listProdi = [];

    public function mount()
    {
        $this->listFakultas = Fakultas::pluck('nama_fak', 'id')->toArray();
        $this->listProdi = Prodi::pluck('nama_prod', 'id')->toArray();
    }

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email', 'unique:mahasiswa,email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'angkatan' => ['required', 'integer', 'min:2000', 'max:' . date('Y')],
            'fakultas_id' => ['required', 'exists:fakultas,id'],
            'prodi_id' => ['required', 'exists:prodi,id'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'mhs',
        ]);

        $jumlah = Mahasiswa::whereYear('tanggal_masuk_mhs', $validated['angkatan'])->count() + 1;
        $nim = str_pad($validated['fakultas_id'], 1, '0', STR_PAD_LEFT) .
               str_pad($validated['prodi_id'], 1, '0', STR_PAD_LEFT) .
               substr($validated['angkatan'], -2) .
               str_pad($jumlah, 3, '0', STR_PAD_LEFT);

        Mahasiswa::create([
            'nim' => $nim,
            'nama_mhs' => $validated['name'],
            'email' => $validated['email'],
            'prodi_id' => $validated['prodi_id'],
            'tanggal_masuk_mhs' => $validated['angkatan'] . '-08-20',
            'status' => 'aktif',
        ]);

        event(new Registered($user));
        Auth::login($user);

        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <flux:input wire:model="name" :label="__('Nama')" type="text" required autofocus autocomplete="name" />

        <flux:input wire:model="email" :label="__('Email address')" type="email" required autocomplete="email" placeholder="email@example.com" />

        <flux:input wire:model="password" :label="__('Password')" type="password" required autocomplete="new-password" viewable />

        <flux:input wire:model="password_confirmation" :label="__('Confirm password')" type="password" required autocomplete="new-password" viewable />

        <flux:input wire:model="angkatan" :label="__('Angkatan')" type="number" required placeholder="Contoh: 2023" />

        <div>
            <label for="fakultas_id" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Fakultas</label>
            <select wire:model="fakultas_id" id="fakultas_id" class=" bg-zinc-50 dark:bg-zinc-800 w-full px-3 py-2 border rounded">
                <option value="">-- Pilih Fakultas --</option>
                @foreach($listFakultas as $id => $nama)
                    <option value="{{ $id }}">{{ $nama }}</option>
                @endforeach
            </select>
            @error('fakultas_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="prodi_id" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Program Studi</label>
            <select wire:model="prodi_id" id="prodi_id" class="bg-zinc-50 dark:bg-zinc-800 w-full px-3 py-2 border rounded">
                <option value="">-- Pilih Prodi --</option>
                @foreach($listProdi as $id => $nama)
                    <option value="{{ $id }}">{{ $nama }}</option>
                @endforeach
            </select>
            @error('prodi_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Create account') }}
            </flux:button>
        </div>
    </form>

    <div class="text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Already have an account?') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
    </div>
</div>

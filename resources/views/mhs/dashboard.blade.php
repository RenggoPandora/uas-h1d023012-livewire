<x-layouts.app :title="__('Dashboard Mahasiswa')">
    <div x-data="{ darkMode: $persist(false) }" 
         x-init="$watch('darkMode', val => document.documentElement.classList.toggle('dark', val))" 
         class="space-y-4">

        <!-- Toggle Dark Mode -->
        <div class="flex justify-end">
            <button 
                x-on:click="darkMode = !darkMode"
                class="flex items-center gap-2 px-4 py-2 rounded-lg border text-sm font-medium 
                       bg-white text-gray-700 border-gray-300 hover:bg-gray-100 
                       dark:bg-neutral-800 dark:text-white dark:border-neutral-600 dark:hover:bg-neutral-700 transition"
            >
                <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                          d="M12 3v1m0 16v1m8.66-12.66l-.707.707M4.05 19.95l-.707-.707m16.97 0l-.707.707M4.05 4.05l.707.707M21 12h-1M4 12H3m9-9a9 9 0 100 18 9 9 0 000-18z"/>
                </svg>
                <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                          d="M21.752 15.002A9.718 9.718 0 0112 21.75a9.75 9.75 0 010-19.5c.457 0 .906.031 1.344.092a.75.75 0 01.345 1.318 7.501 7.501 0 004.127 13.342.75.75 0 01.936.764z"/>
                </svg>
                <span x-text="darkMode ? 'Dark Mode' : 'Light Mode'"></span>
            </button>
        </div>

        <!-- Dashboard Mahasiswa Content -->
        <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
            <div class="p-4 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-neutral-800">
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">
                    Selamat datang, {{ auth()->user()->name }}!
                </h1>
                <p class="text-zinc-600 dark:text-zinc-300 mt-2">
                    Ini adalah dashboard mahasiswa. Silakan akses fitur-fitur yang tersedia dari menu di samping.
                </p>
            </div>
        </div>
    </div>
</x-layouts.app>

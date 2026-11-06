<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('styles')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-slate-100">
    <div class="flex h-screen bg-gray-100">
        {{-- SIDEBAR --}}
        <div class="hidden md:flex flex-col w-64 bg-slate-800">
            <a href="{{ route('dashboard') }}" class="flex items-center justify-center h-16 bg-slate-900 hover:bg-slate-700 transition-colors duration-300">
                <img src="{{ asset('images/logo.png') }}" class="bg-white p-1 rounded-md h-9 w-auto mr-2" alt="Logo">
                <span class="text-white font-bold uppercase">RSUD Lembang</span>
            </a>
            <div class="flex flex-col flex-1 overflow-y-auto">
                <nav class="flex-1 px-2 py-4 bg-slate-800">
                    {{-- MENU UTAMA --}}
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 text-gray-100 {{ request()->routeIs('dashboard') ? 'bg-slate-700' : '' }} rounded-md hover:bg-slate-700 hover:text-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" /></svg>
                        Dashboard
                    </a>
                    
                    <p class="px-4 mt-4 mb-2 text-xs font-semibold tracking-wider text-gray-400 uppercase">Manajemen</p>
                    
              
                    <a href="{{ route('surat-masuk.index') }}" class="flex items-center justify-between px-4 py-2 mt-2 rounded-md hover:bg-slate-700 hover:text-gray-100 {{ request()->routeIs('surat-masuk.*') ? 'bg-slate-700 text-gray-100' : 'text-gray-300' }}">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M12 12a4 4 0 100-8 4 4 0 000 8z" /></svg>
                            <span>Surat Masuk</span>
                        </div>
                        @if(isset($notif_surat_masuk) && $notif_surat_masuk > 0)
                            <span class="ml-2 px-2 py-0.5 text-xs font-semibold text-white bg-red-500 rounded-full">
                                {{ $notif_surat_masuk }}
                            </span>
                        @endif
                    </a>
                   

                    <a href="{{ route('surat-keluar.index') }}" class="flex items-center px-4 py-2 mt-2 rounded-md hover:bg-slate-700 hover:text-gray-100 {{ request()->routeIs('surat-keluar.*') ? 'bg-slate-700 text-gray-100' : 'text-gray-300' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        Surat Keluar
                    </a>
                    
                    {{-- MENU KHUSUS ADMIN --}}
                    @if (Auth::user()->role === 'admin')
                        <p class="px-4 mt-4 mb-2 text-xs font-semibold tracking-wider text-gray-400 uppercase">Admin Area</p>
                        <a href="{{ route('users.index') }}" class="flex items-center px-4 py-2 mt-2 rounded-md hover:bg-slate-700 hover:text-gray-100 {{ request()->routeIs('users.*') ? 'bg-slate-700 text-gray-100' : 'text-gray-300' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                            Manajemen User
                        </a>
                        <a href="{{ route('laporan.index') }}" class="flex items-center px-4 py-2 mt-2 rounded-md hover:bg-slate-700 {{ request()->routeIs('laporan.*') ? 'bg-slate-700 text-gray-100' : 'text-gray-300' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            Laporan
                        </a>
                        <a href="{{ route('logs.index') }}" class="flex items-center px-4 py-2 mt-2 rounded-md hover:bg-slate-700 {{ request()->routeIs('logs.index') ? 'bg-slate-700 text-gray-100' : 'text-gray-300' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            Manajemen Log
                        </a>
                    @endif
                </nav>
            </div>
        </div>

        {{-- KONTEN UTAMA --}}
        <div class="flex flex-col flex-1 overflow-y-auto">
            <div class="flex items-center justify-between h-16 bg-white border-b border-gray-200">
                <div class="flex items-center px-4">
                    <h1 class="text-lg font-semibold">@yield('title', 'Dashboard')</h1>
                </div>
                
                {{-- Dropdown Profil Pengguna --}}
                <div class="flex items-center pr-4">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out">
                                <img class="h-8 w-8 rounded-full object-cover mr-2" 
                                     src="{{ Auth::user()->foto_profil ? Storage::url(Auth::user()->foto_profil) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=EBF4FF&color=7F9CF5' }}" 
                                     alt="{{ Auth::user()->name }}">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
            
            <div class="p-4 md:p-8">
                @yield('content')
            </div>
        </div>
    </div>
    
    @stack('scripts')
</body>
</html>


@extends('layouts.guest')

@section('content')
<div class="grid w-full max-w-4xl grid-cols-1 bg-white shadow-2xl rounded-2xl md:grid-cols-2 overflow-hidden">

    <div class="animated-gradient flex-col justify-center p-12 text-center text-white bg-gradient-to-br from-blue-800 via-slate-900 to-blue-800 hidden md:flex">
        <img src="{{ asset('images/logo.png') }}" alt="Logo RSUD" class="w-40 mx-auto mb-4">
        <h1 class="text-3xl font-bold leading-tight">Sistem Surat & Arsip</h1>
        <p class="mt-2 text-blue-200">RSUD Lembang</p>
    </div>

    <div class="flex flex-col justify-center p-12">
        <div class="w-full">
            <h2 class="mb-2 text-3xl font-bold text-gray-900">
                Register Akun
            </h2>
            <p class="mb-8 text-sm text-gray-600">
                Buat akun baru untuk menggunakan sistem.
            </p>

            {{-- Menampilkan error validasi jika ada --}}
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-200 rounded-lg">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf
                
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Nama</label>
                    <input id="name" name="name" type="text" required autofocus
                           class="block w-full px-4 py-3 text-gray-900 placeholder-gray-500 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-800"
                           placeholder="Nama Lengkap" value="{{ old('name') }}">
                </div>

                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" required
                           class="block w-full px-4 py-3 text-gray-900 placeholder-gray-500 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-800"
                           placeholder="nama@email.com" value="{{ old('email') }}">
                </div>

                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <input id="password" name="password" type="password" required
                               class="block w-full px-4 py-3 pr-10 text-gray-900 placeholder-gray-500 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-800"
                               placeholder="••••••••">
                        <span onclick="togglePassword('password', 'eye-icon-1', 'eye-slash-icon-1')" class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer">
                            <svg id="eye-icon-1" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-gray-600" viewBox="0 0 20 20" fill="currentColor"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z" /><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.022 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" /></svg>
                            <svg id="eye-slash-icon-1" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-gray-600 hidden" viewBox="0 0 20 20" fill="currentColor"><path d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074L3.707 2.293zM10 12a2 2 0 110-4 2 2 0 010 4z" /><path d="M10 17a9.953 9.953 0 01-4.542-1.074L4.084 17.293A1 1 0 012.67 15.88l14-14a1 1 0 111.414 1.414l-1.928 1.928A9.982 9.982 0 0110 17z" /></svg>
                        </span>
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <div class="relative">
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                               class="block w-full px-4 py-3 pr-10 text-gray-900 placeholder-gray-500 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-800"
                               placeholder="••••••••">
                        <span onclick="togglePassword('password_confirmation', 'eye-icon-2', 'eye-slash-icon-2')" class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer">
                            <svg id="eye-icon-2" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-gray-600" viewBox="0 0 20 20" fill="currentColor"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z" /><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.022 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" /></svg>
                            <svg id="eye-slash-icon-2" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-gray-600 hidden" viewBox="0 0 20 20" fill="currentColor"><path d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074L3.707 2.293zM10 12a2 2 0 110-4 2 2 0 010 4z" /><path d="M10 17a9.953 9.953 0 01-4.542-1.074L4.084 17.293A1 1 0 012.67 15.88l14-14a1 1 0 111.414 1.414l-1.928 1.928A9.982 9.982 0 0110 17z" /></svg>
                        </span>
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="flex justify-center w-full py-3 px-4 mt-4 font-semibold text-white bg-blue-800 rounded-lg hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-800 transition-all duration-300">
                        Register
                    </button>
                </div>
                
                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="font-medium text-blue-800 hover:text-blue-900">
                            Login di sini
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Fungsi ini sekarang akan dipanggil dari layout utama
    function togglePassword(inputId, eyeIconId, eyeSlashIconId) {
        const passwordInput = document.getElementById(inputId);
        const eyeIcon = document.getElementById(eyeIconId);
        const eyeSlashIcon = document.getElementById(eyeSlashIconId);

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.add('hidden');
            eyeSlashIcon.classList.remove('hidden');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('hidden');
            eyeSlashIcon.classList.add('hidden');
        }
    }
</script>
@endsection
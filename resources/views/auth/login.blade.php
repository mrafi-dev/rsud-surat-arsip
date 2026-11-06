@extends('layouts.guest')

@section('content')
<div class="grid w-full max-w-4xl grid-cols-1 bg-white shadow-2xl rounded-2xl md:grid-cols-2 overflow-hidden">

    {{-- Panel kiri --}}
    <div class="animated-gradient flex flex-col justify-center p-12 text-center text-white bg-gradient-to-br from-blue-800 via-slate-900 to-blue-800">
        <img src="{{ asset('images/logo.png') }}" alt="Logo RSUD" class="w-40 mx-auto mb-4">
        <h1 class="text-3xl font-bold leading-tight">Sistem Surat & Arsip</h1>
        <p class="mt-2 text-blue-200">RSUD Lembang</p>
    </div>

    {{-- Panel kanan (form login) --}}
    <div class="flex flex-col justify-center p-12">
        <div class="w-full">
            <h2 class="mb-2 text-3xl font-bold text-gray-900">
                Login Akun
            </h2>
            <p class="mb-8 text-sm text-gray-600">
                Selamat datang kembali!
            </p>

            {{-- Error login --}}
            @if ($errors->any())
                <div class="mb-4">
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            Swal.fire({
                                icon: 'error',
                                title: 'Login Gagal',
                                text: 'Email atau password salah. Silakan coba lagi.',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#1e40af'
                            });
                        });
                    </script>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" required autofocus
                           class="block w-full px-4 py-3 text-gray-900 placeholder-gray-500 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-800 focus:bg-white"
                           placeholder="nama@email.com" value="{{ old('email') }}">
                </div>

                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <input id="password" name="password" type="password" required
                               class="block w-full px-4 py-3 pr-10 text-gray-900 placeholder-gray-500 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-800 focus:bg-white"
                               placeholder="••••••••">
                        
                        <span onclick="togglePassword()" class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer">
                            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-gray-600" viewBox="0 0 20 20" fill="currentColor"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z" /><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.022 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" /></svg>
                            <svg id="eye-slash-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-gray-600 hidden" viewBox="0 0 20 20" fill="currentColor"><path d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074L3.707 2.293zM10 12a2 2 0 110-4 2 2 0 010 4z" /><path d="M10 17a9.953 9.953 0 01-4.542-1.074L4.084 17.293A1 1 0 012.67 15.88l14-14a1 1 0 111.414 1.414l-1.928 1.928A9.982 9.982 0 0110 17z" /></svg>
                        </span>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center text-sm text-gray-600">
                        <input type="checkbox" name="remember" class="h-4 w-4 text-blue-800 border-gray-300 rounded focus:ring-blue-800">
                        <span class="ml-2">Ingat saya</span>
                    </label>
                    {{-- Pop-up lupa password pakai SweetAlert --}}
                    <a href="#" onclick="showForgotPasswordInfo()" class="text-sm font-medium text-blue-800 hover:text-blue-900">
                        Lupa Password?
                    </a>
                </div>

                <div>
                    <button type="submit"
                            class="flex justify-center w-full py-3 px-4 mt-4 font-semibold text-white bg-blue-800 rounded-lg hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-800 transition-all duration-300">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function togglePassword() {
        const password = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        const eyeSlashIcon = document.getElementById('eye-slash-icon');

        if (password.type === 'password') {
            password.type = 'text';
            eyeIcon.classList.add('hidden');
            eyeSlashIcon.classList.remove('hidden');
        } else {
            password.type = 'password';
            eyeIcon.classList.remove('hidden');
            eyeSlashIcon.classList.add('hidden');
        }
    }

    function showForgotPasswordInfo() {
        Swal.fire({
            icon: 'info',
            title: 'Lupa Password?',
            html: 'Jika lupa password, hubungi <b>Admin IT</b> di ruangan atau email <b>it@rsud-lembang.com</b>',
            confirmButtonText: 'Mengerti',
            confirmButtonColor: '#1e40af'
        });
    }
</script>
@endsection

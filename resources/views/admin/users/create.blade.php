@extends('layouts.admin')

@section('title', 'Tambah User Baru')

@section('content')

{{-- ====================================================== --}}
{{-- 			 TAMBAHKAN CSS INI UNTUK HILANGKAN ICON BAWAAN 	 --}}
{{-- ====================================================== --}}
<style>
    /* Sembunyikan icon mata bawaan browser (Edge, Chrome, dll) */
    input[type="password"]::-ms-reveal,
    input[type="password"]::-webkit-password-reveal-button {
        display: none;
        -webkit-appearance: none;
        appearance: none;
    }
</style>

<div class="bg-white p-6 md:p-8 rounded-lg shadow-md">
    <div class="flex items-center mb-6">
        <a href="{{ route('users.index') }}" class="text-indigo-600 hover:text-indigo-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
        </a>
        <h2 class="text-2xl font-bold text-gray-800 ml-4">Formulir Tambah User</h2>
    </div>
    <p class="text-gray-600 mb-6">Isi data di bawah ini untuk membuat akun pengguna baru.</p>

    <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Nama Lengkap</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                </span>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                       class="block w-full px-4 py-3 pl-10 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Alamat Email</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" /><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" /></svg>
                </span>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                       class="block w-full px-4 py-3 pl-10 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            @error('email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-700">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" /></svg>
                    </span>
                    <input type="password" id="password" name="password" required
                           class="block w-full px-4 py-3 pl-10 pr-10 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <span onclick="togglePassword('password', 'eye-1', 'eye-slash-1')" class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer">
                        <svg id="eye-1" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-gray-600" viewBox="0 0 20 20" fill="currentColor"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z" /><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.022 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" /></svg>
                        <svg id="eye-slash-1" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-gray-600 hidden" viewBox="0 0 20 20" fill="currentColor"><path d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074L3.707 2.293zM10 12a2 2 0 110-4 2 2 0 010 4z" /><path d="M10 17a9.953 9.953 0 01-4.542-1.074L4.084 17.293A1 1 0 012.67 15.88l14-14a1 1 0 111.414 1.414l-1.928 1.928A9.982 9.982 0 0110 17z" /></svg>
                    </span>
                </div>
                @error('password') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <div class="relative">
                     <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" /></svg>
                    </span>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                           class="block w-full px-4 py-3 pl-10 pr-10 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <span onclick="togglePassword('password_confirmation', 'eye-2', 'eye-slash-2')" class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer">
                        <svg id="eye-2" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-gray-600" viewBox="0 0 20 20" fill="currentColor"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z" /><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.022 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" /></svg>
                        <svg id="eye-slash-2" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-gray-600 hidden" viewBox="0 0 20 20" fill="currentColor"><path d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074L3.707 2.293zM10 12a2 2 0 110-4 2 2 0 010 4z" /><path d="M10 17a9.953 9.953 0 01-4.542-1.074L4.084 17.293A1 1 0 012.67 15.88l14-14a1 1 0 111.414 1.414l-1.928 1.928A9.982 9.982 0 0110 17z" /></svg>
                    </span>
                </div>
            </div>
        </div>

        <div>
            <label for="role" class="block mb-2 text-sm font-medium text-gray-700">Role</label>
            <select id="role" name="role" required
                    class="block w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="" disabled selected>Pilih Role</option>
                <option value="admin" @if(old('role') == 'admin') selected @endif>Admin</option>
                <option value="tu" @if(old('role') == 'tu') selected @endif>User (Tata Usaha)</option>
            </select>
            @error('role') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-end space-x-4 pt-4 border-t mt-6">
            <a href="{{ route('users.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition-all duration-300">
                Batal
            </a>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition-all duration-300">
                Simpan User
            </button>
        </div>
    </form>
</div>

<script>
    function togglePassword(inputId, eyeIconId, eyeSlashIconId) {
        const password = document.getElementById(inputId);
        const eyeIcon = document.getElementById(eyeIconId);
        const eyeSlashIcon = document.getElementById(eyeSlashIconId);

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
</script>
@endsection
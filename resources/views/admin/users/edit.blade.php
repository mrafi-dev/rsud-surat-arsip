@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="bg-white p-6 md:p-8 rounded-lg shadow-md">
    <div class="flex items-center mb-6">
        <a href="{{ route('users.index') }}" class="text-indigo-600 hover:text-indigo-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
        </a>
        <h2 class="text-2xl font-bold text-gray-800 ml-4">Formulir Edit User</h2>
    </div>
    <p class="text-gray-600 mb-6">Ubah data di bawah ini untuk memperbarui akun pengguna.</p>

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PATCH') {{-- Metode HTTP untuk update --}}
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                       class="block w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                       class="block w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-700">Password Baru (Opsional)</label>
                {{-- 1. Tambahkan div relative, pr-10, dan span icon mata --}}
                <div class="relative">
                    <input type="password" id="password" name="password"
                           class="block w-full px-4 py-3 pr-10 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="Isi jika ingin mengubah">
                    <span onclick="togglePassword('password', 'eye-1', 'eye-slash-1')" class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer">
                        <svg id="eye-1" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-gray-600" viewBox="0 0 20 20" fill="currentColor"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z" /><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.022 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" /></svg>
                        <svg id="eye-slash-1" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-gray-600 hidden" viewBox="0 0 20 20" fill="currentColor"><path d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074L3.707 2.293zM10 12a2 2 0 110-4 2 2 0 010 4z" /><path d="M10 17a9.953 9.953 0 01-4.542-1.074L4.084 17.293A1 1 0 012.67 15.88l14-14a1 1 0 111.414 1.414l-1.928 1.928A9.982 9.982 0 0110 17z" /></svg>
                    </span>
                </div>
                @error('password') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                {{-- 2. Tambahkan div relative, pr-10, dan span icon mata --}}
                <div class="relative">
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="block w-full px-4 py-3 pr-10 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
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
                <option value="admin" @if(old('role', $user->role) == 'admin') selected @endif>Admin</option>
                <option value="tu" @if(old('role', $user->role) == 'tu') selected @endif>User (Tata Usaha)</option>
            </select>
            @error('role') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-end space-x-4 pt-4 border-t mt-6">
            <a href="{{ route('users.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition-all duration-300">
                Batal
            </a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition-all duration-300">
                Update User
            </button>
        </div>
    </form>
</div>

<style>
    /* Sembunyikan icon mata bawaan browser (Chrome, Edge, Safari) */
    input[type="password"]::-webkit-password-reveal-button {
        -webkit-appearance: none;
        appearance: none;
        display: none;
    }
    
    /* Sembunyikan icon mata bawaan browser (IE/Edge Lama) */
    input[type="password"]::-ms-reveal {
        display: none;
    }
</style>

<script>
    // Fungsi ini akan menangani "icon mata"
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
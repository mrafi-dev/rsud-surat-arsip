@extends('layouts.admin')

@section('title', 'Profil Pengguna')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">

    {{-- KARTU INFORMASI PROFIL --}}
    <div class="bg-white p-6 md:p-8 rounded-xl shadow-lg">
        <section>
            <header>
                <h2 class="text-2xl font-bold text-gray-900">Informasi Profil</h2>
                <p class="mt-1 text-sm text-gray-600">Perbarui informasi profil dan alamat email akun Anda.</p>
            </header>

            <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                @csrf
                @method('patch')

                {{-- Foto Profil --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Profil</label>
                    <div class="mt-2 flex items-center gap-x-5">
                        <img id="foto-preview" class="h-24 w-24 rounded-full object-cover"
                             src="{{ Auth::user()->foto_profil ? Storage::url(Auth::user()->foto_profil) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=EBF4FF&color=7F9CF5' }}"
                             alt="Foto Profil">

                        <div>
                            <label for="foto_profil" class="cursor-pointer rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                <span>Ubah Foto</span>
                                <input id="foto_profil" name="foto_profil" type="file" class="sr-only" onchange="previewImage()">
                            </label>
                            <p class="mt-2 text-xs leading-5 text-gray-600">PNG, JPG, GIF hingga 2MB.</p>
                        </div>
                    </div>
                    @error('foto_profil') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Nama --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input id="name" name="name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white"
                           value="{{ old('name', $user->name) }}" required autofocus>
                    @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white"
                           value="{{ old('email', $user->email) }}" required>
                    @error('email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Simpan</button>
                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                           class="text-sm text-green-600">Berhasil diperbarui.</p>
                    @endif
                </div>
            </form>
        </section>
    </div>

    {{-- KARTU UBAH PASSWORD --}}
    <div class="bg-white p-6 md:p-8 rounded-xl shadow-lg">
        <section>
            <header>
                <h2 class="text-lg font-medium text-gray-900">Ubah Password</h2>
                <p class="mt-1 text-sm text-gray-600">Masukkan password lama, kemudian password baru.</p>
            </header>

            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('put')

                {{-- Password Lama --}}
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700">Password Saat Ini</label>
                    <div class="relative">
                        <input id="current_password" name="current_password" type="password" autocomplete="off"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white pr-10">
                        <button type="button" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 toggle-password" data-target="current_password">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Password Baru --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                    <div class="relative">
                        <input id="password" name="password" type="password" autocomplete="off"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white pr-10">
                        <button type="button" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 toggle-password" data-target="password">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                    <div class="relative">
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="off"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white pr-10">
                        <button type="button" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 toggle-password" data-target="password_confirmation">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Simpan Password</button>
                </div>
            </form>
        </section>
    </div>

    {{-- KARTU HAPUS AKUN --}}
    <div class="bg-white p-6 md:p-8 rounded-xl shadow-lg">
        <section>
            <header>
                <h2 class="text-lg font-medium text-gray-900">Hapus Akun</h2>
                <p class="mt-1 text-sm text-gray-600">
                    Setelah akun dihapus, semua data terkait akan dihapus secara permanen dan tidak dapat dikembalikan.
                    Pastikan Anda benar-benar yakin sebelum melanjutkan proses ini.
                </p>
            </header>

            <form method="post" action="{{ route('profile.destroy') }}" class="mt-6 space-y-6">
                @csrf
                @method('delete')

                <div class="relative">
                    <input id="password_delete" name="password" type="password" autocomplete="off"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white pr-10" placeholder="Masukkan password Anda">
                    <button type="button" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 toggle-password" data-target="password_delete">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">Hapus Akun</button>
                </div>
            </form>
        </section>
    </div>
</div>

<script>
    function previewImage() {
        const image = document.querySelector('#foto_profil');
        const imgPreview = document.querySelector('#foto-preview');
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }

    // Toggle Password Visibility
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.toggle-password').forEach(function(button) {
            button.addEventListener('click', function() {
                const target = document.getElementById(this.dataset.target);
                target.type = target.type === 'password' ? 'text' : 'password';
            });
        });
    });
</script>
@endsection

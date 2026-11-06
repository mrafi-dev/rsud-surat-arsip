<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Perbarui informasi profil dan alamat email akun Anda.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Tambahkan enctype="multipart/form-data" agar form bisa meng-handle upload file --}}
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        {{-- BAGIAN FOTO PROFIL BARU --}}
        <div>
            <label for="foto_profil" class="block text-sm font-medium text-gray-700 mb-2">Foto Profil</label>
            <div class="mt-2 flex items-center gap-x-5">
                {{-- Tampilkan foto yang ada atau avatar default --}}
                <img id="foto-preview" class="h-24 w-24 rounded-full object-cover" 
                     src="{{ Auth::user()->foto_profil ? Storage::url(Auth::user()->foto_profil) : 'https://placehold.co/100x100/e2e8f0/e2e8f0?text=.' }}" 
                     alt="Foto Profil">
                
                <div>
                    <label for="foto_profil" class="cursor-pointer rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        <span>Ubah Foto</span>
                        <input id="foto_profil" name="foto_profil" type="file" class="sr-only" onchange="previewImage()">
                    </label>
                    <p class="mt-2 text-xs leading-5 text-gray-600">PNG, JPG, GIF hingga 2MB.</p>
                </div>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('foto_profil')" />
        </div>

        {{-- BAGIAN NAMA --}}
        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- BAGIAN EMAIL --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Alamat email Anda belum terverifikasi.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Link verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>

{{-- Script untuk preview gambar --}}
<script>
    function previewImage() {
        const image = document.querySelector('#foto_profil');
        const imgPreview = document.querySelector('#foto-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>

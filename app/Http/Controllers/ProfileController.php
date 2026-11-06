<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage; // <-- 1. Impor Storage
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Menampilkan form edit profil.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Memperbarui informasi profil pengguna.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Mengisi data user dari request yang sudah divalidasi
        $user->fill($request->validated());

        // Jika email diubah, reset status verifikasi email
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // ================== LOGIKA UPLOAD FOTO PROFIL ==================
        // 2. Cek apakah ada file 'foto_profil' baru yang di-upload
        if ($request->hasFile('foto_profil')) {
            // Validasi file
            $request->validate([
                'foto_profil' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // 3. Hapus foto lama jika ada
            if ($user->foto_profil) {
                Storage::disk('public')->delete($user->foto_profil);
            }

            // 4. Simpan foto baru dan dapatkan path-nya
            $path = $request->file('foto_profil')->store('foto-profil', 'public');
            
            // 5. Simpan path baru ke data user
            $user->foto_profil = $path;
        }
        // ===============================================================

        // Simpan semua perubahan pada data user
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Menghapus akun pengguna.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // 1. Validasi bahwa password yang dimasukkan cocok
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        // 2. Ambil data user yang sedang login
        $user = $request->user();

        // 3. Logout user terlebih dahulu
        Auth::logout();

        // 4. [TAMBAHAN] Hapus foto profil dari storage jika ada
        if ($user->foto_profil) {
            // Pastikan Anda sudah "use Illuminate\Support\Facades\Storage;" di atas
            Storage::disk('public')->delete($user->foto_profil);
        }

        // 5. Hapus data user dari database
        $user->delete();

        // 6. Invalidate session dan regenerasi token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // 7. [INI SOLUSINYA] Redirect ke halaman depan (homepage)
        // Fungsi Anda wajib mengembalikan RedirectResponse
        return Redirect::to('/');
    }
}

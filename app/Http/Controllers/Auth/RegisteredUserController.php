<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Menampilkan halaman registrasi, dengan logika pengecekan admin.
     */
    public function create(): View|RedirectResponse
    {
        // Cek apakah sudah ada user dengan role 'admin' di database.
        if (User::where('role', 'admin')->exists()) {
            
            // --- LOGIKA UNTUK PRESENTASI ANDA ---
            // Sesuai catatan Anda, jika URL memiliki ?show=1,
            // kita tetap tampilkan form untuk keperluan demo.
            if (request()->query('show') === '1') {
                return view('auth.register');
            }

            // Jika tidak ada ?show=1, alihkan ke halaman login dengan pesan error.
            return redirect()->route('login')
                ->withErrors(['email' => 'Registrasi admin sudah ditutup. Silakan login.']);
        }

        // Jika belum ada admin sama sekali, tampilkan halaman register.
        return view('auth.register');
    }

    /**
     * Menangani permintaan registrasi yang masuk.
     */
    public function store(Request $request): RedirectResponse
    {
        // Pengecekan keamanan ganda.
        // Ini akan membuat pendaftaran GAGAL saat Anda demo, persis seperti yang Anda inginkan.
        if (User::where('role', 'admin')->exists()) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Mode Demo: Pendaftaran admin baru tidak diizinkan.']);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;//ini untuk cek validasi (email/pass wajib diisi)
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * untuk display  login
     */
    public function create(): View
    {                              //memanggil tampila file view aut login blade
        return view('auth.login');
    }

    /**
     * untuk cek auth email dan password
     */
    public function store(LoginRequest $request): RedirectResponse 
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

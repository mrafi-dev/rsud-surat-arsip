<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AuditLog; // 1. Impor model AuditLog
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Menampilkan form untuk membuat user baru.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Menyimpan user baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,tu'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // ================= AUDIT LOG: TAMBAH PENGGUNA =================
        AuditLog::create([
            'user_id'   => Auth::id(),
            'activity'  => 'TAMBAH PENGGUNA',
            'description' => 'Menambahkan pengguna baru dengan nama "' . $request->name . '"',
        ]);
        // =============================================================

        return redirect()->route('users.index')
                         ->with('success', 'User baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit user.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Memperbarui data user di database.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', 'in:admin,tu'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        // ================= AUDIT LOG: UBAH PENGGUNA =================
        AuditLog::create([
            'user_id'   => Auth::id(),
            'activity'  => 'UBAH PENGGUNA',
            'description' => 'Memperbarui data pengguna dengan nama "' . $request->name . '"',
        ]);
        // ============================================================

        return redirect()->route('users.index')
                         ->with('success', 'Data user berhasil diperbarui.');
    }

    /**
     * Menghapus data user dari database.
     */
    public function destroy(User $user)
    {
        if (Auth::id() === $user->id) {
            return redirect()->route('users.index')
                             ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // Simpan dulu namanya sebelum dihapus
        $userName = $user->name;
        
        $user->delete();

        // ================= AUDIT LOG: HAPUS PENGGUNA =================
        AuditLog::create([
            'user_id'   => Auth::id(),
            'activity'  => 'HAPUS PENGGUNA',
            'description' => 'Menghapus pengguna dengan nama "' . $userName . '"',
        ]);
        // =============================================================

        return redirect()->route('users.index')
                         ->with('success', 'User berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses login user berdasarkan username/email + role.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role'     => 'required',
        ]);

        // 🔍 Cari user berdasarkan email/nama dan role
        $user = User::where(function ($q) use ($request) {
                    $q->where('email', $request->username)
                      ->orWhere('nama', $request->username);
                })
                ->where('role', $request->role)
                ->first();

        // Jika user ditemukan
        if ($user) {
            // 🔒 Jika password di database belum di-hash (masih plaintext)
            if (!str_starts_with($user->password, '$2y$')) {
                $user->password = Hash::make($user->password);
                $user->save();
            }

            // Cek password sekarang (pasti sudah hashed)
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);

                return match ($user->role) {
                    'siswa' => redirect()->route('students.dashboard'),
                    'tutor' => redirect()->route('tutor.dashboard'),
                    'admin' => redirect()->route('admin.dashboard'),
                    default => redirect()->route('login.form')
                                         ->with('error', 'Role tidak dikenali.'),
                };
            }
        }

        // Jika gagal login
        return back()->with('error', 'Username, password, atau role salah.');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.form');
    }
}

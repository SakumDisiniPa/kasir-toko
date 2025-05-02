<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validasi kredensial pengguna
        $cred = $request->validate([
            'username' => ['required', 'exists:users'],
            'password' => ['required']
        ]);

        // Coba login dengan kredensial
        if (Auth::attempt($cred, $request->remember)) {
            return redirect('/');
        }

        // Jika login gagal, kembali dengan pesan error
        return back()->withErrors([
            'username' => 'Username atau Password yang diberikan salah.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        // Logout pengguna
        Auth::logout();

        // Menghapus session dan meregenerasi token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login
        return redirect('/login');
    }
}

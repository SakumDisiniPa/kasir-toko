<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Menampilkan profil pengguna
    public function show(Request $request)
    {
        return view('user.profile', [
            'user' => $request->user()
        ]);
    }

    // Menampilkan form untuk mengedit profil pengguna
    public function edit(Request $request)
    {
        return view('user.profile-edit', [
            'user' => $request->user()
        ]);
    }

    // Mengupdate data profil pengguna
    public function update(Request $request)
    {
        // Validasi input yang diterima
        $request->validate([
            'nama' => ['required', 'max:100'],
            'username' => ['required', 'unique:users,username,' . $request->user()->id],
            'password_baru' => ['nullable', 'max:100', 'confirmed']
        ]);

        // Jika ada password baru enkripsi password dan update data
        if ($request->password_baru) {
            $request->merge([
                'password' => bcrypt($request->password_baru),
            ]);
            $request->user()->update($request->all());

            // Redirect ke halaman profil dengan pesan sukses
            return redirect()->route('profile.show')->with('update', 'success');
        } else {
            // Jika tidak ada password baru, update nama dan username saja
            $request->user()->update($request->only('nama', 'username'));

            // Redirect ke halaman profil dengan pesan sukses
            return redirect()->route('profile.show')->with('update', 'success');
        }
    }
}

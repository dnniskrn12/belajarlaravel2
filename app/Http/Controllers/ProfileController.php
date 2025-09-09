<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// pakai Hash kalau kamu tidak menggunakan cast 'password' => 'hashed'
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function edit()
    {
        $user = Auth::user(); // <- pastikan ini model User, bukan Auth object
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi unik tapi mengabaikan user yang sedang login
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Update field dasar
        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->email = $validated['email'];

        // Password opsional
        if (!empty($validated['password'])) {
            // Kamu sudah pakai cast: 'password' => 'hashed' di model User,
            // jadi cukup set plain text saja (otomatis di-hash).
            $user->password = $validated['password'];

            // Atau kalau mau manual:
            // $user->password = Hash::make($validated['password']);
        }

        $user->save(); // <-- ini akan error kalau $user bukan Eloquent model

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}

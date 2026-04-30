<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CimilkController extends Controller
{
   public function showLogin()
{
    if (auth()->check()) {
         return view('auth.login');
    }
    return view('auth.login');
}
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:3',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        if (Auth::check()) {
            return redirect()->route('manajemen.akun')->with('success', 'Akun berhasil ditambahkan!');
        }

        return redirect('/login')->with('success', 'Registrasi Berhasil!');
    }


// Di dalam CimilkController.php
public function login(Request $request)
{
    $credentials = $request->only('username', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();

        if ($user->username == 'admin' || $user->role == 'Admin') return redirect()->route('admin.dashboard');
        if ($user->username == 'peternak' || $user->role == 'Peternak') return redirect()->route('peternak.dashboard');
        if ($user->username == 'penjualan' || $user->role == 'Penjualan') return redirect()->route('penjualan.dashboard');

        return redirect()->route('admin.dashboard');
    }

    // PENTING: Gunakan withErrors agar bisa ditangkap oleh @error di Blade
    return back()->withErrors(['login' => 'Username atau Password salah!']);
}
    public function logout(Request $request)
{
    Auth::logout(); // Log out user

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
}
}

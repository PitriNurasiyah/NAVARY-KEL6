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
         return view('login');
    }
    return view('login');
}
    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:3',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Registrasi Berhasil!');
    }


// Di dalam CimilkController.php
public function login(Request $request)
{
    $credentials = $request->only('username', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();

        if ($user->username == 'admin') return redirect()->route('admin.dashboard');
        if ($user->username == 'peternak') return redirect()->route('peternak.dashboard');
        if ($user->username == 'penjualan') return redirect()->route('penjualan.dashboard');

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

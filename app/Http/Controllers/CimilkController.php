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
    // Pastikan nama file di resources/views adalah login.blade.php
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

public function login(Request $request)
{
    $credentials = $request->only('username', 'password');
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        // Cek username dan arahkan ke route yang benar
        if ($user->username == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->username == 'peternak') {
            return redirect()->route('peternak.dashboard');
        } elseif ($user->username == 'penjualan') {
            return redirect()->route('penjualan.dashboard');
        }

        // Default jika tidak cocok semua
       return redirect()->route('admin.dashboard');
    }

    // Jika gagal, kembali ke login dengan pesan error
    return back()->with('error', 'Username atau Password salah!');
}
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}

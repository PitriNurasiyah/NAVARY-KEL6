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
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }
        return view('auth.login');
    }

    private function redirectBasedOnRole($user)
    {
        $role = strtolower($user->role);
        $username = strtolower($user->username);

        if ($role == 'peternak' || $username == 'peternak') {
            return redirect()->route('peternak.dashboard');
        }
        if ($role == 'penjualan' || $role == 'manajemen penjualan' || $username == 'penjualan') {
            return redirect()->route('penjualan.dashboard');
        }
        
        return redirect()->route('admin.dashboard');
    }

    public function showRegister()
    {
        return view('manajemenAkun.create');
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

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return $this->redirectBasedOnRole(Auth::user());
        }

        return back()->withErrors(['login' => 'Username atau Password salah!']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

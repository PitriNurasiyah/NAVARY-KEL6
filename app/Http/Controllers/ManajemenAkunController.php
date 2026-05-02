<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class ManajemenAkunController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('manajemenAkun.manajemenAkun', compact('users'));
    }

    public function create()
    {
        return view('manajemenAkun.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah terdaftar, silakan gunakan yang lain.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'role.required' => 'Silakan pilih role pengguna.',
        ];

        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:8',
            'role' => 'required',
            'status' => 'nullable'
        ], $messages);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'status' => $request->status ?? 'Aktif'
        ]);

        // Jika dikirim dari modal, redirect ke halaman create (masih dalam iframe)
        // agar JS bisa mendeteksi session('success') dan redirect top window
        if ($request->input('mode') === 'modal') {
            return redirect()->route('manajemen-akun.create', ['mode' => 'modal'])
                ->with('success', 'Akun berhasil ditambahkan!');
        }

        return redirect()->route('manajemen.akun')->with('success', 'Akun berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('manajemenAkun.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$user->id,
            'role' => 'required',
            'status' => 'required'
        ]);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'role' => $request->role,
            'status' => $request->status
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => bcrypt($request->password)]);
        }

        return redirect()->route('manajemen.akun')->with('success', 'Akun berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('manajemen.akun')->with('success', 'Akun berhasil dihapus!');
    }
}

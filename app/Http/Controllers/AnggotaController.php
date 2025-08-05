<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('anggota.index', compact('users'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role'     => 'required|in:mahasiswa,admin',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('anggota.index')->with('success', 'User berhasil ditambahkan!');
    }


    public function edit(User $user)
    {
        return view('anggota.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($request->all());

        return redirect()->route('anggota.index')->with('success', 'Data anggota diperbarui');
    }

    public function show(User $user)
    {
        // Pastikan user memiliki kartu anggota
        $libraryCard = $user->libraryCard;

        if (!$libraryCard) {
            return redirect()->route('anggota.index')->with('error', 'Kartu anggota tidak ditemukan.');
        }

        return view('anggota.show', compact('user', 'libraryCard'));
    }




    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('anggota.index')->with('success', 'Anggota dihapus');
    }
}
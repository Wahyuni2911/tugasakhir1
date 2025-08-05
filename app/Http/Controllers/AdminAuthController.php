<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
     public function showLoginForm()
    {
        return view('auth.login-admin'); // Pastikan file view ada di resources/views/admin/login.blade.php
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Coba login
        if (Auth::attempt($request->only('email', 'password'))) {
            // Cek apakah role adalah admin
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard');
            } else {
                Auth::logout();
                return redirect()->back()->with('error', 'Akses hanya untuk admin!');
            }
        }

        return redirect()->back()->with('error', 'Email atau password salah!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Models\Anggota;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\KartuAnggotaPerpustakaanDigital;

class BarcodeLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('Auth-Mahasiswa.barcode-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'barcode' => 'required|string|exists:kartu_anggota_perpustakaan_digital,nim',
        ]);

        // Cari kartu anggota berdasarkan NIM
        $kartu = KartuAnggotaPerpustakaanDigital::where('nim', $request->barcode)->first();

        if (!$kartu || !$kartu->anggota) {
            return back()->with('error', 'Data anggota tidak ditemukan.');
        }

        // Pastikan hanya login sebagai anggota, tidak mencampur dengan admin
        Auth::guard('anggota')->logout(); // Pastikan tidak ada sesi lain aktif
        Auth::guard('anggota')->login($kartu->anggota); // Login dengan guard 'anggota'

        return redirect()->route('dashboard-pemustaka')->with('success', 'Login berhasil sebagai Anggota!');
    }

    public function logout(Request $request)
    {
        Auth::guard('anggota')->logout(); // Logout dari guard 'anggota'

        $request->session()->invalidate(); // Hapus semua sesi
        $request->session()->regenerateToken(); // Regenerasi token CSRF

        return redirect()->route('barcode.login.form')->with('success', 'Anda telah logout.');
    }
}
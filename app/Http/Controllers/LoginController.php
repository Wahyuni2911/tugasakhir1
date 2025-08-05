<?php

namespace App\Http\Controllers;

use App\Models\LibraryCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showRFIDForm()
    {
        return view('auth.rfid_login');
    }


    // Proses login menggunakan RFID
   public function loginWithRFID(Request $request)
{
    // Ambil input RFID dari request
    $rfidCode = $request->input('rfid_code');

    // Cari kartu perpustakaan berdasarkan RFID
    $libraryCard = LibraryCard::where('rfid_code', $rfidCode)->first();

    // Cek apakah kartu ada dan statusnya aktif
    if ($libraryCard && $libraryCard->status === 'aktif') {
        $user = $libraryCard->user;

        // Hanya izinkan role pegawai atau dosen
        if (in_array($user->role, ['pegawai', 'dosen'])) {
            Auth::login($user);
            return redirect()->route('dashboard-pemustaka'); // arahkan ke dashboard pemustaka
        } else {
            return redirect()->back()->with('error', 'Akses ditolak. Hanya pegawai atau dosen yang diizinkan.');
        }
    }

    // Jika gagal, kembalikan ke halaman sebelumnya dengan error
    return redirect()->back()->with('error', 'RFID tidak valid atau kartu tidak aktif');
}


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login-pegawai')->with('success', 'Anda telah berhasil logout.');
    }
}
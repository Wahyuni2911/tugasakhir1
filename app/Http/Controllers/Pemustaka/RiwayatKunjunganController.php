<?php

namespace App\Http\Controllers\Pemustaka;

use App\Models\Kunjungan;
use Illuminate\Http\Request;
use App\Models\RiwayatKunjungan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RiwayatKunjunganController extends Controller
{
  public function index()
{
    $anggota = Auth::guard('anggota')->user();
    $kartuAnggota = $anggota->kartuAnggota; // pastikan relasi ini tersedia

    if (!$kartuAnggota) {
        return back()->with('error', 'Kartu anggota tidak ditemukan.');
    }

    $kunjungans = Kunjungan::with(['kartuAnggota.anggota'])
        ->where('kartu_anggota_id', $kartuAnggota->id)
        ->latest('waktu_kunjungan')
        ->paginate(10);

    return view('pemustaka.riwayat-kunjungan.index', compact('kunjungans'));
}



}
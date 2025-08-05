<?php

namespace App\Http\Controllers\Admin;

use App\Models\Anggota;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KartuAnggotaPerpustakaanDigital;

class SettingCardController extends Controller
{
   public function index()
{
    // Semua anggota mahasiswa untuk dropdown preview
    $anggota = Anggota::with(['programStudi', 'kartuAnggota'])
        ->where('tipe_keanggotaan', 'mahasiswa')
        ->get();

    // Ambil ID anggota yang sudah punya kartu anggota
    $anggotaSudahPunyaKartu = KartuAnggotaPerpustakaanDigital::pluck('anggota_id')->toArray();

    // Anggota mahasiswa yang belum punya kartu anggota
    $anggotaBelumPunyaKartu = Anggota::with('programStudi')
        ->where('tipe_keanggotaan', 'mahasiswa')
        ->whereNotIn('id', $anggotaSudahPunyaKartu)
        ->get();

    return view('admin.setting-card.index', compact('anggota', 'anggotaBelumPunyaKartu'));
}


    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|unique:kartu_anggota_perpustakaan_digital,anggota_id',
            'nim' => 'required|unique:kartu_anggota_perpustakaan_digital,nim',
            'masa_berlaku' => 'required|date',
        ]);

        KartuAnggotaPerpustakaanDigital::create($request->only([
            'anggota_id',
            'nim',
            'masa_berlaku'
        ]));

        return redirect()->route('setting-card')->with('success', 'Kartu anggota digital berhasil ditambahkan.');
    }
}
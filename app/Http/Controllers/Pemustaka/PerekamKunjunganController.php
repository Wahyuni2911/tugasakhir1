<?php

namespace App\Http\Controllers\Pemustaka;

use Carbon\Carbon;
use App\Models\Kunjungan;
use App\Models\Geolocation;
use Illuminate\Http\Request;
use App\Models\LaporanKunjungan;
use App\Models\KategoriKunjungan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PerekamKunjunganController extends Controller
{

    public function index()
    {
        return view('pemustaka.perekam-kunjungan');
    }
    public function geoLokasi()
    {
        $geolocations = Geolocation::all();
        $kategoriKunjungan = KategoriKunjungan::all();
        return view('pemustaka.geo-lokasi', compact('geolocations', 'kategoriKunjungan'));
    }
    public function submit(Request $request)
    {
        $anggota = Auth::guard('anggota')->user();

        if (!$anggota) {
            return redirect()->back()->with('error', 'Kartu anggota tidak ditemukan.');
        }

        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'status' => 'required',
            'prodi' => 'required',
            'kategori_kunjungan_id' => 'required|exists:kategori_kunjungan,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Simpan data kunjungan
        $kunjungan = Kunjungan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'status' => $request->status,
            'prodi' => $request->prodi,
            'kategori_kunjungan_id' => $request->kategori_kunjungan_id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'kartu_anggota_id' => $anggota->kartuAnggota->id,
            'waktu_kunjungan' => now(),
            'created_at' => now(),
        ]);

        // Normalisasi tipe keanggotaan agar sesuai enum
        $tipe = ucfirst(strtolower(trim($anggota->tipe_keanggotaan)));

        // Validasi agar hanya enum yang sah
        if (!in_array($tipe, ['Mahasiswa', 'Dosen', 'Umum'])) {
            $tipe = 'Umum'; // fallback default
        }

        // Simpan ke laporan_kunjungan
        LaporanKunjungan::create([
            'kunjungan_id' => $kunjungan->id,
            'online_offline' => 'Offline', // Sesuaikan jika ingin buat dinamis
            'jenis_keanggotaan' => $tipe,
        ]);

        return redirect()->back()->with('success', 'Kunjungan berhasil direkam.');
    }
}

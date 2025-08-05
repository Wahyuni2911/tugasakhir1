<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Visit;
use App\Models\Anggota;
use Illuminate\Http\Request;
use App\Models\RiwayatKunjungan;

class AdminController extends Controller
{
    public function index()
    {
        // Kunjungan Hari Ini
        $kunjunganHariIni = RiwayatKunjungan::whereDate('created_at', Carbon::today())->count();

        // Kunjungan Bulan Ini
        $kunjunganBulanIni = RiwayatKunjungan::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // Jumlah Mahasiswa (berdasarkan kategori di tabel anggota)
        $jumlahMahasiswa = User::where('role', 'Mahasiswa')->count();
        // Jumlah Dosen
        $jumlahDosen = User::where('role', 'Dosen')->count();

         // Data untuk grafik (jumlah kunjungan per hari dalam 30 hari terakhir)
         $dataKunjungan = RiwayatKunjungan::selectRaw('DATE(created_at) as tanggal, COUNT(*) as jumlah')
         ->whereDate('created_at', '>=', Carbon::now()->subDays(30))
         ->groupBy('tanggal')
         ->orderBy('tanggal', 'ASC')
         ->get();

        return view('admin.dashboard', compact('kunjunganHariIni', 'kunjunganBulanIni', 'jumlahMahasiswa', 'jumlahDosen','dataKunjungan'));
    }
}
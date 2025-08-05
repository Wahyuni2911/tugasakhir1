<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Anggota;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use App\Models\LaporanKunjungan;
use App\Http\Controllers\Controller;

class DashboardAdminController extends Controller
{
    public function index(Request $request)
    {
        $tipe = $request->input('tipe');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $laporanQuery = LaporanKunjungan::with(['kunjungan.kartuAnggota.anggota.user']);

        if ($tipe) {
            $laporanQuery->whereHas('kunjungan.kartuAnggota.anggota.user', function ($q) use ($tipe) {
                $q->where('role', $tipe);
            });
        }

        if ($bulan) {
            $laporanQuery->whereMonth('tanggal', $bulan);
        }

        if ($tahun) {
            $laporanQuery->whereYear('tanggal', $tahun);
        }

        // Data untuk grafik
        $dataKunjungan = $laporanQuery
            ->selectRaw('DATE(tanggal) as tanggal, COUNT(*) as jumlah')
            ->groupByRaw('DATE(tanggal)')
            ->orderBy('tanggal', 'ASC')
            ->get();

        $maxJumlah = $dataKunjungan->max('jumlah');

        // Data statistik
        $kunjunganHariIni = LaporanKunjungan::whereDate('tanggal', Carbon::today())->count();
        $kunjunganBulanIni = LaporanKunjungan::whereMonth('tanggal', Carbon::now()->month)
            ->whereYear('tanggal', Carbon::now()->year)->count();

        $jumlahMahasiswa = Anggota::where('tipe_keanggotaan', 'Mahasiswa')->count();
        $jumlahDosen = Anggota::where('tipe_keanggotaan', 'Dosen')->count();

        return view('admin.dashboard', compact(
            'kunjunganHariIni',
            'kunjunganBulanIni',
            'jumlahMahasiswa',
            'jumlahDosen',
            'dataKunjungan',
            'maxJumlah'
        ));
    }
}

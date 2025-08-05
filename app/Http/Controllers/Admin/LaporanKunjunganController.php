<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kunjungan;
use App\Models\UsersDetail;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use App\Models\LaporanKunjungan;
use App\Models\KategoriKunjungan;
use App\Http\Controllers\Controller;

class LaporanKunjunganController extends Controller
{
    public function index(Request $request)
    {
        $query = LaporanKunjungan::with([
            'kunjungan.kartuAnggota.anggota.programStudi',
            'kunjungan.kategoriKunjungan'
        ]);

        if ($request->filled('kategori_kunjungan_id')) {
            $query->whereHas('kunjungan', function ($q) use ($request) {
                $q->where('kategori_kunjungan_id', $request->kategori_kunjungan_id);
            });
        }

        if ($request->filled('tanggal')) {
            $query->whereHas('kunjungan', function ($q) use ($request) {
                $q->whereDate('waktu_kunjungan', $request->tanggal);
            });
        }

        if ($request->filled('jenis_layanan')) {
            $query->where('online_offline', ucfirst($request->jenis_layanan));
        }

        if ($request->filled('jenis_anggota')) {
            $query->where('jenis_keanggotaan', ucfirst($request->jenis_anggota));
        }

        if ($request->filled('program_studi_id')) {
            $query->whereHas('kunjungan.kartuAnggota.anggota.programStudi', function ($q) use ($request) {
                $q->where('id', $request->program_studi_id);
            });
        }

        $laporans = $query->latest()->paginate(10);

        $kategoriKunjungan = KategoriKunjungan::all();
        $jenisLayanan = ['Online', 'Offline'];
        $programStudis = ProgramStudi::all();
        $jenisAnggota = ['Mahasiswa', 'Dosen', 'Umum'];

        return view('admin.laporan-kunjungan.index', compact(
            'laporans',
            'kategoriKunjungan',
            'jenisLayanan',
            'programStudis',
            'jenisAnggota'
        ));
    }
}

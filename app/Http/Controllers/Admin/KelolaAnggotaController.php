<?php

namespace App\Http\Controllers\Admin;

use Log;
use App\Models\Anggota;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class KelolaAnggotaController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query'); // Ambil input pencarian

        if ($query) {
            // Jika ada pencarian, filter berdasarkan nama atau nomor identitas
            $anggota = Anggota::where('nama', 'LIKE', "%$query%")
                ->orWhere('nomor_identitas', 'LIKE', "%$query%")
                ->orWhere('tipe_keanggotaan', 'LIKE', "%$query%")
                ->get();
        } else {
            // Jika tidak ada pencarian, tampilkan semua data
            $anggota = Anggota::all();
        }

         $programStudiList = ProgramStudi::all();
        return view('admin.kelola-anggota.index', compact('anggota', 'query','programStudiList'));
    }

    // Tampilkan halaman pendaftaran anggota
    public function create()
    {
        $programStudiList = ProgramStudi::all();
        return view('admin.kelola-anggota.pendaftaran-anggota', compact('programStudiList'));
    }

    public function store(Request $request)
    {
        // Cek apakah nomor identitas sudah ada
        $existingAnggota = Anggota::where('nomor_identitas', $request->nomor_identitas)->first();
        if ($existingAnggota) {
            return redirect()->back()->with('error', 'Nomor Identitas sudah terdaftar!');
        }

        // Validasi Input
        $request->validate([
            'nama' => 'required|string|max:45',
            'surel' => 'required|email|max:100',
            'tanggal_lahir' => 'nullable|date',
            'anggota_sejak' => 'nullable|date',
            'tanggal_registrasi' => 'nullable|date',
            'berlaku_hingga' => 'nullable|date',
            'institusi' => 'nullable|string|max:45',
            'tipe_keanggotaan' => 'nullable|string|max:45',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'nomor_identitas' => 'required|string|max:45|unique:anggota,nomor_identitas',
            'tunda_keanggotaan' => 'nullable|boolean',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'katasandi' => 'required|string|min:6',
            'konfirmasi_katasandi_baru' => 'required|same:katasandi',
            'program_studi_id' => 'required|exists:program_studi,id',  // 🔹 Pastikan ID valid
            'catatan' => 'nullable|string',
        ]);

        // Upload Foto
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_anggota', 'public');
        }

        // Simpan ke database
        Anggota::create([
            'nama' => $request->nama,
            'surel' => $request->surel,
            'tanggal_lahir' => $request->tanggal_lahir,
            'anggota_sejak' => $request->anggota_sejak,
            'tanggal_registrasi' => $request->tanggal_registrasi,
            'berlaku_hingga' => $request->berlaku_hingga,
            'institusi' => $request->institusi,
            'tipe_keanggotaan' => $request->tipe_keanggotaan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nomor_identitas' => $request->nomor_identitas,
            'tunda_keanggotaan' => $request->tunda_keanggotaan,
            'foto' => $fotoPath,
            'katasandi' => bcrypt($request->katasandi),
            'program_studi_id' => $request->program_studi_id,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('pendaftaran-anggota.index')->with('success', 'Anggota berhasil didaftarkan!');
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id); // Pastikan hanya satu data yang diambil
        $programStudiList = ProgramStudi::all(); // Ambil daftar program studi
        return view('admin.kelola-anggota.edit', compact('anggota', 'programStudiList'));
    }
    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id); // Cari anggota berdasarkan ID

        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:45',
            'surel' => 'required|email|max:100',
            'tanggal_lahir' => 'nullable|date',
            'anggota_sejak' => 'nullable|date',
            'tanggal_registrasi' => 'nullable|date',
            'berlaku_hingga' => 'nullable|date',
            'institusi' => 'nullable|string|max:45',
            'tipe_keanggotaan' => 'nullable|string|max:45',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'nomor_identitas' => 'required|string|max:45|unique:anggota,nomor_identitas,' . $id, // Cek unik dengan pengecualian
            'tunda_keanggotaan' => 'nullable|boolean',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'program_studi_id' => 'required|exists:program_studi,id',
            'catatan' => 'nullable|string',
        ]);

        // Upload Foto (Jika ada perubahan foto)
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_anggota', 'public');
            $anggota->foto = $fotoPath; // Update foto
        }

        // Update data anggota
        $anggota->update([
            'nama' => $request->nama,
            'surel' => $request->surel,
            'tanggal_lahir' => $request->tanggal_lahir,
            'anggota_sejak' => $request->anggota_sejak,
            'tanggal_registrasi' => $request->tanggal_registrasi,
            'berlaku_hingga' => $request->berlaku_hingga,
            'institusi' => $request->institusi,
            'tipe_keanggotaan' => $request->tipe_keanggotaan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nomor_identitas' => $request->nomor_identitas,
            'tunda_keanggotaan' => $request->tunda_keanggotaan,
            'program_studi_id' => $request->program_studi_id,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('kelola-anggota')->with('success', 'Data anggota berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id); // Cari anggota berdasarkan ID

        // Hapus foto dari penyimpanan jika ada
        if ($anggota->foto) {
            \Storage::disk('public')->delete($anggota->foto);
        }

        $anggota->delete(); // Hapus data dari database

        return redirect()->route('kelola-anggota')->with('success', 'Anggota berhasil dihapus!');
    }
}

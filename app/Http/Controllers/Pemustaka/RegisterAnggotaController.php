<?php

namespace App\Http\Controllers\Pemustaka;

use App\Models\Anggota;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterAnggotaController extends Controller
{
    public function showForm()
    {
        $programStudiList = ProgramStudi::all();
        return view('Auth-Mahasiswa.register-anggota', compact('programStudiList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:45',
            'tanggal_lahir' => 'required|date',
            'anggota_sejak' => 'required|date',
            'tanggal_registrasi' => 'required|date',
            'berlaku_hingga' => 'required|date',
            'institusi' => 'nullable|string|max:45',
            'tipe_keanggotaan' => 'nullable|string|max:45',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'nomor_identitas' => 'required|string|max:45|unique:anggota,nomor_identitas',
            'tunda_keanggotaan' => 'required|boolean',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'surel' => 'required|email|max:100|unique:anggota,surel',
            'program_studi_id' => 'required|exists:program_studi,id',
            'catatan' => 'nullable|string|max:1000',
            'katasandi' => 'required|string|min:6',
            'katasandi_confirmation' => 'required|same:katasandi',
        ]);

        $anggota = new Anggota();
        $anggota->nama = $request->nama;
        $anggota->tanggal_lahir = $request->tanggal_lahir;
        $anggota->anggota_sejak = $request->anggota_sejak;
        $anggota->tanggal_registrasi = $request->tanggal_registrasi;
        $anggota->berlaku_hingga = $request->berlaku_hingga;
        $anggota->institusi = $request->institusi;
        $anggota->tipe_keanggotaan = $request->tipe_keanggotaan;
        $anggota->jenis_kelamin = $request->jenis_kelamin;
        $anggota->nomor_identitas = $request->nomor_identitas;
        $anggota->tunda_keanggotaan = $request->tunda_keanggotaan;
        $anggota->surel = $request->surel;
        $anggota->program_studi_id = $request->program_studi_id;
        $anggota->catatan = $request->catatan;
        $anggota->katasandi = bcrypt($request->katasandi);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('foto-anggota', 'public');
            $anggota->foto = $path;
        }

        $anggota->save();

        return redirect()->route('barcode.login.form')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }
}

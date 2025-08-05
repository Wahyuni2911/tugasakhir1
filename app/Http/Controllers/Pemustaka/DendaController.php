<?php

namespace App\Http\Controllers\Pemustaka;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DendaController extends Controller
{
    public function index()
    {
        return view('pemustaka.denda.index'); // Sesuaikan dengan nama file Blade yang dibuat
    }

    // Proses pembayaran denda
    public function prosesBayar(Request $request, $id)
    {
        // Simulasi pemrosesan pembayaran (nanti bisa dihubungkan ke sistem pembayaran)
        $metode = $request->input('metode');

        // Misalnya simpan ke database (diabaikan karena statis)
        return redirect()->route('bayar.denda')->with('success', 'Pembayaran denda berhasil menggunakan metode: ' . ucfirst($metode));
    }
}
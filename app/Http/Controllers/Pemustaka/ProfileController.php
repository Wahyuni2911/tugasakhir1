<?php

namespace App\Http\Controllers\Pemustaka;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profil()
    {
        // Contoh data anggota, bisa diambil dari database sesuai user yang login
        $anggota = Auth::guard('anggota')->user();

        return view('pemustaka.profile.index', compact('anggota'));
    }
}

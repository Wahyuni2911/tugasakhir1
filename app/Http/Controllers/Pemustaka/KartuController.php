<?php

namespace App\Http\Controllers\Pemustaka;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class KartuController extends Controller
{
    public function generateQrCode()
{
    $user = Auth::user();
    $path = 'qrcode/' . $user->id . '.png';

    // Buat QR Code dan simpan ke storage
    Storage::put('public/' . $path, QrCode::format('png')->size(200)->generate($user->nomor_identitas));

    return response()->json(['qr_code_url' => asset('storage/' . $path)]);
}
}

<?php

namespace App\Http\Controllers\Pemustaka;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    public function scan()
    {
        return view('pemustaka.scan-barcode');
    }
}

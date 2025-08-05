<?php

namespace App\Http\Controllers\Pemustaka;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboardPemustaka()
    {
        return view('pemustaka.dashboard-pemustaka');
    }
}
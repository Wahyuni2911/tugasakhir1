<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Visit;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use App\Models\RiwayatKunjungan;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogVisitMiddleware
{
    public function handle(Request $request, Closure $next)
    {
    

        return $next($request);
    }
}

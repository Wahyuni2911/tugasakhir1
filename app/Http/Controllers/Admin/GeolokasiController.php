<?php

namespace App\Http\Controllers\Admin;

use App\Models\Geolocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeolokasiController extends Controller
{
    public function index()
    {
        $geolocations = Geolocation::latest()->take(4)->get();
        return view('admin.geolokasi.index', compact('geolocations'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'latitude' => 'required|array|min:1|max:4',
            'longitude' => 'required|array|min:1|max:4',
            'deskripsi' => 'required|array|min:1|max:4',
            'latitude.*' => 'required|numeric|between:-90,90',
            'longitude.*' => 'required|numeric|between:-180,180',
            'deskripsi.*' => 'nullable|string|max:255',
        ]);

        $coordinates = [];

        for ($i = 0; $i < count($validated['latitude']); $i++) {
            // Hanya simpan jika koordinat tidak kosong (opsional)
            if (!empty($validated['latitude'][$i]) && !empty($validated['longitude'][$i])) {
                $coordinates[] = [
                    'latitude' => $validated['latitude'][$i],
                    'longitude' => $validated['longitude'][$i],
                    'deskripsi' => $validated['deskripsi'][$i] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Simpan ke database secara batch (jika menggunakan Eloquent Model)
        Geolocation::insert($coordinates);

        return redirect()->back()->with('success', 'Titik koordinat berhasil disimpan!');
    }
}

<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Kunjungan;
use Illuminate\Database\Seeder;
use App\Models\KategoriKunjungan;
use App\Models\KartuAnggotaPerpustakaanDigital;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KunjunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kartuAnggotaIds = KartuAnggotaPerpustakaanDigital::pluck('id')->take(5);
        $kategoriIds = KategoriKunjungan::pluck('id');

        foreach ($kartuAnggotaIds as $index => $kartuId) {
            Kunjungan::create([
                'kartu_anggota_id' => $kartuId,
                'kategori_kunjungan_id' => $kategoriIds->random(),
                'waktu_kunjungan' => now()->subDays($index),
                'tujuan' => 'Tujuan kunjungan ke-' . ($index + 1),
                'latitude' => -6.2 + $index * 0.01,
                'longitude' => 106.8 + $index * 0.01,
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\KartuAnggotaPerpustakaanDigital;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KartuAnggotaPerpustakaanDigitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kartu_anggota_perpustakaan_digital')->insert([
            [
                'anggota_id' => 1, // Sesuai dengan ID di tabel anggota
                'nim' => 'A123456',
                'masa_berlaku' => now()->addYears(3),
            ],
            [
                'anggota_id' => 2,
                'nim' => 'B654321',
                'masa_berlaku' => now()->addYears(2),
            ],
            [
                'anggota_id' => 3,
                'nim' => 'C789012',
                'masa_berlaku' => now()->addYears(4),
            ],
            [
                'anggota_id' => 4,
                'nim' => 'D345678',
                'masa_berlaku' => now()->addYears(5),
            ],
            [
                'anggota_id' => 5,
                'nim' => 'E987654',
                'masa_berlaku' => now()->addYears(3),
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LaporanKunjunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('laporan_kunjungan')->insert([
            [
                'kunjungan_id' => 1,
                'tanggal' => now(),
                'online_offline' => 'Offline',
                'jenis_keanggotaan' => 'Mahasiswa',
            ],
            [
                'kunjungan_id' => 2,
                'tanggal' => now()->subDays(2),
                'online_offline' => 'Online',
                'jenis_keanggotaan' => 'Dosen',
            ],
            [
                'kunjungan_id' => 3,
                'tanggal' => now()->subDays(5),
                'online_offline' => 'Offline',
                'jenis_keanggotaan' => 'Umum',
            ],
            [
                'kunjungan_id' => 4,
                'tanggal' => now()->subWeek(),
                'online_offline' => 'Online',
                'jenis_keanggotaan' => 'Mahasiswa',
            ],
            [
                'kunjungan_id' => 5,
                'tanggal' => now()->subMonth(),
                'online_offline' => 'Offline',
                'jenis_keanggotaan' => 'Dosen',
            ],
        ]);
    }
}

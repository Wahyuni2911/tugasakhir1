<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\RiwayatKunjungan;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RiwayatKunjunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('riwayat_kunjungan')->insert([
            [
                'anggota_id' => 1,
                'waktu_kunjungan' => Carbon::now()->subDays(2),
                'tujuan_kunjungan' => 'Baca Buku',
            ],
            [
                'anggota_id' => 2,
                'waktu_kunjungan' => Carbon::now()->subDays(5),
                'tujuan_kunjungan' => 'Pinjam Buku',
            ],
            [
                'anggota_id' => 3,
                'waktu_kunjungan' => Carbon::now()->subDays(1),
                'tujuan_kunjungan' => 'Diskusi',
            ],
            [
                'anggota_id' => 4,
                'waktu_kunjungan' => Carbon::now()->subHours(6),
                'tujuan_kunjungan' => 'Penelitian',
            ],
            [
                'anggota_id' => 5,
                'waktu_kunjungan' => Carbon::now(),
                'tujuan_kunjungan' => 'Lainnya',
            ],
        ]);
    }
}
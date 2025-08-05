<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersDetails = [
            [
                'user_id' => 1, // Mahasiswa
                'laporan_kunjungan_id' => 1,
                'kategori_kunjungan_id' => 1,
                'program_studi_id' => 1,
                'kartu_anggota_digital_id' => 1,
            ],
            [
                'user_id' => 2, // Admin (tidak perlu kategori_kunjungan, program_studi, kartu_anggota_digital)
                'laporan_kunjungan_id' => 2,
                'kategori_kunjungan_id' => null,
                'program_studi_id' => null,
                'kartu_anggota_digital_id' => null,
            ],
            [
                'user_id' => 3, // Pegawai
                'laporan_kunjungan_id' => 3,
                'kategori_kunjungan_id' => 3,
                'program_studi_id' => 3,
                'kartu_anggota_digital_id' => 3,
            ],
            [
                'user_id' => 4, // Mahasiswa
                'laporan_kunjungan_id' => 4,
                'kategori_kunjungan_id' => 4,
                'program_studi_id' => 4,
                'kartu_anggota_digital_id' => 4,
            ],
            [
                'user_id' => 5, // Dosen
                'laporan_kunjungan_id' => 5,
                'kategori_kunjungan_id' => 5,
                'program_studi_id' => 5,
                'kartu_anggota_digital_id' => 5,
            ],
        ];

        DB::table('users_detail')->insert($usersDetails);
    }
}
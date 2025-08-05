<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pengguna::insert([
            ['nama_pengguna' => 'Admin', 'username' => 'admin1', 'password' => Hash::make('password'), 'email' => 'admin1@example.com', 'kategori_kunjungan_id' => 1, 'program_studi_id' => 1],
            ['nama_pengguna' => 'Dosen', 'username' => 'dosen1', 'password' => Hash::make('password'), 'email' => 'dosen1@example.com', 'kategori_kunjungan_id' => 2, 'program_studi_id' => 2],
            ['nama_pengguna' => 'Mahasiswa', 'username' => 'mahasiswa1', 'password' => Hash::make('password'), 'email' => 'mahasiswa1@example.com', 'kategori_kunjungan_id' => 1, 'program_studi_id' => 3],
            ['nama_pengguna' => 'Pegawai', 'username' => 'pegawai1', 'password' => Hash::make('password'), 'email' => 'pegawai1@example.com', 'kategori_kunjungan_id' => 4, 'program_studi_id' => 4],
            ['nama_pengguna' => 'Peneliti', 'username' => 'peneliti1', 'password' => Hash::make('password'), 'email' => 'peneliti1@example.com', 'kategori_kunjungan_id' => 5, 'program_studi_id' => 5],
        ]);
    }
}
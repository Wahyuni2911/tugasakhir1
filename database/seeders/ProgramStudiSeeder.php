<?php

namespace Database\Seeders;

use App\Models\ProgramStudi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProgramStudiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProgramStudi::insert([
            ['nama_prodi' => 'Teknik Informatika', 'kode_prodi' => 'TI'],
            ['nama_prodi' => 'Sistem Informasi', 'kode_prodi' => 'SI'],
            ['nama_prodi' => 'Manajemen', 'kode_prodi' => 'MN'],
            ['nama_prodi' => 'Akuntansi', 'kode_prodi' => 'AK'],
            ['nama_prodi' => 'Teknik Elektro', 'kode_prodi' => 'TE'],
        ]);
    }
}
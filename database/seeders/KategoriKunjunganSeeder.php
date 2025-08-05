<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriKunjungan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriKunjunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriKunjungan::insert([
            ['nama_kategori' => 'Mahasiswa'],
            ['nama_kategori' => 'Dosen'],
            ['nama_kategori' => 'Umum'],
            ['nama_kategori' => 'Pegawai'],
            ['nama_kategori' => 'Peneliti'],
        ]);
    }
}

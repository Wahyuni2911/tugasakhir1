<?php

namespace Database\Seeders;

use App\Models\Anggota;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('anggota')->insert([
            [
                'nama' => 'Budi Santoso',
                'surel' => 'budi@example.com',
                'tanggal_lahir' => '1998-06-15',
                'anggota_sejak' => now()->subYears(3),
                'tanggal_registrasi' => now()->subYears(3),
                'berlaku_hingga' => now()->addYears(2),
                'institusi' => 'Universitas A',
                'tipe_keanggotaan' => 'Mahasiswa',
                'jenis_kelamin' => 'Laki-laki',
                'nomor_identitas' => '123456789',
                'catatan' => 'Anggota aktif',
                'tunda_keanggotaan' => false,
                'foto' => null,
                'katasandi' => Hash::make('password123'),
                'konfirmasi_katasandi_baru' => null,
                'program_studi_id' => 1,
            ],
            [
                'nama' => 'Siti Aisyah',
                'surel' => 'siti@example.com',
                'tanggal_lahir' => '1995-09-21',
                'anggota_sejak' => now()->subYears(5),
                'tanggal_registrasi' => now()->subYears(5),
                'berlaku_hingga' => now()->addYears(1),
                'institusi' => 'Universitas B',
                'tipe_keanggotaan' => 'Dosen',
                'jenis_kelamin' => 'Perempuan',
                'nomor_identitas' => '987654321',
                'catatan' => 'Sering meminjam buku',
                'tunda_keanggotaan' => false,
                'foto' => null,
                'katasandi' => Hash::make('password123'),
                'konfirmasi_katasandi_baru' => null,
                'program_studi_id' => 2,
            ],
            [
                'nama' => 'Ahmad Fauzi',
                'surel' => 'ahmad@example.com',
                'tanggal_lahir' => '2000-12-10',
                'anggota_sejak' => now()->subYears(2),
                'tanggal_registrasi' => now()->subYears(2),
                'berlaku_hingga' => now()->addYears(3),
                'institusi' => 'Universitas C',
                'tipe_keanggotaan' => 'Mahasiswa',
                'jenis_kelamin' => 'Laki-laki',
                'nomor_identitas' => '456789123',
                'catatan' => null,
                'tunda_keanggotaan' => false,
                'foto' => null,
                'katasandi' => Hash::make('password123'),
                'konfirmasi_katasandi_baru' => null,
                'program_studi_id' => 3,
            ],
            [
                'nama' => 'Dewi Lestari',
                'surel' => 'dewi@example.com',
                'tanggal_lahir' => '1988-03-05',
                'anggota_sejak' => now()->subYears(8),
                'tanggal_registrasi' => now()->subYears(8),
                'berlaku_hingga' => now()->addYears(2),
                'institusi' => 'Universitas D',
                'tipe_keanggotaan' => 'Dosen',
                'jenis_kelamin' => 'Perempuan',
                'nomor_identitas' => '741852963',
                'catatan' => 'Mengajar bidang teknologi',
                'tunda_keanggotaan' => false,
                'foto' => null,
                'katasandi' => Hash::make('password123'),
                'konfirmasi_katasandi_baru' => null,
                'program_studi_id' => 4,
            ],
            [
                'nama' => 'Joko Widodo',
                'surel' => 'joko@example.com',
                'tanggal_lahir' => '1975-07-20',
                'anggota_sejak' => now()->subYears(10),
                'tanggal_registrasi' => now()->subYears(10),
                'berlaku_hingga' => now()->addYears(5),
                'institusi' => 'Umum',
                'tipe_keanggotaan' => 'Umum',
                'jenis_kelamin' => 'Laki-laki',
                'nomor_identitas' => '852963741',
                'catatan' => 'Anggota umum aktif',
                'tunda_keanggotaan' => false,
                'foto' => null,
                'katasandi' => Hash::make('password123'),
                'konfirmasi_katasandi_baru' => null,
                'program_studi_id' => null,
            ],
        ]);
    }
}
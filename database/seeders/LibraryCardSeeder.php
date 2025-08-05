<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\LibraryCard;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LibraryCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Ambil semua user dari database
         $users = User::all();

         // Loop untuk setiap user
         foreach ($users as $user) {
             LibraryCard::updateOrCreate(
                ['user_id' => $user->id], // Pastikan tidak ada duplikasi
                [
                    'barcode' => 'BC-' . str_pad($user->id, 6, '0', STR_PAD_LEFT), // Contoh: BC-000001
                    'rfid_code' => 'RFID-' . strtoupper(Str::random(8)), // ✅ Pakai Str::random()
                    'status' => 'aktif',
                ]
             );
         }
    }
}
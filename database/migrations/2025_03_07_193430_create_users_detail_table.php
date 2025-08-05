<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('laporan_kunjungan_id')->nullable()->constrained('laporan_kunjungan')->nullOnDelete();
            $table->foreignId('kategori_kunjungan_id')->nullable()->constrained('kategori_kunjungan')->nullOnDelete();
            $table->foreignId('program_studi_id')->nullable()->constrained('program_studi')->nullOnDelete();
            $table->foreignId('kartu_anggota_digital_id')->nullable()->constrained('kartu_anggota_perpustakaan_digital')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_detail');
    }
};
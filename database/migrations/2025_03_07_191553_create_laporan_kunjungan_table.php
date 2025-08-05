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
        Schema::create('laporan_kunjungan', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal')->default(now());
            $table->enum('online_offline', ['Online', 'Offline']);
            $table->enum('jenis_keanggotaan', ['Mahasiswa', 'Dosen', 'Umum']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_kunjungan');
    }
};

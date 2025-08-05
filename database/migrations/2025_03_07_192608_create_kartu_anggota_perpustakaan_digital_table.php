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
        Schema::create('kartu_anggota_perpustakaan_digital', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->unique()->constrained('anggota')->cascadeOnDelete();
            $table->string('nim', 45)->unique();
            $table->date('masa_berlaku');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kartu_anggota_perpustakaan_digital');
    }
};

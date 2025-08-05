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
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 45);
            $table->string('surel', 100)->unique(); // Menambahkan surel (email)
            $table->date('tanggal_lahir')->nullable();
            $table->dateTime('anggota_sejak')->nullable();
            $table->dateTime('tanggal_registrasi')->nullable();
            $table->dateTime('berlaku_hingga')->nullable();
            $table->string('institusi', 45)->nullable();
            $table->string('tipe_keanggotaan', 45)->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('nomor_identitas', 45)->unique();
            $table->text('catatan')->nullable();
            $table->boolean('tunda_keanggotaan')->default(false);
            $table->string('foto', 255)->nullable();
            $table->string('katasandi');
            $table->string('konfirmasi_katasandi_baru')->nullable(); // Menambahkan konfirmasi kata sandi baru
            $table->foreignId('program_studi_id')->nullable()->constrained('program_studi')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};
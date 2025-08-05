<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anggota extends Authenticatable
{
    use HasFactory;

    protected $table = 'anggota';
    protected $fillable = [
        'nama',
        'surel',
        'tanggal_lahir',
        'anggota_sejak',
        'tanggal_registrasi',
        'berlaku_hingga',
        'institusi',
        'tipe_keanggotaan',
        'jenis_kelamin',
        'nomor_identitas',
        'tunda_keanggotaan',
        'foto',
        'katasandi',
        'program_studi_id',
        'catatan'
    ];

    protected $hidden = [
        'katasandi',
    ];


    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
    }

    public function riwayatKunjungan()
    {
        return $this->hasMany(RiwayatKunjungan::class, 'anggota_id');
    }


    public function kartuAnggota()
    {
        return $this->hasOne(KartuAnggotaPerpustakaanDigital::class, 'anggota_id');
    }

    public function laporanKunjungan()
    {
        return $this->hasMany(LaporanKunjungan::class, 'anggota_id');
    }

    public function user()
{
    return $this->belongsTo(User::class, 'id');
}

}
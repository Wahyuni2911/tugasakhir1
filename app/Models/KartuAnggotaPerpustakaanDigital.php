<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuAnggotaPerpustakaanDigital extends Model
{
    use HasFactory;

    protected $table = 'kartu_anggota_perpustakaan_digital';
    protected $fillable = ['anggota_id', 'nim', 'masa_berlaku'];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function kunjungans()
    {
        return $this->hasMany(Kunjungan::class, 'kartu_anggota_id');
    }

}

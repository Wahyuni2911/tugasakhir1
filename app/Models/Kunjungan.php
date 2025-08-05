<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;

    protected $table = 'kunjungans';


    protected $fillable = [
        'kartu_anggota_id',
        'kategori_kunjungan_id',
        'waktu_kunjungan',
        'tujuan',
        'latitude',
        'longitude',
    ];

    public function kartuAnggota()
    {
        return $this->belongsTo(KartuAnggotaPerpustakaanDigital::class, 'kartu_anggota_id');
    }

    public function kategoriKunjungan()
    {
        return $this->belongsTo(KategoriKunjungan::class);
    }
}

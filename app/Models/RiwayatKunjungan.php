<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatKunjungan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_kunjungan';
    protected $fillable = [
        'anggota_id',
        'waktu_kunjungan',
        'tujuan_kunjungan',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }
}

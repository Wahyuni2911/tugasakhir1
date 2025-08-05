<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKunjungan extends Model
{
    use HasFactory;

    protected $table = 'laporan_kunjungan';
    protected $fillable = ['kunjungan_id', 'tanggal', 'online_offline', 'jenis_keanggotaan'];


    public function userDetail()
    {
        return $this->hasOne(UsersDetail::class, 'laporan_kunjungan_id');
    }

    protected static function booted()
    {
        static::creating(function ($laporan) {
            if (!$laporan->tanggal) {
                $laporan->tanggal = now();
            }
        });
    }

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class, 'kunjungan_id');
    }
}

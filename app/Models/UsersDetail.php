<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersDetail extends Model
{
    use HasFactory;
    protected $table = 'users_detail';


    protected $fillable = [
        'user_id',
        'laporan_kunjungan_id',
        'kategori_kunjungan_id',
        'program_studi_id',
        'kartu_anggota_digital_id',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = User::find($model->user_id);
            if ($user && $user->role === 'admin') {
                $model->kategori_kunjungan_id = null;
                $model->program_studi_id = null;
                $model->kartu_anggota_digital_id = null;
            }
        });
    }

    // 🔁 RELATIONS
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function laporanKunjungan()
    {
        return $this->belongsTo(LaporanKunjungan::class);
    }

    public function kategoriKunjungan()
    {
        return $this->belongsTo(KategoriKunjungan::class);
    }
    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
    }

    public function kartuAnggotaDigital()
    {
        return $this->belongsTo(KartuAnggotaPerpustakaanDigital::class);
    }
    // Di model Kunjungan atau UsersDetail
    protected $casts = [
        'waktu_kunjungan' => 'datetime',
    ];
}

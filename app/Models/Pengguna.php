<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'pengguna';
    protected $fillable = ['nama_pengguna', 'username', 'password', 'email', 'kategori_kunjungan_id', 'program_studi_id'];

    public function kategoriKunjungan()
    {
        return $this->belongsTo(KategoriKunjungan::class, 'kategori_kunjungan_id');
    }

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
    }
}

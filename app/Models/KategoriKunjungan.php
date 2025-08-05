<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKunjungan extends Model
{
    use HasFactory;
    protected $table = 'kategori_kunjungan';
    protected $fillable = ['nama_kategori'];

    public function pengguna()
    {
        return $this->hasMany(Pengguna::class, 'kategori_kunjungan_id');
    }
}

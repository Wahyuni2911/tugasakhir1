<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;

    protected $table = 'program_studi';
    protected $fillable = ['nama_prodi', 'kode_prodi'];

    public function anggota()
    {
        return $this->hasMany(Anggota::class, 'program_studi_id');
    }

    public function pengguna()
    {
        return $this->hasMany(Pengguna::class, 'program_studi_id');
    }
}

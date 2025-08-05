<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static function boot()
    {
        parent::boot();

        // Event yang dijalankan saat user dibuat
        static::created(function ($user) {
            // Panggil fungsi generateLibraryCard untuk membuat barcode otomatis
            $user->generateLibraryCard();
        });
    }

    public function generateLibraryCard()
    {
        // Tentukan prefix berdasarkan role
        $prefix = match ($this->role) {
            'mahasiswa' => 'MHS',
            'admin' => 'ADM',
            default => 'UMM', // Default untuk umum
        };

        // Ambil tahun dari created_at user
        $tahun = date('Y', strtotime($this->created_at));

        // Format nomor urut (misalnya, user ID 1 menjadi 0001)
        $nomorUrut = str_pad($this->id, 4, '0', STR_PAD_LEFT);

        // Gabungkan prefix, tahun, dan nomor urut untuk barcode unik
        $barcode = "{$prefix}-{$tahun}{$nomorUrut}";

        // Simpan data ke tabel library_cards
        LibraryCard::create([
            'user_id'   => $this->id,
            'barcode'   => $barcode,
            'rfid_code' => 'RFID-' . strtoupper(Str::random(8)),
            'status'    => 'aktif',
        ]);
    }

    public function libraryCard()
    {
        return $this->hasOne(LibraryCard::class);
    }

    public function programStudi()
{
    return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
}

}

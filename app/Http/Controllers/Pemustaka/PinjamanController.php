<?php

namespace App\Http\Controllers\Pemustaka;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    public function index()
    {
        // Data statis untuk daftar pinjaman
        $pinjaman = [
            [
                'judul' => 'Belajar Laravel',
                'gambar' => '/img/book1.jpg',
                'tanggal_peminjaman' => '1 Maret 2024',
                'batas_pengembalian' => '15 Maret 2024',
                'status' => 'Sedang Dipinjam',
                'denda' => 0
            ],
            [
                'judul' => 'Dasar Pemrograman',
                'gambar' => '/img/book2.jpg',
                'tanggal_peminjaman' => '5 Februari 2024',
                'batas_pengembalian' => '20 Februari 2024',
                'status' => 'Terlambat',
                'denda' => 5000
            ],
            [
                'judul' => 'Data Science Pemula',
                'gambar' => '/img/book3.jpg',
                'tanggal_peminjaman' => '10 Januari 2024',
                'batas_pengembalian' => '25 Januari 2024',
                'status' => 'Sudah Dikembalikan',
                'denda' => 0
            ],
        ];

        // Data statis untuk riwayat denda
        $denda = [
            [
                'judul' => 'Dasar Pemrograman',
                'tanggal_pengembalian' => '25 Februari 2024',
                'tanggal_seharusnya' => '20 Februari 2024',
                'total_denda' => 5000
            ]
        ];

        return view('pemustaka.pinjaman.index', compact('pinjaman', 'denda'));
    }
}

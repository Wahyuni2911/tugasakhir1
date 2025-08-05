@extends('app-pemustaka')

@section('title', 'Dashboard Pemustaka')

@section('content')
<section class="top-users">
    <h2>Penikmat Koleksi Tahun Ini</h2>
    <p>Pengunjung terbaik kami, ada di sini. Nama dan foto Anda juga bisa muncul di sini.<br>Rajin - rajinlah
        berkunjung dan membaca.</p>
    <div class="user-list">
        <div class="user">
            <img src="/img/pic-4.png" alt="Raina Anindya">
            <h3>Raina Anindya</h3>
            <p>Mahasiswa</p>
        </div>
        <div class="user">
            <img src="/img/pic-2.png" alt="Dindasari Nurfutiana">
            <h3>Dindasari Nurfutiana</h3>
            <p>Mahasiswa</p>
        </div>
        <div class="user">
            <img src="/img/pic-3.png" alt="Aramata Salsabila">
            <h3>Aramata Kennan</h3>
            <p>Mahasiswa</p>
        </div>
    </div>
</section>

<section class="user-dashboard">
    <h3>{{ Auth::guard('anggota')->user()?->tipe_keanggotaan ?? 'Pengunjung' }}</h3>
    <h2>{{ Auth::guard('anggota')->user()?->nama ?? 'Guest' }}</h2>
    <p>Selamat Datang di Area Anggota Tempat Anda Dapat Melihat Status Keanggotaan dan Peminjaman.</p>
    <div class="dashboard-images">
        <img src="/img/d.png" alt="Status Keanggotaan">
        <img src="/img/d.png" alt="Peminjaman">
    </div>
</section>
@endsection
@extends('app-pemustaka')

@section('title', 'Pinjaman & Denda')

@section('content')
<section class="denda-section">
    <h2>💳 Riwayat Denda</h2>
    <p>Daftar denda yang harus dibayar jika ada keterlambatan pengembalian buku.</p>

    <div class="table-responsive">
        <table class="denda-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Buku</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Tanggal Seharusnya</th>
                    <th>Total Denda</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1.</td>
                    <td>Dasar Pemrograman</td>
                    <td>25 Februari 2024</td>
                    <td>20 Februari 2024</td>
                    <td><span class="denda">Rp 5.000</span></td>
                    <td><button class="btn-bayar">Bayar</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<section class="pinjaman">
    <h2>📚 Pinjaman Saya</h2>
    <p>Daftar buku yang sedang Anda pinjam saat ini.</p>

    <div class="pinjaman-list">
        <div class="pinjaman-item">
            <img src="/img/book1.jpg" alt="Belajar Laravel">
            <div class="pinjaman-info">
                <h3>Belajar Laravel</h3>
                <p><strong>📅 Tanggal Peminjaman:</strong> 1 Maret 2024</p>
                <p><strong>⏳ Batas Pengembalian:</strong> 15 Maret 2024</p>
                <p><strong>📌 Status:</strong> <span class="status-pinjam">Sedang Dipinjam</span></p>
                <button class="btn-perpanjang">🔄 Perpanjang</button>
            </div>
        </div>
        <div class="pinjaman-item">
            <img src="/img/book2.jpg" alt="Dasar Pemrograman">
            <div class="pinjaman-info">
                <h3>Dasar Pemrograman</h3>
                <p><strong>📅 Tanggal Peminjaman:</strong> 5 Februari 2024</p>
                <p><strong>⏳ Batas Pengembalian:</strong> 20 Februari 2024</p>
                <p><strong>📌 Status:</strong> <span class="status-terlambat">Terlambat</span></p>
                <p><strong>💰 Denda:</strong> <span class="denda">Rp 5.000</span></p>
                <button class="btn-bayar">💳 Bayar Denda</button>
            </div>
        </div>
        <div class="pinjaman-item">
            <img src="/img/book3.jpg" alt="Data Science Pemula">
            <div class="pinjaman-info">
                <h3>Data Science Pemula</h3>
                <p><strong>📅 Tanggal Peminjaman:</strong> 10 Januari 2024</p>
                <p><strong>⏳ Batas Pengembalian:</strong> 25 Januari 2024</p>
                <p><strong>📌 Status:</strong> <span class="status-kembali">Sudah Dikembalikan</span></p>
            </div>
        </div>
        <div class="pinjaman-item">
            <img src="/img/book1.jpg" alt="Data Science Pemula">
            <div class="pinjaman-info">
                <h3>Data Science Profesional</h3>
                <p><strong>📅 Tanggal Peminjaman:</strong> 10 Januari 2024</p>
                <p><strong>⏳ Batas Pengembalian:</strong> 25 Januari 2024</p>
                <p><strong>📌 Status:</strong> <span class="status-kembali">Sudah Dikembalikan</span></p>
            </div>
        </div>
    </div>
</section>

<style>
/* 🌟 Layout Umum */
.pinjaman,
.denda-section {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
}

h2 {
    color: #0d3b66;
    text-align: center;
}

/* 📌 Tabel Denda */
.table-responsive {
    overflow-x: auto;
    max-width: 100%;
}


.denda-table {
    width: 100%;
    border-collapse: collapse;
}

.denda-table th,
.denda-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
    white-space: nowrap;
}

.denda-table th {
    background: #0d3b66;
    color: white;
}

/* 📌 Pinjaman List */
.pinjaman-list {
    display: flex;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    overflow-x: auto;
    /* Scroll horizontal */
    white-space: nowrap;
    padding: 10px;
    scroll-snap-type: x mandatory;
    -webkit-overflow-scrolling: touch;
    /* Smooth scrolling di iOS */
}

.pinjaman-item {
    flex: 0 0 auto;
    max-width: 250px;
    background: #f8f9fa;
    width: 100%;
    /* Ukuran tetap untuk tiap buku */
    background: #f8f9fa;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    transition: 0.3s;
    display: flex;
    flex-direction: column;
    align-items: center;
    scroll-snap-align: start;
}

.pinjaman-item:hover {
    transform: scale(1.05);
}

.pinjaman-item img {
    width: 120px;
    height: 160px;
    object-fit: cover;
    border-radius: 5px;
    margin-bottom: 10px;
}

/* 📌 Info Buku */
.pinjaman-info {
    display: flex;
    flex-direction: column;

    width: 100%;
    min-width: 200px;
    /* Supaya teks tidak menyusut di layar kecil */
    word-wrap: break-word;
    overflow-wrap: break-word;
    white-space: normal;

    align-items: center;
    /* Pusatkan elemen dalam div */
    text-align: center;
    /* Pusatkan teks */
}

/* Beri jarak antar teks agar lebih rapi */
.pinjaman-info p {
    margin-bottom: 6px;
    /* Tambahkan jarak antar teks */
    white-space: nowrap;
    /* Pastikan teks tetap dalam satu baris */
    overflow: hidden;
    text-overflow: ellipsis;
}

p {
    white-space: normal !important;
    overflow: visible !important;
    text-overflow: clip !important;
    display: block !important;
}


/* 📌 Status */
.status-pinjam {
    color: blue;
    font-weight: bold;
}

.status-terlambat {
    color: orange;
    font-weight: bold;
}

.status-kembali {
    color: green;
    font-weight: bold;
}

.denda {
    color: red;
    font-weight: bold;
}

/* 🎨 Tombol */
.btn-perpanjang,
.btn-bayar {
    width: 80%;
    /* Sesuaikan lebar tombol */
    max-width: 180px;
    /* Jangan terlalu lebar di layar besar */
    background: #007bff;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
    margin-top: 10px;
    margin: 10px auto;
    /* Auto agar tetap di tengah */
}

.btn-bayar {
    background: #dc3545;
}

.btn-perpanjang:hover {
    background: #0056b3;
}

.btn-bayar:hover {
    background: #a71d2a;
}

/* Saat layar lebih kecil, hanya 2 item per baris */
@media (max-width: 992px) {
    .pinjaman-list {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }

    .pinjaman-item {
        flex: 1 1 calc(50% - 20px);
    }
}

/* Saat layar lebih kecil, hanya 1 item per baris */
@media (max-width: 600px) {
    .pinjaman-item {
        flex: 1 1 100%;
    }

    .pinjaman-list {
        grid-template-columns: 1fr;
    }

    .btn-perpanjang,
    .btn-bayar {
        width: 100%;
        /* Gunakan lebar penuh agar lebih rapi */
        max-width: 250px;
        /* Batasi ukuran agar tidak terlalu besar */
        display: block;
        text-align: center;
        font-size: 16px;
        /* Perbesar teks agar mudah diklik */
        padding: 12px;
        /* Tambah padding untuk kenyamanan */
        margin: 10px auto;
        /* Pastikan tetap di tengah */
    }

    .table-responsive {
        overflow-x: auto;
    }

    .denda-table {
        min-width: 500px;
    }

    .pinjaman {
        margin-bottom: 50px;
    }

    .pinjaman-info p {
        font-size: 14px;
        /* Perkecil ukuran teks agar lebih pas */
        white-space: normal;
        /* Boleh turun ke baris baru jika terlalu panjang */
    }
}

/* 📱 Responsif Mobile */
@media (max-width: 768px) {
    .pinjaman-list {
        grid-template-columns: 1fr;
        gap: 10px;
    }

    .pinjaman-item {
        width: 200px;
    }

    .btn-perpanjang,
    .btn-bayar {
        padding: 14px;
    }

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .denda-table {
        min-width: 500px;
    }

    .pinjaman {
        margin-bottom: 50px;
        /* Memberi jarak antara pinjaman dan footer */
    }
}
</style>

@endsection

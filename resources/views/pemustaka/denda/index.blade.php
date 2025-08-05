@extends('app-pemustaka')

@section('title', 'Bayar Denda')

@section('content')
<section class="bayar-denda">
    <h2>💳 Pembayaran Denda</h2>
    <p>Silakan lakukan pembayaran untuk melunasi denda keterlambatan.</p>

    <div class="denda-detail">
        <h3>📖 Buku: Dasar Pemrograman</h3>
        <p><strong>📅 Tanggal Seharusnya:</strong> 20 Februari 2024</p>
        <p><strong>📅 Tanggal Pengembalian:</strong> 25 Februari 2024</p>
        <p><strong>💰 Total Denda:</strong> <span class="denda">Rp 5.000</span></p>
    </div>

    <form action="#" method="POST">
        <label for="metode">Pilih Metode Pembayaran:</label>
        <select id="metode" name="metode">
            <option value="transfer">Bank Transfer</option>
            <option value="ewallet">E-Wallet</option>
            <option value="cash">Tunai di Perpustakaan</option>
        </select>
        <button type="submit" class="btn-bayar">💳 Bayar Sekarang</button>
    </form>

    <a href="/pinjaman" class="btn-kembali">⬅ Kembali ke Riwayat Pinjaman</a>
</section>

<style>
/* 🌟 Bayar Denda */
.bayar-denda {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.denda-detail {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.denda {
    color: red;
    font-weight: bold;
}

form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
}

select {
    padding: 10px;
    border-radius: 5px;
    width: 100%;
    max-width: 300px;
    margin-bottom: 15px;
}

.btn-bayar {
    background: #28a745;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    max-width: 300px;
    transition: background 0.3s ease;
}

.btn-bayar:hover {
    background: #218838;
}

.btn-kembali {
    display: inline-block;
    margin-top: 15px;
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}

.btn-kembali:hover {
    text-decoration: underline;
}

/* 🌍 Responsif untuk mobile */
@media (max-width: 480px) {
    .bayar-denda {
        width: 90%;
        padding: 15px;
    }

    .denda-detail {
        padding: 10px;
    }

    select,
    .btn-bayar {
        max-width: 100%;
    }
}
</style>

@endsection
<footer>
    <!-- Footer untuk Desktop -->
    <div class="footer-desktop">
        <p>&copy; {{ date('Y') }} Perpustakaan Politeknik Negeri Banyuwangi. All Rights Reserved.</p>
    </div>

    <!-- Footer untuk Mobile -->
    <div class="footer-mobile">
        <div class="footer-nav">
            <a href="/"><i class="fa-solid fa-home"></i></a>
            <a href="/perekam-kunjungan"><i class="fa-solid fa-clipboard-list"></i></a>
            <a href="/riwayat-kunjungan"><i class="fa-solid fa-bars"></i></a>
            <a href="/profil"><i class="fa-solid fa-user"></i></a>
        </div>
    </div>
</footer>

<style>
/* Footer Desktop - Tampil hanya di layar besar */
.footer-desktop {
    display: flex;
    justify-content: center;
    align-items: center;
    background: #0d3b66;
    color: white;
    padding: 15px;
    font-size: 14px;
}

.footer-mobile {
    display: none;
    /* Sembunyikan footer mobile di desktop */
}

/* Footer Mobile - Tampil hanya di layar kecil */
@media (max-width: 768px) {
    .footer-desktop {
        display: none;
        /* Sembunyikan footer desktop di mobile */
    }

    .footer-mobile {
        display: flex;
        justify-content: space-around;
        align-items: center;
        background: #0d3b66;
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
        padding: 12px 0;
        box-shadow: 0px -2px 5px rgba(0, 0, 0, 0.2);
    }

    .footer-nav {
        display: flex;
        justify-content: space-between;
        width: 80%;
        /* Atur agar ikon tidak terlalu rapat */
        max-width: 400px;
        /* Batasi lebar maksimal */
    }

    .footer-nav a {
        color: white;
        font-size: 22px;
        text-decoration: none;
        padding: 10px;
        /* Tambahkan padding agar tidak terlalu kecil */
        transition: transform 0.2s ease-in-out;
    }

    .footer-nav a:hover {
        transform: scale(1.1);
        /* Efek hover biar lebih interaktif */
    }

    /* 🚀 Fix Ruang Kosong di Atas Footer */
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    body {
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1;
        padding-bottom: 60px;
        /* Kurangi padding agar konten lebih dekat ke footer */
    }

    .bayar-denda {
        margin-bottom: 10px !important;
        /* Kurangi margin bawah */
        padding-bottom: 10px !important;
    }
}
</style>

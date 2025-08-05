@extends('app-pemustaka')

@section('title', 'Scan Barcode')

@section('content')
<section class="scan-container">
    <div class="scan-option">
        <a href="{{ route('scan.barcode') }}" class="scan-card">
            <img src="{{ asset('img/scan-barcode.jpg') }}" alt="Scan Barcode">
            <p>Scan Kartu Perpustakaan Digital</p>
        </a>

        <a href="{{ route('geo.lokasi') }}" class="scan-card">
            <img src="{{ asset('img/geo.jpg') }}" alt="Geolokasi">
            <p>Geolokasi</p>
        </a>
    </div>
</section>

<style>
    /* Container utama */
    .scan-container {
        text-align: center;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        min-height: calc(60vh);
        margin-top: 80px;
        /* Menurunkan posisi elemen */
    }

    /* Opsi Scan */
    .scan-option {
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap;
        max-width: 400px;
        /* Batasan lebar agar tetap responsif */
    }

    /* Kartu Scan */
    .scan-card {
        width: 160px;
        height: 200px;
        background: white;
        border-radius: 10px;
        box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.2);
        text-align: center;
        padding: 10px;
        text-decoration: none;
        color: black;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        transition: transform 0.2s ease-in-out;
    }

    .scan-card:hover {
        transform: scale(1.05);
    }

    .scan-card img {
        width: 100px;
        height: auto;
        margin-bottom: 10px;
    }

    /* Responsif: Susun bersebelahan saat di layar kecil */
    @media (max-width: 480px) {
        .scan-option {
            flex-direction: row;
            /* Supaya tetap sejajar di layar kecil */
            justify-content: space-evenly;
            width: 100%;
        }

        .scan-card {
            width: 140px;
            /* Sedikit lebih kecil untuk muat di layar kecil */
            height: 180px;
            margin-top: 80px;
        }
    }
</style>
@endsection
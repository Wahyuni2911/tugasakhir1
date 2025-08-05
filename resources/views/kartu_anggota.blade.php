@extends('layouts.app')

@section('content')
<div class="kartu-anggota">
    <div class="header">
        <h2>PERPUSTAKAAN</h2>
        <p>POLITEKNIK NEGERI BANYUWANGI</p>
    </div>
    <div class="content">
        <img class="foto" src="{{ asset('storage/foto_anggota/' . Auth::user()->id . '.jpg') }}" alt="Foto">
        <p><strong>Nama:</strong> {{ Auth::user()->nama }}</p>
        <p><strong>NIM:</strong> {{ Auth::user()->nomor_identitas }}</p>
        <p><strong>Prodi:</strong> {{ Auth::user()->prodi }}</p>
        <p><strong>Berlaku s.d:</strong> {{ date('d M Y', strtotime(Auth::user()->berlaku_hingga)) }}</p>

        <!-- Generate QR Code dari Nomor Identitas -->
        <div class="qr-code">
            {!! QrCode::size(100)->generate(Auth::user()->nomor_identitas) !!}
        </div>
    </div>
</div>

<!-- Tombol Cetak -->
<button onclick="window.print()">🖨 Cetak / Simpan PDF</button>

<style>
.kartu-anggota {
    width: 350px;
    padding: 10px;
    border: 2px solid black;
    text-align: center;
    background: white;
}

.header {
    background: #003366;
    color: white;
    padding: 10px;
}

.foto {
    width: 80px;
    height: 100px;
    border-radius: 5px;
}

.qr-code {
    margin-top: 10px;
}

@media print {
    button {
        display: none;
    }
}
</style>
@endsection

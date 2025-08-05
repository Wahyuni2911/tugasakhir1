@extends('app-pemustaka')

@section('title', 'Scan Barcode')

@section('content')
<section class="scan-barcode">
    <h2>📷 Scan Barcode</h2>
    <p>Arahkan kamera ke barcode untuk memindai.</p>

    <div class="scan-box" id="reader">

        <video id="preview"></video>
    </div>

    <button class="btn-back" onclick="window.history.back()">⬅ Kembali</button>
</section>

<script src="https://unpkg.com/html5-qrcode"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const scanner = new Html5QrcodeScanner("reader", {
        fps: 10,
        qrbox: 250
    });

    scanner.render(function(decodedText) {
        alert("Barcode terbaca: " + decodedText);
        window.location.href = "/proses-scan?data=" + encodeURIComponent(decodedText);
    });
});
</script>


<style>
.scan-barcode {
    text-align: center;
    padding: 20px;
    min-height: calc(70vh);
}

.scan-box {
    width: 300px;
    height: 300px;
    margin: auto;
    border: 2px dashed #007bff;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-back {
    margin-top: 15px;
    padding: 10px;
    border: none;
    background: #003366;
    color: white;
    border-radius: 5px;
    cursor: pointer;
}
</style>
@endsection
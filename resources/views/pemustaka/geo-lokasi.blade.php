@extends('app-pemustaka')

@section('title', 'Rekam Kunjungan Geolokasi')

@section('content')
<section class="geo-container">
    <h3>📍 Rekam Kunjungan Geolokasi</h3>

    <div class="geo-alert">
        ⚠️ Jangan lupa mengaktifkan lokasi/GPS
    </div>

    @if(session('success'))
    <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-500 text-white px-4 py-2 rounded mb-4">
        {{ session('error') }}
    </div>
    @endif

    <!-- Peta akan ditampilkan di sini -->
    <div id="geo-map"></div>

    @php
    $anggota = Auth::guard('anggota')->user();
    @endphp

    <form action="{{ route('geo.submit') }}" method="POST" class="geo-form">
        @csrf

        <label>Nama*</label>
        <input type="text" name="nama" value="{{ $anggota->nama }}" readonly>

        <label>Email*</label>
        <input type="email" name="email" value="{{ $anggota->surel }}" readonly>

        <label>Status*</label>
        <input type="text" name="status" value="{{ $anggota->tipe_keanggotaan }}" readonly>

        <label>Prodi*</label>
        <input type="text" name="prodi" value="{{ $anggota->programStudi->nama_prodi }}" readonly>

        <label>Keperluan*</label>
        <select name="kategori_kunjungan_id" required class="geo-select">
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategoriKunjungan as $kategori)
            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
            @endforeach
        </select>
        <label>Latitude</label>
        <input type="text" name="latitude_display" id="latitude_display" readonly>

        <label>Longitude</label>
        <input type="text" name="longitude_display" id="longitude_display" readonly>
        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">

        <button type="submit" id="submit-btn">Submit</button>

    </form>

</section>

<!-- Leaflet.js untuk peta -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
const geolocations = @json($geolocations);

// Fungsi menghitung jarak antara dua koordinat
function getDistanceInMeters(lat1, lon1, lat2, lon2) {
    const R = 6371000;
    const dLat = (lat2 - lat1) * Math.PI / 180;
    const dLon = (lon2 - lon1) * Math.PI / 180;
    const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
        Math.sin(dLon / 2) * Math.sin(dLon / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return R * c;
}

document.addEventListener("DOMContentLoaded", function() {
    const map = L.map('geo-map').setView([-8.2192, 114.3763], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const userMarker = L.marker([-8.2192, 114.3763], {
        draggable: false
    }).addTo(map);
    const submitBtn = document.getElementById("submit-btn");

    const loading = document.createElement('div');
    loading.innerHTML = "📡 Mendeteksi lokasi Anda...";
    loading.classList.add('geo-alert', 'bg-blue-500');
    document.querySelector('.geo-container').prepend(loading);

    // Tampilkan semua titik lokasi referensi
    const markers = [];
    geolocations.forEach(loc => {
        const marker = L.marker([parseFloat(loc.latitude), parseFloat(loc.longitude)])
            .addTo(map)
            .bindPopup(`<b>${loc.deskripsi}</b><br>Lat: ${loc.latitude}<br>Lng: ${loc.longitude}`);
        markers.push(marker.getLatLng());
    });
    if (markers.length > 0) {
        map.fitBounds(markers);
    }

    // Tombol retry manual
    const retryBtn = document.createElement('button');
    retryBtn.innerText = "🔄 Coba Deteksi Ulang Lokasi";
    retryBtn.classList.add('geo-form', 'bg-yellow-500');
    retryBtn.style.marginTop = "10px";
    retryBtn.onclick = () => detectLocation();
    document.querySelector('.geo-container').appendChild(retryBtn);

    function detectLocation() {
        loading.innerHTML = "📡 Mendeteksi ulang lokasi...";
        submitBtn.disabled = true;
        submitBtn.style.opacity = 0.5;

        navigator.geolocation.getCurrentPosition(successFn, errorFn, {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        });
    }

    // Revisi
    function successFn(position) {
        const lat = position.coords.latitude;
        const lng = position.coords.longitude;

        document.getElementById("latitude").value = lat;
        document.getElementById("longitude").value = lng;
        document.getElementById("latitude_display").value = lat;
        document.getElementById("longitude_display").value = lng;

        userMarker.setLatLng([lat, lng]).bindPopup("📍 Lokasi Anda").openPopup();
        map.setView([lat, lng], 17);

        // Bangun polygon dari titik geolokasi
        const polygonCoords = geolocations.map(loc => [parseFloat(loc.latitude), parseFloat(loc.longitude)]);
        const areaPolygon = L.polygon(polygonCoords, {
            color: 'blue',
            fillOpacity: 0.2
        }).addTo(map);

        const userLatLng = L.latLng(lat, lng);
        const isInside = leafletPip.pointInLayer(userLatLng, areaPolygon).length > 0;

        // Hitung jarak ke titik terdekat untuk notifikasi
        let minDistance = Infinity;
        for (const loc of geolocations) {
            const distance = getDistanceInMeters(lat, lng, parseFloat(loc.latitude), parseFloat(loc.longitude));
            minDistance = Math.min(minDistance, distance);
        }

        if (!isInside || minDistance > 10) {
            const warning = document.createElement('div');
            warning.innerHTML =
                `<strong>🚫 Anda berada di luar area yang ditentukan (Jarak ke titik terdekat: ${Math.round(minDistance)} meter).</strong><br>Silakan periksa GPS Anda atau coba deteksi ulang.`;
            warning.classList.add('geo-alert', 'bg-yellow-500', 'text-black');
            document.querySelector('.geo-container').prepend(warning);

            submitBtn.disabled = true;
            submitBtn.style.opacity = 0.5;
        } else {
            const successNote = document.createElement('div');
            successNote.innerHTML =
                `✅ Lokasi Anda valid! (Jarak ke titik terdekat: ${Math.round(minDistance)} meter)`;
            successNote.classList.add('geo-alert', 'bg-green-500');
            document.querySelector('.geo-container').prepend(successNote);

            submitBtn.disabled = false;
            submitBtn.style.opacity = 1;
        }

        loading.remove();
    }


    function errorFn(err) {
        loading.remove();
        alert("❌ Gagal mendeteksi lokasi. Pastikan GPS aktif dan beri izin lokasi pada browser.");
        submitBtn.disabled = true;
        submitBtn.style.opacity = 0.5;
    }

    // Revisi sampai sini

    // Cek izin lokasi browser (untuk edukasi user)
    if (navigator.permissions) {
        navigator.permissions.query({
            name: 'geolocation'
        }).then(function(result) {
            if (result.state === 'denied') {
                alert(
                    "⚠️ Izin lokasi ditolak oleh browser. Silakan aktifkan izin lokasi dari pengaturan browser."
                );
            }
        });
    }

    detectLocation(); // Panggil saat pertama kali
});
</script>



<style>
.geo-container {
    text-align: center;
    padding: 20px;
}

.geo-alert {
    background: #ff6b6b;
    color: white;
    padding: 10px;
    border-radius: 5px;
    font-weight: bold;
    margin-bottom: 15px;
}

.geo-alert.bg-yellow-500 {
    background: #facc15;
    color: #000;
}

#geo-map {
    width: 100%;
    max-width: 500px;
    height: 250px;
    margin: 30px auto;
    border-radius: 8px;
    overflow: hidden;
    background: #ddd;
    z-index: 900;
}

.geo-form {
    margin-top: 15px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.geo-form label {
    width: 100%;
    max-width: 350px;
    text-align: left;
    font-weight: bold;
    margin-top: 10px;
}

.geo-form input,
.geo-select {
    width: 100%;
    max-width: 350px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-top: 5px;
    font-size: 1rem;
}



.geo-select {
    width: 100%;
    max-width: 350px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-top: 5px;
    font-size: 1rem;
    background-color: #fff;
    color: #333;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url("data:image/svg+xml;utf8,<svg fill='black' height='18' viewBox='0 0 24 24' width='18' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 16px;
}


.geo-form button {
    margin-top: 15px;
    padding: 10px 20px;
    background: #003366;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    transition: background 0.3s;
}

.geo-form button:hover {
    background: #005299;
}

.geo-input {
    width: 100%;
    max-width: 450px;
    padding: 10px;
    margin-top: 5px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    background-color: #fff;
    color: #333;
    appearance: none;
}

.geo-input:focus {
    outline: none;
    border-color: #005299;
    box-shadow: 0 0 0 2px rgba(0, 82, 153, 0.2);
}

/* Untuk select: tambahkan ikon panah */
select.geo-input {
    background-image: url("data:image/svg+xml;utf8,<svg fill='black' height='18' viewBox='0 0 24 24' width='18' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 16px;
    -webkit-appearance: none;
    -moz-appearance: none;
}

/* Responsive fix */
@media (max-width: 480px) {

    .geo-form input,
    .geo-select {
        font-size: 1rem;
        padding: 12px;
        max-width: 100%;
    }

}
</style>
@endsection

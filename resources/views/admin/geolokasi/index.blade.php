@extends('app')

@section('title', 'Geolocation')

@section('content')

    <!-- Breadcrumb -->
    <div class="text-sm text-gray-500 text-right mb-4">
        <a href="/dashboard" class="hover:underline">Dashboard</a> >
        <span class="text-gray-800 font-semibold">Geolocation</span>
    </div>

    <!-- Flash Success -->
    @if (session('success'))
        <div id="flash-success" class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4 transition-opacity duration-500">
            {{ session('success') }}
        </div>
    @endif

    <!-- Main Container -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Map Section -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow p-4">
            <div id="map" class="w-full h-[500px] rounded-xl"></div>

            <!-- Reset Button -->
            {{-- <div class="mt-4 flex justify-center">
                <button onclick="resetKoordinat()"
                    class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-full shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v6h6M20 20v-6h-6M4 20l5-5m0 0l-5-5m5 5h12" />
                    </svg>
                    Reset
                </button>
            </div> --}}
            <!-- Reset Button -->
            <div class="mt-4 flex justify-center">
                <form method="POST" action="{{ route('geolocation.reset') }}"
                    onsubmit="return confirm('Yakin ingin menghapus semua data koordinat?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-full shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v6h6M20 20v-6h-6M4 20l5-5m0 0l-5-5m5 5h12" />
                        </svg>
                        Reset Data
                    </button>
                </form>
            </div>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold text-blue-700 mb-4 border-b pb-2">Titik Koordinat</h2>
            <form id="koordinatForm" method="POST" action="{{ route('geolocation.store') }}">
                @csrf
                @for ($i = 1; $i <= 4; $i++)
                    <div class="mb-4">
                        <label class="block text-sm text-gray-700 mb-1">Koordinat {{ $i }}</label>
                        <input type="text" id="koordinat{{ $i }}"
                            class="w-full border rounded px-3 py-2 bg-gray-100" readonly>

                        <!-- Hidden fields -->
                        <input type="hidden" name="latitude[]" id="latitude{{ $i }}">
                        <input type="hidden" name="longitude[]" id="longitude{{ $i }}">

                        <!-- Deskripsi Lokasi -->
                        <input type="text" name="deskripsi[]" placeholder="Contoh: Pojok Timur Gedung A"
                            class="mt-2 w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                            id="deskripsi{{ $i }}">
                    </div>
                @endfor

                <button type="submit"
                    class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-2 rounded-md shadow mt-2">Save</button>
            </form>

            <!-- Show Saved Coordinates -->
            @if (isset($geolocations) && $geolocations->count() > 0)
                <div class="mt-6">
                    <h3 class="text-md font-semibold text-gray-800 mb-2">Hasil Titik Koordinat Tersimpan:</h3>
                    <table class="w-full text-sm text-left border border-gray-200 rounded-lg">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="px-3 py-2 border">#</th>
                                <th class="px-3 py-2 border">Latitude</th>
                                <th class="px-3 py-2 border">Longitude</th>
                                <th class="px-3 py-2 border">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($geolocations as $index => $geo)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="px-3 py-2 border">{{ $index + 1 }}</td>
                                    <td class="px-3 py-2 border text-green-600 font-mono">{{ $geo->latitude }}</td>
                                    <td class="px-3 py-2 border text-blue-600 font-mono">{{ $geo->longitude }}</td>
                                    <td class="px-3 py-2 border">{{ $geo->deskripsi }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- Map Interaction Logic -->
    <script>
        const savedCoordinates = @json($geolocations);
        let koordinatIndex = 0;
        let markerGroup = L.layerGroup();
        let koordinatArray = [];

        const map = L.map('map').setView([-8.295958, 114.305229], 17);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Leaflet | © OpenStreetMap contributors'
        }).addTo(map);

        markerGroup.addTo(map);

        savedCoordinates.forEach((geo, index) => {
            const lat = parseFloat(geo.latitude);
            const lng = parseFloat(geo.longitude);
            const deskripsi = geo.deskripsi || `Koordinat ${index + 1}`;

            const marker = L.marker([lat, lng]).addTo(markerGroup);
            marker.bindPopup(`<strong>${deskripsi}</strong><br>${lat}, ${lng}`);
        });

        map.on('click', function(e) {
            if (koordinatIndex >= 4) return;

            const {
                lat,
                lng
            } = e.latlng;
            const koordinatText = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
            koordinatArray.push([lat, lng]);

            // Tambahkan marker
            const marker = L.marker(e.latlng).addTo(markerGroup);

            // Set input nilai
            document.getElementById(`koordinat${koordinatIndex + 1}`).value = koordinatText;
            document.getElementById(`latitude${koordinatIndex + 1}`).value = lat.toFixed(6);
            document.getElementById(`longitude${koordinatIndex + 1}`).value = lng.toFixed(6);

            koordinatIndex++;
        });

        function resetKoordinat() {
            markerGroup.clearLayers();
            koordinatIndex = 0;
            koordinatArray = [];

            for (let i = 1; i <= 4; i++) {
                document.getElementById(`koordinat${i}`).value = '';
                document.getElementById(`latitude${i}`).value = '';
                document.getElementById(`longitude${i}`).value = '';
                document.getElementById(`deskripsi${i}`).value = '';
            }
        }

        // Hilangkan flash success setelah 5 detik
        setTimeout(() => {
            const flash = document.getElementById('flash-success');
            if (flash) {
                flash.classList.add('opacity-0'); // Transisi memudar
                setTimeout(() => flash.remove(), 500); // Hapus elemen setelah transisi
            }
        }, 5000);
    </script>

@endsection

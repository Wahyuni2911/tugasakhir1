<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login dengan Barcode - Perpustakaan Poliwangi</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
    /* Warna khas Poliwangi */
    .bg-poli-dark {
        background-color: #004085;
    }

    .bg-poli-light {
        background-color: #007bff;
    }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-md bg-white p-6 rounded-2xl shadow-md">
        <!-- Logo -->
        <div class="flex justify-center mb-4">
            <img src="/img/logo.png" alt="Poliwangi Logo" class="w-20">
        </div>

        <h2 class="text-2xl font-bold text-center text-blue-700 mb-2">Login Barcode Anggota</h2>
        <p class="text-gray-600 text-center mb-6 text-sm">Silakan scan barcode kartu anggota untuk masuk ke sistem.</p>

        <form action="{{ route('barcode.login') }}" method="POST" id="barcodeForm">
            @csrf
            <div class="mb-4">
                <label for="barcode" class="block text-sm font-medium text-gray-700 mb-1">Scan Barcode</label>
                <input type="text" name="barcode" id="barcode"
                    class="border-2 border-blue-500 text-center text-lg rounded-full p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Scan barcode di sini..." required autofocus>

                @error('barcode')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-full font-semibold transition-all">
                Login
            </button>
        </form>

        <p class="text-sm text-center text-gray-600 mt-6">
            Belum punya barcode? <a href="{{ route('pendaftaran-anggota.form') }}"
                class="text-blue-600 font-semibold hover:underline">Daftar sebagai anggota</a>
        </p>
    </div>

    <script>
    // Fokus otomatis ke input saat halaman dimuat
    document.getElementById("barcode").focus();

    // Auto-submit ketika panjang input memenuhi syarat
    document.getElementById("barcode").addEventListener("input", function() {
        if (this.value.length >= 10) { // Sesuaikan dengan panjang barcode Anda
            document.getElementById("barcodeForm").submit();
        }
    });
    </script>

</body>

</html>

@extends('app')

@section('title', 'Pendaftaran Anggota')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md border border-gray-300">
    <div class="text-sm text-gray-500 mb-4 text-right">
        <a href="/dashboard" class="hover:underline">Dashboard</a> >
        <span class="text-gray-800 font-semibold">Pendaftaran Anggota</span>
    </div>

    <h2 class="text-lg font-bold mb-4">Pendaftaran Anggota</h2>
    @if (session('success'))
    <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
    @endif

    <!-- Form Pendaftaran -->
    <form action="{{ route('pendaftaran-anggota.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="text-gray-700 font-semibold">Nama Anggota</label>
                <input type="text" name="nama" class="border p-2 rounded w-full">
            </div>
            <div>
                <label class="text-gray-700 font-semibold">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="border p-2 rounded w-full">
            </div>
            <div>
                <label class="text-gray-700 font-semibold">Anggota Sejak</label>
                <input type="date" name="anggota_sejak" class="border p-2 rounded w-full">
            </div>
            <div>
                <label class="text-gray-700 font-semibold">Tanggal Registrasi</label>
                <input type="date" name="tanggal_registrasi" class="border p-2 rounded w-full">
            </div>
            <div>
                <label class="text-gray-700 font-semibold">Berlaku Hingga</label>
                <input type="date" name="berlaku_hingga" class="border p-2 rounded w-full">
                <div class="mt-1">
                    <input type="checkbox"> <span class="text-gray-700">Set Otomatis</span>
                </div>
            </div>
            <div>
                <label class="text-gray-700 font-semibold">Institusi</label>
                <input type="text" name="institusi" class="border p-2 rounded w-full">
            </div>
            <div>
                <label class="text-gray-700 font-semibold">Tipe Keanggotaan</label>
                <input type="text" name="tipe_keanggotaan" class="border p-2 rounded w-full">
            </div>
            <div>
                <label class="text-gray-700 font-semibold">Jenis Kelamin</label>
                <div class="flex space-x-4">
                    <label><input type="radio" name="jenis_kelamin" value="Laki-laki"> Laki-laki</label>
                    <label><input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan</label>
                </div>
            </div>
            <div>
                <label class="text-gray-700 font-semibold">Nomor Identitas</label>
                <input type="text" name="nomor_identitas"
                    class="border p-2 rounded w-full @error('nomor_identitas') border-red-500 @enderror"
                    value="{{ old('nomor_identitas') }}">
                @error('nomor_identitas') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="text-gray-700 font-semibold">Tunda Keanggotaan</label>
                <select name="tunda_keanggotaan" class="border p-2 rounded w-full">
                    <option value="1">Ya</option>
                    <option value="0" selected>Tidak</option>
                </select>
            </div>
            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Kolom Foto -->
                <div class="bg-white p-6 rounded-lg border border-gray-300 w-full">
                    <label class="text-gray-700 font-semibold block mb-3">Foto</label>
                    <div class="flex flex-col items-center">
                        <!-- Pratinjau Gambar atau Video -->
                        <div
                            class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center border mb-3 relative overflow-hidden">
                            <img id="previewFoto" src="#" class="w-full h-full rounded-full hidden absolute"
                                alt="Foto Profil">
                            <video id="video" class="w-full h-full rounded-full hidden absolute"></video>
                            <i class="fas fa-user text-gray-500 text-5xl" id="defaultIcon"></i>
                        </div>

                        <!-- Input Upload -->
                        <input type="file" class="hidden" id="uploadFoto" name="foto" accept="image/png, image/jpeg"
                            onchange="previewImage(event)">
                        <label for="uploadFoto"
                            class="bg-gray-500 text-white px-4 py-2 rounded cursor-pointer text-center w-full">
                            Pilih Foto
                        </label>
                    </div>
                </div>

                <!-- Kolom Surel -->
                <div class="bg-white p-6 rounded-lg border border-gray-300 flex flex-col w-full">
                    <label class="text-gray-700 font-semibold block mb-3">Surel</label>
                    <input type="email" name="surel" class="border p-3 rounded w-full">
                </div>
            </div>
            <div>
                <label class="text-gray-700 font-semibold">Program Studi</label>
                <select name="program_studi_id" class="border p-2 rounded w-full" required>
                    <option value="">-- Pilih Program Studi --</option>
                    @foreach ($programStudiList as $program)
                    <option value="{{ $program->id }}">{{ $program->nama_prodi }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-gray-700 font-semibold">Catatan</label>
                <textarea name="catatan" class="border p-2 rounded w-full" rows="3">{{ old('catatan') }}</textarea>
            </div>


            <div class="md:col-span-2 grid grid-cols-2 gap-4">
                <div>
                    <label class="text-gray-700 font-semibold">Kata Sandi Baru</label>
                    <input type="password" name="katasandi" class="border p-2 rounded w-full">
                </div>
                <div>
                    <label class="text-gray-700 font-semibold">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" name="konfirmasi_katasandi_baru" class="border p-2 rounded w-full">
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-3 mt-6">
            <button type="reset" class="bg-blue-200 text-blue-600 px-4 py-2 rounded">Batal</button>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </form>
</div>
<script>
let videoStream = null;

document.getElementById('startCamera').addEventListener('click', function() {
    navigator.mediaDevices.getUserMedia({
            video: true
        })
        .then(function(stream) {
            videoStream = stream;
            let video = document.getElementById('video');
            let icon = document.getElementById('defaultIcon');
            let preview = document.getElementById('previewFoto');

            video.srcObject = stream;
            video.play();
            video.classList.remove('hidden');
            icon.classList.add('hidden');
            preview.classList.add('hidden');
        })
        .catch(function(error) {
            alert("Kamera tidak dapat diakses: " + error.message);
        });
});

document.getElementById('captureImage').addEventListener('click', function() {
    let video = document.getElementById('video');
    let canvas = document.getElementById('canvas');
    let preview = document.getElementById('previewFoto');

    if (videoStream && !video.classList.contains('hidden')) {
        let context = canvas.getContext('2d');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        preview.src = canvas.toDataURL("image/png");
        preview.classList.remove('hidden');

        video.classList.add('hidden');

        // Hentikan kamera setelah mengambil gambar
        videoStream.getTracks().forEach(track => track.stop());
        videoStream = null;
    } else {
        alert("Nyalakan kamera terlebih dahulu!");
    }
});

document.getElementById('resetImage').addEventListener('click', function() {
    let preview = document.getElementById('previewFoto');
    let icon = document.getElementById('defaultIcon');
    let video = document.getElementById('video');

    preview.classList.add('hidden');
    preview.src = "#";
    icon.classList.remove('hidden');
    video.classList.add('hidden');

    if (videoStream) {
        videoStream.getTracks().forEach(track => track.stop());
        videoStream = null;
    }
});

function previewImage(event) {
    let reader = new FileReader();
    reader.onload = function() {
        let preview = document.getElementById('previewFoto');
        let icon = document.getElementById('defaultIcon');
        let video = document.getElementById('video');

        preview.src = reader.result;
        preview.classList.remove('hidden');
        icon.classList.add('hidden');
        video.classList.add('hidden');

        if (videoStream) {
            videoStream.getTracks().forEach(track => track.stop());
            videoStream = null;
        }
    }
    reader.readAsDataURL(event.target.files[0]);
}

setTimeout(function() {
    let successAlert = document.getElementById('alert-success');
    let errorAlert = document.getElementById('alert-error');

    if (successAlert) {
        successAlert.style.transition = "opacity 0.5s";
        successAlert.style.opacity = "0";
        setTimeout(() => successAlert.remove(), 500); // Hapus elemen setelah animasi
    }

    if (errorAlert) {
        errorAlert.style.transition = "opacity 0.5s";
        errorAlert.style.opacity = "0";
        setTimeout(() => errorAlert.remove(), 500);
    }
}, 5000); // Hilang setelah 5 detik
</script>


@endsection
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pendaftaran Anggota - Perpustakaan Poliwangi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a2e0e6f91e.js" crossorigin="anonymous"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-4xl bg-white p-8 rounded-2xl shadow-lg">
        <!-- Header -->
        <div class="flex flex-col items-center mb-6">
            <img src="/img/logo.png" alt="Poliwangi Logo" class="w-20 mb-2" />
            <h2 class="text-2xl font-bold text-blue-700 text-center">Formulir Pendaftaran Anggota</h2>
            <p class="text-sm text-gray-600 text-center">Silakan isi data berikut untuk menjadi anggota perpustakaan</p>
        </div>

        <!-- Alert Flash Message -->
        @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            {{ session('error') }}
        </div>
        @endif


        <!-- Form -->
        <form action="{{ route('pendaftaran-anggota.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="text-gray-700 font-medium">Nama Anggota</label>
                    <input type="text" name="nama" value="{{ old('nama') }}"
                        class="border-2 border-blue-500 rounded-full p-3 w-full @error('nama') border-red-500 @enderror"
                        required />
                    @error('nama')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-gray-700 font-medium">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                        class="border-2 border-blue-500 rounded-full p-3 w-full @error('tanggal_lahir') border-red-500 @enderror"
                        required />
                    @error('tanggal_lahir')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-gray-700 font-medium">Anggota Sejak</label>
                    <input type="date" name="anggota_sejak" value="{{ old('anggota_sejak') }}"
                        class="border-2 border-blue-500 rounded-full p-3 w-full @error('anggota_sejak') border-red-500 @enderror"
                        required />
                    @error('anggota_sejak')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-gray-700 font-medium">Tanggal Registrasi</label>
                    <input type="date" name="tanggal_registrasi" value="{{ old('tanggal_registrasi') }}"
                        class="border-2 border-blue-500 rounded-full p-3 w-full @error('tanggal_registrasi') border-red-500 @enderror"
                        required />
                    @error('tanggal_registrasi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-gray-700 font-medium">Berlaku Hingga</label>
                    <input type="date" name="berlaku_hingga" value="{{ old('berlaku_hingga') }}"
                        class="border-2 border-blue-500 rounded-full p-3 w-full @error('berlaku_hingga') border-red-500 @enderror"
                        required />
                    <label class="inline-flex items-center mt-1">
                        <input type="checkbox" class="mr-2" />
                        <span class="text-gray-600">Set Otomatis</span>
                    </label>
                    @error('berlaku_hingga')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-gray-700 font-medium">Institusi</label>
                    <input type="text" name="institusi" value="{{ old('institusi') }}"
                        class="border-2 border-blue-500 rounded-full p-3 w-full @error('institusi') border-red-500 @enderror" />
                    @error('institusi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-gray-700 font-medium">Tipe Keanggotaan</label>
                    <input type="text" name="tipe_keanggotaan" value="{{ old('tipe_keanggotaan') }}"
                        class="border-2 border-blue-500 rounded-full p-3 w-full @error('tipe_keanggotaan') border-red-500 @enderror" />
                    @error('tipe_keanggotaan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-gray-700 font-medium">Jenis Kelamin</label>
                    <div class="flex gap-4 mt-2">
                        <label class="inline-flex items-center">
                            <input type="radio" name="jenis_kelamin" value="Laki-laki" class="mr-2"
                                {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }} />
                            Laki-laki
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="jenis_kelamin" value="Perempuan" class="mr-2"
                                {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }} />
                            Perempuan
                        </label>
                    </div>
                    @error('jenis_kelamin')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-gray-700 font-medium">Nomor Identitas</label>
                    <input type="text" name="nomor_identitas" value="{{ old('nomor_identitas') }}"
                        class="border-2 border-blue-500 rounded-full p-3 w-full @error('nomor_identitas') border-red-500 @enderror" />
                    @error('nomor_identitas')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-gray-700 font-medium">Tunda Keanggotaan</label>
                    <select name="tunda_keanggotaan" class="border-2 border-blue-500 rounded-full p-3 w-full">
                        <option value="1" {{ old('tunda_keanggotaan') == '1' ? 'selected' : '' }}>Ya</option>
                        <option value="0" {{ old('tunda_keanggotaan', '0') == '0' ? 'selected' : '' }}>Tidak</option>
                    </select>
                </div>

                <div class="bg-white p-4 border rounded-lg md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kolom Foto -->
                    <div class="flex flex-col items-center">
                        <label class="text-gray-700 font-medium mb-2">Foto</label>
                        <div
                            class="w-24 h-24 rounded-full bg-gray-200 border flex items-center justify-center relative overflow-hidden mb-3">
                            <img id="previewFoto" class="w-full h-full rounded-full hidden absolute object-cover" />
                            <i class="fas fa-user text-gray-400 text-4xl" id="defaultIcon"></i>
                        </div>
                        <input type="file" id="uploadFoto" name="foto" accept="image/png, image/jpeg" class="hidden"
                            onchange="previewImage(event)" />
                        <label for="uploadFoto"
                            class="bg-gray-600 text-white px-4 py-2 rounded-full text-sm cursor-pointer text-center">
                            Pilih Foto
                        </label>
                        @error('foto')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kolom Email -->
                    <div class="flex flex-col justify-center">
                        <label class="text-gray-700 font-medium mb-2">Surel</label>
                        <input type="email" name="surel" value="{{ old('surel') }}"
                            class="border-2 border-blue-500 rounded-full p-3 w-full @error('surel') border-red-500 @enderror" />
                        @error('surel')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="text-gray-700 font-medium">Program Studi</label>
                    <select name="program_studi_id" class="border-2 border-blue-500 rounded-full p-3 w-full" required>
                        <option value="">-- Pilih Program Studi --</option>
                        @foreach ($programStudiList as $program)
                        <option value="{{ $program->id }}"
                            {{ old('program_studi_id') == $program->id ? 'selected' : '' }}>{{ $program->nama_prodi }}
                        </option>
                        @endforeach
                    </select>
                    @error('program_studi_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-gray-700 font-medium">Catatan</label>
                    <textarea name="catatan" class="border-2 border-blue-500 rounded-xl p-3 w-full"
                        rows="3">{{ old('catatan') }}</textarea>
                </div>

                <div>
                    <label class="text-gray-700 font-medium">Kata Sandi</label>
                    <input type="password" name="katasandi"
                        class="border-2 border-blue-500 rounded-full p-3 w-full @error('katasandi') border-red-500 @enderror" />
                    @error('katasandi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-gray-700 font-medium">Konfirmasi Kata Sandi</label>
                    <input type="password" name="katasandi_confirmation"
                        class="border-2 border-blue-500 rounded-full p-3 w-full" />
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button type="reset" class="bg-blue-100 text-blue-600 px-5 py-2 rounded-full font-medium">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-full font-medium">Simpan</button>
            </div>
        </form>
    </div>

    <script>
    function previewImage(event) {
        const input = event.target;
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById("previewFoto");
            const icon = document.getElementById("defaultIcon");
            preview.src = reader.result;
            preview.classList.remove("hidden");
            icon.classList.add("hidden");
        };
        reader.readAsDataURL(input.files[0]);
    }
    </script>

    <script>
    // Auto-hide alert after 5 seconds
    setTimeout(() => {
        const alerts = document.querySelectorAll('[class*="bg-green-"], [class*="bg-red-"]');
        alerts.forEach(alert => alert.remove());
    }, 5000);
    </script>

</body>

</html>

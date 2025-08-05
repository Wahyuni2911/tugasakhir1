@extends('app')

@section('title', 'Kelola Anggota')

@section('content')

<!-- Breadcrumb -->
<div class="text-sm text-gray-500 text-right">
    <a href="/dashboard" class="hover:underline">Dashboard</a> >
    <span class="text-gray-800 font-semibold">Kelola Anggota</span>
</div>

<!-- Container -->
<div class="bg-white p-6 rounded-lg mt-6 shadow-md border border-gray-300">
    <h2 class="text-lg font-bold">Data Kelola Anggota</h2>

    <!-- Pencarian + Tombol Tambah -->
    <div class="flex justify-between items-center mt-4">
        <form method="GET" action="{{ route('kelola-anggota') }}" class="w-1/2">
            <input type="text" name="query" value="{{ request('query') }}" placeholder="Pencarian..."
                class="border p-2 rounded w-full">
        </form>

        <button onclick="document.getElementById('modalPendaftaran').classList.remove('hidden')"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition ml-4">
            + Tambah Anggota
        </button>

    </div>


    <!-- Tabel Data Anggota -->
    <div class="overflow-x-auto mt-4">
        <table class="min-w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">No</th>
                    <th class="border p-2">NIM</th>
                    <th class="border p-2">Nama Anggota</th>
                    <th class="border p-2">Tipe</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($anggota as $index => $member)
                <tr>
                    <td class="border p-2 text-center">{{ $index + 1 }}</td>
                    <td class="border p-2">{{ $member['nomor_identitas'] }}</td>
                    <td class="border p-2">
                        <span class="font-semibold">{{ $member['nama'] }}</span><br>
                        <span class="text-gray-500 text-sm">{{ $member['nomor_identitas'] }}</span>
                    </td>
                    <td class="border p-2">{{ $member['tipe_keanggotaan'] }}</td>
                    <td class="border p-2 text-center">
                        <a href="{{ route('kelola-anggota.edit', $member->id) }}" class="text-yellow-500">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('kelola-anggota.destroy', $member->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 ml-2"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<!-- Modal Pendaftaran Anggota -->
<div id="modalPendaftaran" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white w-full max-w-5xl p-6 rounded-lg relative overflow-y-auto max-h-[90vh] border border-gray-300">
        <!-- Tombol close -->
        <button onclick="document.getElementById('modalPendaftaran').classList.add('hidden')"
            class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl">&times;</button>

        <h2 class="text-xl font-bold mb-4">Pendaftaran Anggota</h2>

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
                    <input type="text" name="nomor_identitas" class="border p-2 rounded w-full"
                        value="{{ old('nomor_identitas') }}">
                </div>
                <div>
                    <label class="text-gray-700 font-semibold">Tunda Keanggotaan</label>
                    <select name="tunda_keanggotaan" class="border p-2 rounded w-full">
                        <option value="1">Ya</option>
                        <option value="0" selected>Tidak</option>
                    </select>
                </div>

                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white p-6 rounded-lg border border-gray-300 w-full">
                        <label class="text-gray-700 font-semibold block mb-3">Foto</label>
                        <div class="flex flex-col items-center">
                            <div
                                class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center border mb-3 relative overflow-hidden">
                                <img id="previewFoto" src="#" class="w-full h-full rounded-full hidden absolute"
                                    alt="Foto Profil">
                                <video id="video" class="w-full h-full rounded-full hidden absolute"></video>
                                <i class="fas fa-user text-gray-500 text-5xl" id="defaultIcon"></i>
                            </div>

                            <input type="file" class="hidden" id="uploadFoto" name="foto" accept="image/png, image/jpeg"
                                onchange="previewImage(event)">
                            <label for="uploadFoto"
                                class="bg-gray-500 text-white px-4 py-2 rounded cursor-pointer text-center w-full">
                                Pilih Foto
                            </label>
                        </div>
                    </div>

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
                <button type="button" onclick="document.getElementById('modalPendaftaran').classList.add('hidden')"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>


<script>
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
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>

@endsection
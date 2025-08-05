@extends('app')

@section('title', 'Edit Anggota')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md border border-gray-300">
    <div class="text-sm text-gray-500 mb-4 text-right">
        <span class="text-gray-800 font-semibold">Edit Anggota</span>
    </div>

    <h2 class="text-lg font-bold mb-4">Edit Anggota</h2>

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

    <!-- Form Edit -->
    <form action="{{ route('kelola-anggota.update', $anggota->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="text-gray-700 font-semibold">Nama Anggota</label>
                <input type="text" name="nama" value="{{ $anggota->nama }}" class="border p-2 rounded w-full">
            </div>
            <div>
                <label class="text-gray-700 font-semibold">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ $anggota->tanggal_lahir }}"
                    class="border p-2 rounded w-full">
            </div>
            <div>
                <label class="text-gray-700 font-semibold">Anggota Sejak</label>
                <input type="date" name="anggota_sejak" value="{{ $anggota->anggota_sejak }}"
                    class="border p-2 rounded w-full">
            </div>
            <div>
                <label class="text-gray-700 font-semibold">Tanggal Registrasi</label>
                <input type="date" name="tanggal_registrasi" value="{{ $anggota->tanggal_registrasi }}"
                    class="border p-2 rounded w-full">
            </div>
            <div>
                <label class="text-gray-700 font-semibold">Berlaku Hingga</label>
                <input type="date" name="berlaku_hingga" value="{{ $anggota->berlaku_hingga }}"
                    class="border p-2 rounded w-full">
            </div>
            <div>
                <label class="text-gray-700 font-semibold">Institusi</label>
                <input type="text" name="institusi" value="{{ $anggota->institusi }}" class="border p-2 rounded w-full">
            </div>
            <div>
                <label class="text-gray-700 font-semibold">Tipe Keanggotaan</label>
                <input type="text" name="tipe_keanggotaan" value="{{ $anggota->tipe_keanggotaan }}"
                    class="border p-2 rounded w-full">
            </div>
            <div>
                <label class="text-gray-700 font-semibold">Jenis Kelamin</label>
                <div class="flex space-x-4">
                    <label><input type="radio" name="jenis_kelamin" value="Laki-laki"
                            {{ $anggota->jenis_kelamin == 'Laki-laki' ? 'checked' : '' }}> Laki-laki</label>
                    <label><input type="radio" name="jenis_kelamin" value="Perempuan"
                            {{ $anggota->jenis_kelamin == 'Perempuan' ? 'checked' : '' }}> Perempuan</label>
                </div>
            </div>
            <div>
                <label class="text-gray-700 font-semibold">Nomor Identitas</label>
                <input type="text" name="nomor_identitas" value="{{ $anggota->nomor_identitas }}"
                    class="border p-2 rounded w-full">
            </div>
            <div>
                <label class="text-gray-700 font-semibold">Tunda Keanggotaan</label>
                <select name="tunda_keanggotaan" class="border p-2 rounded w-full">
                    <option value="1" {{ $anggota->tunda_keanggotaan ? 'selected' : '' }}>Ya</option>
                    <option value="0" {{ !$anggota->tunda_keanggotaan ? 'selected' : '' }}>Tidak</option>
                </select>
            </div>

            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Kolom Foto -->
                <div class="bg-white p-6 rounded-lg border border-gray-300 w-full">
                    <label class="text-gray-700 font-semibold block mb-3">Foto</label>
                    <div class="flex flex-col items-center">
                        <div
                            class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center border mb-3 relative overflow-hidden">
                            <img id="previewFoto" src="{{ asset('storage/'.$anggota->foto) }}"
                                class="w-full h-full rounded-full" alt="Foto Profil">
                        </div>
                        <input type="file" class="hidden" id="uploadFoto" name="foto" accept="image/png, image/jpeg">
                        <label for="uploadFoto"
                            class="bg-gray-500 text-white px-4 py-2 rounded cursor-pointer text-center w-full">
                            Pilih Foto
                        </label>
                    </div>
                </div>

                <!-- Kolom Surel -->
                <div class="bg-white p-6 rounded-lg border border-gray-300 flex flex-col w-full">
                    <label class="text-gray-700 font-semibold block mb-3">Surel</label>
                    <input type="email" name="surel" value="{{ $anggota->surel }}" class="border p-3 rounded w-full">
                </div>
            </div>

            <div>
                <label class="text-gray-700 font-semibold">Program Studi</label>
                <select name="program_studi_id" class="border p-2 rounded w-full">
                    <option value="">-- Pilih Program Studi --</option>
                    @foreach ($programStudiList as $program)
                    <option value="{{ $program->id }}"
                        {{ $anggota->program_studi_id == $program->id ? 'selected' : '' }}>
                        {{ $program->nama_prodi }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-gray-700 font-semibold">Catatan</label>
                <textarea name="catatan" class="border p-2 rounded w-full" rows="3">{{ $anggota->catatan }}</textarea>
            </div>
        </div>

        <div class="flex justify-end space-x-3 mt-6">
            <a href="{{ route('kelola-anggota') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Batal</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
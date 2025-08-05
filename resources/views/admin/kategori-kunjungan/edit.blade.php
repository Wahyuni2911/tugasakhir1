@extends('app')

@section('title', 'Edit Kategori Kunjungan')

@section('content')

<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md border border-gray-300 mt-6">
    <h2 class="text-xl font-bold mb-4">Edit Kategori Kunjungan</h2>

    <form action="{{ route('kategori-kunjungan.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nama_kategori" class="block text-gray-700 mb-2">Nama Kategori</label>
            <input type="text" id="nama_kategori" name="nama_kategori" required
                class="w-full border rounded px-3 py-2 @error('nama_kategori') border-red-500 @enderror"
                value="{{ old('nama_kategori', $kategori->nama_kategori) }}">
            @error('nama_kategori')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('kategori-kunjungan.index') }}"
                class="px-4 py-2 border rounded text-gray-600 hover:bg-gray-100">
                Batal
            </a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Simpan
                Perubahan</button>
        </div>
    </form>
</div>

@endsection
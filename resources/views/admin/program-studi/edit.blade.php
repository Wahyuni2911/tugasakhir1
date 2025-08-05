@extends('app')

@section('title', 'Edit Program Studi')

@section('content')

<!-- Breadcrumb -->
<div class="text-sm text-gray-500 text-right">
    <a href="/dashboard" class="hover:underline">Dashboard</a> >
    <a href="{{ route('program-studi.index') }}" class="hover:underline">Kelola Program Studi</a> >
    <span class="text-gray-800 font-semibold">Edit Program Studi</span>
</div>

<!-- Container -->
<div class="bg-white p-6 rounded-lg mt-6 shadow-md border border-gray-300 max-w-xl mx-auto">
    <h2 class="text-lg font-bold mb-4">Edit Program Studi</h2>

    <form method="POST" action="{{ route('program-studi.update', $programStudi->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700">Nama Prodi</label>
            <input type="text" name="nama_prodi" value="{{ old('nama_prodi', $programStudi->nama_prodi) }}"
                class="w-full border px-3 py-2 rounded mt-1 @error('nama_prodi') border-red-500 @enderror" required>
            @error('nama_prodi')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Kode Prodi</label>
            <input type="text" name="kode_prodi" value="{{ old('kode_prodi', $programStudi->kode_prodi) }}"
                class="w-full border px-3 py-2 rounded mt-1 @error('kode_prodi') border-red-500 @enderror" required>
            @error('kode_prodi')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('program-studi.index') }}"
                class="px-4 py-2 mr-2 border rounded text-gray-600 hover:bg-gray-100">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Simpan
                Perubahan</button>
        </div>
    </form>
</div>

@endsection

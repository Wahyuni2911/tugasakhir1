@extends('app')

@section('title', 'Kelola Kategori Kunjungan')

@section('content')

<!-- Breadcrumb -->
<div class="text-sm text-gray-500 text-right mb-4">
    <a href="/dashboard" class="hover:underline">Dashboard</a> >
    <span class="text-gray-800 font-semibold">Kelola Kategori Kunjungan</span>
</div>

<!-- Container -->
<div class="bg-white p-6 rounded-lg shadow-md border border-gray-300">
    <h2 class="text-lg font-bold mb-4">Data Kategori Kunjungan</h2>

    <!-- Pencarian + Tambah -->
    <div class="flex justify-between items-center mt-4">
        <form method="GET" action="{{ route('kategori-kunjungan.index') }}" class="w-1/2">
            <input type="text" name="query" value="{{ request('query') }}" placeholder="Cari Kategori..."
                class="border p-2 rounded w-full">
        </form>

        <button onclick="toggleModal(true)"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition ml-4">
            + Tambah Kategori
        </button>
    </div>

    <!-- Tabel -->
    <div class="overflow-x-auto mt-4">
        <table class="min-w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">No</th>
                    <th class="border p-2">Nama Kategori</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategori as $index => $item)
                <tr>
                    <td class="border p-2 text-center">{{ $kategori->firstItem() + $index }}</td>
                    <td class="border p-2">{{ $item->nama_kategori }}</td>
                    <td class="border p-2 text-center">
                        <a href="{{ route('kategori-kunjungan.edit', $item->id) }}" class="text-yellow-500 mr-2">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('kategori-kunjungan.destroy', $item->id) }}" method="POST"
                            class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500" onclick="return confirm('Hapus kategori ini?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

                @if($kategori->isEmpty())
                <tr>
                    <td colspan="3" class="border p-2 text-center text-gray-500">Data kategori tidak ditemukan.</td>
                </tr>
                @endif
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $kategori->withQueryString()->links() }}
        </div>
    </div>
</div>


<!-- Modal Tambah Kategori -->
<div id="modalForm" class="fixed inset-0 z-50 hidden bg-black bg-opacity-30 flex items-center justify-center">
    <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6 relative">
        <h3 class="text-lg font-bold mb-4">Tambah Kategori Kunjungan</h3>

        <form action="{{ route('kategori-kunjungan.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Nama Kategori</label>
                <input type="text" name="nama_kategori" required
                    class="w-full border rounded px-3 py-2 mt-1 @error('nama_kategori') border-red-500 @enderror"
                    value="{{ old('nama_kategori') }}">
                @error('nama_kategori')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="toggleModal(false)"
                    class="px-4 py-2 border rounded text-gray-600 hover:bg-gray-100">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>

        <button onclick="toggleModal(false)" class="absolute top-2 right-3 text-gray-500 hover:text-red-500 text-xl">
            &times;
        </button>
    </div>
</div>

<script>
    function toggleModal(show) {
        const modal = document.getElementById('modalForm');
        modal.classList.toggle('hidden', !show);
    }
</script>

@endsection
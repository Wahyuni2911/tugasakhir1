@extends('app')

@section('title', 'Setting Card')
@section('pages', 'Setting Kartu Anggota Digital')

@section('content')

<!-- Breadcrumb -->
<div class="flex justify-end text-sm text-gray-500">
    <a href="/dashboard" class="hover:underline">Dashboard</a> >
    <span class="text-gray-800 font-semibold">Setting Card</span>
</div>

<!-- Container -->
<div x-data="{ openModal: false }" class="bg-white p-6 rounded-lg mt-6 shadow-lg border border-gray-300">

    <!-- Flash message -->
    @if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-md border border-green-300">
        {{ session('success') }}
    </div>
    @endif

    <h2 class="text-lg font-bold mb-4">Pengaturan Kartu Anggota</h2>

    <!-- Tombol Tambah -->
    <div class="mb-4">
        <button id="openModalBtn" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">
            + Tambah Kartu Anggota
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Form Pilih Anggota -->
        <form method="GET" action="{{ route('setting-card') }}">
            <select id="selectAnggota" name="anggota_id"
                class="border p-3 rounded-xl w-full focus:ring focus:ring-blue-400 shadow-md text-gray-900 bg-white"
                onchange="this.form.submit()">
                <option value="">-- Pilih Anggota --</option>
                @foreach($anggota as $data)
                <option value="{{ $data->id }}" {{ request('anggota_id') == $data->id ? 'selected' : '' }}>
                    {{ $data->nama }}
                </option>
                @endforeach
            </select>
        </form>

        <!-- Preview Kartu -->
        @if(request('anggota_id'))
        @php
        $selectedAnggota = $anggota->firstWhere('id', request('anggota_id'));
        @endphp
        <div class="bg-gray-100 p-6 rounded-lg shadow-lg border border-gray-300">
            <h3 class="text-center text-gray-700 font-semibold mb-3">Pratinjau Kartu Anggota</h3>
            <div class="text-white p-4 rounded-lg relative">
                <div
                    class="bg-gradient-to-r from-blue-600 to-blue-500 text-white p-5 rounded-t-2xl flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold tracking-wide">PERPUSTAKAAN</h3>
                        <p class="text-sm opacity-90">POLITEKNIK NEGERI BANYUWANGI</p>
                    </div>
                    <img src="{{ asset('/img/logo.png') }}" alt="Logo" class="w-14 h-14">
                </div>

                <div class="p-6 bg-white rounded-b-2xl">
                    <div class="flex items-center space-x-5">
                        <div
                            class="w-24 h-24 bg-gray-200 rounded-full overflow-hidden border-4 border-gray-300 shadow-lg">
                            <img id="previewImage"
                                src="{{ $selectedAnggota->foto ? asset('storage/' . $selectedAnggota->foto) : asset('default-avatar.png') }}"
                                class="w-full h-full object-cover">
                        </div>

                        <div class="text-gray-900">
                            <p class="text-gray-500 text-sm">Nama</p>
                            <h4 class="text-lg font-semibold">{{ $selectedAnggota->nama ?? '-' }}</h4>

                            <p class="text-gray-500 text-sm mt-2">NIM</p>
                            <p class="text-lg font-semibold">
                                {{ $selectedAnggota->nomor_identitas ?? '-' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center mt-6">
                        <div class="w-20 h-20 p-1"></div>
                        <div class="ml-9 text-gray-900">
                            <p class="text-gray-500 text-sm">Prodi</p>
                            <p class="text-lg font-semibold">
                                {{ $selectedAnggota->programStudi->nama_prodi ?? '-' }}
                            </p>
                            <p class="text-gray-500 text-sm">Berlaku s.d</p>
                            <p class="text-lg font-bold">
                                {{ \Carbon\Carbon::parse($selectedAnggota->berlaku_hingga)->format('d M Y') ?? '-' }}
                            </p>
                        </div>
                    </div>

                    <!-- Barcode -->
                    @if (!empty($selectedAnggota->nomor_identitas))
                    <div class="mt-6 flex justify-center">
                        <div class="text-center">
                            {!! DNS1D::getBarcodeHTML($selectedAnggota->nomor_identitas, 'C128', 1.5, 30) !!}
                            <div class="text-sm text-gray-700 tracking-wider font-semibold mt-2">
                                {{ $selectedAnggota->nomor_identitas }}
                            </div>
                        </div>
                    </div>
                    @else
                    <p class="text-red-500 text-sm mt-2">Barcode tidak tersedia</p>
                    @endif

                    <div class="absolute bottom-3 right-5 text-xs text-black">Digital Member Card</div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Modal Tambah Kartu -->
    <div id="modalOverlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-lg p-6 space-y-4 relative">
            <button id="closeModalBtn"
                class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-xl">&times;</button>

            <h3 class="text-lg font-bold text-gray-800">Tambah Kartu Anggota Digital</h3>

            <form action="{{ route('setting-card.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="anggota_id" class="block text-sm font-medium">Anggota</label>
                    <select name="anggota_id" id="anggota_id" required
                        class="w-full mt-1 rounded-md border-gray-300 shadow-sm p-2">
                        <option value="">-- Pilih Anggota --</option>
                        @foreach($anggotaBelumPunyaKartu as $data)
                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="nim" class="block text-sm font-medium">NIM</label>
                    <input type="text" name="nim" id="nim" required
                        class="w-full mt-1 rounded-md border-gray-300 shadow-sm p-2">
                </div>


                <div>
                    <label for="masa_berlaku" class="block text-sm font-medium">Masa Berlaku</label>
                    <input type="date" name="masa_berlaku" id="masa_berlaku" required
                        class="w-full mt-1 rounded-md border-gray-300 shadow-sm p-2">
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" id="cancelModalBtn"
                        class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                        Batal
                    </button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const selectElement = document.getElementById('selectAnggota');
    if (selectElement) {
        selectElement.selectedIndex = 0;
    }
});


document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById('modalOverlay');
    const openBtn = document.getElementById('openModalBtn');
    const closeBtn = document.getElementById('closeModalBtn');
    const cancelBtn = document.getElementById('cancelModalBtn');

    openBtn.addEventListener('click', function() {
        modal.classList.remove('hidden');
    });

    closeBtn.addEventListener('click', function() {
        modal.classList.add('hidden');
    });

    cancelBtn.addEventListener('click', function() {
        modal.classList.add('hidden');
    });

    // Optional: klik luar modal tutup
    window.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });
});
</script>

@endsection
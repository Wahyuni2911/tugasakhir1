@extends('app-pemustaka')

@section('title', 'Riwayat Kunjungan')

@section('content')
<section class="riwayat-kunjungan">
    <h2 class="judul">
        <i class="fa-solid fa-calendar-check"></i> Riwayat Kunjungan
    </h2>

    @if(session('success'))
    <div id="flash-success" class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4 border border-green-300">
        {{ session('success') }}
    </div>
    @endif

    <div class="table-responsive">
        <table class="tabel-kunjungan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Anggota</th>
                    <th>Nama</th>
                    <th>Institusi</th>
                    <th>Waktu Kunjungan</th>
                    <th>Keperluan</th>
                    <th>Koordinat</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kunjungans as $kunjungan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kunjungan->kartuAnggota->anggota->nomor_identitas ?? '-' }}</td>
                    <td>{{ $kunjungan->kartuAnggota->anggota->nama ?? '-' }}</td>
                    <td>{{ $kunjungan->kartuAnggota->anggota->institusi ?? '-' }}</td>
                    <td>{{ $kunjungan->waktu_kunjungan }}</td>
                    <td>{{ $kunjungan->kategoriKunjungan->nama_kategori ?? '-' }}</td>
                    <td>{{ $kunjungan->latitude }}, {{ $kunjungan->longitude }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-gray-500">Belum ada riwayat kunjungan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination mt-6 flex justify-center gap-2 items-center">
        {{-- Tombol Previous --}}
        @if ($kunjungans->onFirstPage())
        <span class="px-3 py-1 bg-gray-200 text-gray-500 rounded cursor-not-allowed">Prev</span>
        @else
        <a href="{{ $kunjungans->previousPageUrl() }}"
            class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Prev</a>
        @endif

        {{-- Nomor Halaman --}}
        @for ($i = 1; $i <= $kunjungans->lastPage(); $i++)
            @if ($i == $kunjungans->currentPage())
            <span class="px-3 py-1 bg-blue-600 text-white rounded font-bold">{{ $i }}</span>
            @else
            <a href="{{ $kunjungans->url($i) }}"
                class="px-3 py-1 bg-gray-100 text-gray-700 rounded hover:bg-gray-200">{{ $i }}</a>
            @endif
            @endfor

            {{-- Tombol Next --}}
            @if ($kunjungans->hasMorePages())
            <a href="{{ $kunjungans->nextPageUrl() }}"
                class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Next</a>
            @else
            <span class="px-3 py-1 bg-gray-200 text-gray-500 rounded cursor-not-allowed">Next</span>
            @endif
    </div>

</section>

<style>
.table-responsive {
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    border-radius: 6px;
}

.tabel-kunjungan {
    width: 100%;
    min-width: 700px;
    /* penting agar scroll aktif saat layar kecil */
    border-collapse: collapse;
    font-size: 14px;
}

.riwayat-kunjungan {
    max-width: 100%;
    padding: 20px;
    margin: auto;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.judul {
    font-size: 20px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
    color: #333;
}

.table-header {
    display: flex;
    justify-content: flex-end;
    margin-bottom: 10px;
}

.tambah-btn {
    white-space: nowrap;
    padding: 8px 16px;
    font-size: 14px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border-radius: 5px;
    text-decoration: none;
    color: #fff;
    background-color: #007bff;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.tambah-btn:hover {
    background-color: #0056b3;
}

.tabel-kunjungan {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    font-size: 14px;
}

.tabel-kunjungan thead {
    background-color: #f0f0f0;
    color: #333;
}

.tabel-kunjungan th,
.tabel-kunjungan td {
    padding: 10px 12px;
    border: 1px solid #ccc;
    text-align: left;
    white-space: nowrap;
}

.pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
    flex-wrap: wrap;
}

.pagination a,
.pagination span {
    margin: 0 4px;
    padding: 6px 12px;
    border-radius: 4px;
    font-size: 14px;
    text-decoration: none;
    border: 1px solid #ccc;
    color: #333;
}

.pagination a:hover {
    background-color: #e0e0e0;
}

.pagination .active {
    background-color: #007bff;
    color: white;
    font-weight: bold;
    border-color: #007bff;
}


@media (max-width: 600px) {
    .tabel-kunjungan {
        font-size: 13px;
    }

    .judul {
        font-size: 18px;
        flex-wrap: wrap;
    }

    .table-header {
        justify-content: center;
    }

    .tambah-btn {
        width: 100%;
        justify-content: center;
        font-size: 16px;
        padding: 12px 0;
    }
}
</style>

<script>
function openModal() {
    const modal = document.getElementById('modalKunjungan');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeModal() {
    const modal = document.getElementById('modalKunjungan');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
}

// Tutup modal jika klik di luar kontennya
window.addEventListener('click', function(e) {
    const modal = document.getElementById('modalKunjungan');
    const modalContent = modal.querySelector('.bg-white');

    if (e.target === modal) {
        closeModal();
    }
});

// Sembunyikan flash success setelah 5 detik
setTimeout(() => {
    const flash = document.getElementById('flash-success');
    if (flash) {
        flash.style.opacity = '0';
        flash.style.transition = 'opacity 0.3s ease';
        setTimeout(() => flash.style.display = 'none', 300);
    }
}, 5000);
</script>

@endsection
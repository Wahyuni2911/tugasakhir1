@extends('app')

@section('title', 'Laporan Kunjungan')
@section('content')
<section class="laporan-kunjungan">
    <h2 class="judul">
        <i class="fa-solid fa-chart-line"></i> Laporan Kunjungan
    </h2>

    <form method="GET" class="filter-form">
        <div class="filter-grid">
            {{-- Jenis Kunjungan --}}
            <div class="filter-item">
                <label for="kategori_kunjungan_id">Jenis Kunjungan</label>
                <select name="kategori_kunjungan_id" id="kategori_kunjungan_id">
                    <option value="">Semua</option>
                    @foreach ($kategoriKunjungan as $kategori)
                    <option value="{{ $kategori->id }}"
                        {{ request('kategori_kunjungan_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- Tanggal --}}
            <div class="filter-item">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ request('tanggal') }}">
            </div>

            {{-- Jenis Layanan --}}
            <div class="filter-item">
                <label for="jenis_layanan">Online / Offline</label>
                <select name="jenis_layanan" id="jenis_layanan">
                    <option value="">Semua</option>
                    @foreach ($jenisLayanan as $layanan)
                    <option value="{{ strtolower($layanan) }}"
                        {{ request('jenis_layanan') == strtolower($layanan) ? 'selected' : '' }}>
                        {{ $layanan }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- Jenis Keanggotaan --}}
            <div class="filter-item">
                <label for="jenis_anggota">Jenis Keanggotaan</label>
                <select name="jenis_anggota" id="jenis_anggota">
                    <option value="">Semua</option>
                    <option value="Mahasiswa" {{ request('jenis_anggota') == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa
                    </option>
                    <option value="Dosen" {{ request('jenis_anggota') == 'Dosen' ? 'selected' : '' }}>Dosen</option>
                    <option value="Umum" {{ request('jenis_anggota') == 'Umum' ? 'selected' : '' }}>Umum</option>
                </select>
            </div>
        </div>

        <div style="margin-top: 15px;">
            <button type="submit" class="filter-btn">
                <i class="fa-solid fa-filter"></i> Filter
            </button>
        </div>
    </form>

    <div class="table-responsive" style="margin-top: 25px;">
        <table class="tabel-kunjungan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenis Keanggotaan</th>
                    <th>Prodi</th>
                    <th>Kategori Kunjungan</th>
                    <th>Online/Offline</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laporans as $laporan)
                <tr>
                    <td>{{ $loop->iteration + ($laporans->currentPage() - 1) * $laporans->perPage() }}</td>
                    <td>{{ $laporan->kunjungan->kartuAnggota->anggota->nama ?? '-' }}</td>
                    <td>{{ $laporan->jenis_keanggotaan ?? ($laporan->kunjungan->kartuAnggota->anggota->jenis_keanggotaan ?? '-') }}
                    </td>
                    <td>{{ $laporan->kunjungan->kartuAnggota->anggota->programStudi->nama_prodi ?? '-' }}</td>
                    <td>{{ $laporan->kunjungan->kategoriKunjungan->nama_kategori ?? '-' }}</td>
                    <td>{{ $laporan->online_offline ?? '-' }}</td>
                    <td>{{ $laporan->kunjungan->waktu_kunjungan ? \Carbon\Carbon::parse($laporan->kunjungan->waktu_kunjungan)->format('Y-m-d H:i') : '-' }}
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="7">Tidak ada data ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 15px;">
            {{ $laporans->withQueryString()->links() }}
        </div>
    </div>
</section>

<style>
.laporan-kunjungan {
    max-width: 100%;
    padding: 20px;
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

.filter-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 15px;
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 8px;
    background-color: #f9fbff;
}

.filter-item {
    display: flex;
    flex-direction: column;
    font-size: 14px;
}

.filter-item label {
    margin-bottom: 6px;
    color: #333;
    font-weight: 500;
}

.filter-item select,
.filter-item input[type="date"] {
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 14px;
}

.table-responsive {
    overflow-x: auto;
}

.tabel-kunjungan {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

.tabel-kunjungan thead {
    background-color: #f0f0f0;
}

.tabel-kunjungan th,
.tabel-kunjungan td {
    padding: 10px;
    border: 1px solid #ccc;
    white-space: nowrap;
}

@media (max-width: 600px) {
    .judul {
        font-size: 18px;
        flex-wrap: wrap;
    }

    .filter-group {
        flex-direction: column;
        align-items: stretch;
    }

    .filter-group select,
    .filter-btn {
        width: 100%;
    }
}
</style>
@endsection

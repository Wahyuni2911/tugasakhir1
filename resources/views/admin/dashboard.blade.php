@extends('app')

@section('pages', 'Dashboard')

@section('content')

<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-5">
    @php
    $icons = ['green', 'blue', 'yellow', 'teal'];
    $stats = [
    ['label' => 'Kunjungan Hari Ini', 'value' => $kunjunganHariIni],
    ['label' => 'Kunjungan Bulan Ini', 'value' => $kunjunganBulanIni],
    ['label' => 'Jumlah Mahasiswa', 'value' => $jumlahMahasiswa],
    ['label' => 'Jumlah Dosen', 'value' => $jumlahDosen],
    ];
    @endphp

    @foreach ($stats as $i => $stat)
    <div class="flex items-center justify-between bg-white border border-gray-300 p-4 rounded-lg shadow-md">
        <div>
            <p class="text-gray-600 text-sm">{{ $stat['label'] }}</p>
            <span class="text-{{ $icons[$i] }}-700 text-2xl font-bold">{{ $stat['value'] }}</span>
        </div>
        <i class="fas fa-user text-{{ $icons[$i] }}-700 text-2xl"></i>
    </div>
    @endforeach
</div>

<!-- Grafik Kunjungan (Tanpa JS) -->
<div class="bg-white p-6 rounded-lg mt-6 shadow-md border border-gray-300">
    <h2 class="text-lg font-bold mb-4">Grafik Kunjungan (Statik)</h2>

    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end mb-6">
        <div>
            <label for="tipe" class="block text-sm font-medium text-gray-700">Tipe Kunjungan</label>
            <select name="tipe" id="tipe" class="mt-1 block w-full border border-black/30 rounded-md shadow-sm">
                <option value="">Semua</option>
                <option value="Mahasiswa" {{ request('tipe') == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                <option value="Dosen" {{ request('tipe') == 'Dosen' ? 'selected' : '' }}>Dosen</option>
            </select>
        </div>

        <div>
            <label for="bulan" class="block text-sm font-medium text-gray-700">Bulan</label>
            <select name="bulan" id="bulan" class="mt-1 block w-full border border-black/30 rounded-md shadow-sm">
                @for ($m = 1; $m <= 12; $m++) <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                    {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                    </option>
                    @endfor
            </select>
        </div>

        <div>
            <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun</label>
            <select name="tahun" id="tahun" class="mt-1 block w-full border border-black/30 rounded-md shadow-sm">
                @for ($y = date('Y'); $y >= date('Y') - 5; $y--)
                <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 rounded-md hover:bg-blue-700 w-full"
                style="height: 27px;">
                Lihat Data
            </button>
        </div>

    </form>


    @if($dataKunjungan->isEmpty())
    <p class="text-gray-600">Tidak ada data kunjungan yang tersedia.</p>
    @else
    @php
    $maxJumlah = $dataKunjungan->max('jumlah');
    $chartHeight = 200;
    $chartWidth = 600;
    $padding = 30;
    $count = count($dataKunjungan);
    $stepX = $count > 1 ? ($chartWidth - 2 * $padding) / ($count - 1) : 0;
    @endphp

    <div class="overflow-auto">
        <svg width="{{ $chartWidth }}" height="{{ $chartHeight + $padding * 2 }}">
            <!-- Grid -->
            <line x1="0" y1="{{ $chartHeight + $padding }}" x2="{{ $chartWidth }}" y2="{{ $chartHeight + $padding }}"
                stroke="#ccc" />

            @php $points = []; @endphp

            @foreach($dataKunjungan as $i => $data)
            @php
            $x = $padding + $i * $stepX;
            $y = $chartHeight + $padding - ($data->jumlah / $maxJumlah) * $chartHeight;
            $points[] = "{$x},{$y}";
            @endphp
            <!-- Data point -->
            <circle cx="{{ $x }}" cy="{{ $y }}" r="3" fill="blue" />
            <text x="{{ $x }}" y="{{ $chartHeight + $padding + 15 }}" font-size="10" text-anchor="middle"
                class="fill-gray-700">
                {{ \Carbon\Carbon::parse($data->tanggal)->format('d') }}
            </text>
            @endforeach

            <!-- Line -->
            <polyline points="{{ implode(' ', $points) }}" fill="none" stroke="blue" stroke-width="2" />
        </svg>
    </div>

    <!-- Legend & Info -->
    <div class="text-sm text-gray-600 mt-2">
        <p><strong>Keterangan:</strong> Titik = jumlah kunjungan harian, garis = tren kunjungan</p>
    </div>
    @endif
</div>
@endsection

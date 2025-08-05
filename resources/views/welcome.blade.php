@extends('app')

@section('pages', 'Dashboard')

@section('content')

<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-5">
    <div class="flex items-center justify-between bg-white border border-gray-300 p-4 rounded-lg shadow-md">
        <div>
            <p class="text-gray-600 text-sm">Kunjungan Hari Ini</p>
            <span class="text-green-700 text-2xl font-bold">8</span>
        </div>
        <i class="fas fa-user text-green-700 text-2xl"></i>
    </div>

    <div class="flex items-center justify-between bg-white border border-gray-300 p-4 rounded-lg shadow-md">
        <div>
            <p class="text-gray-600 text-sm">Kunjungan Bulan Ini</p>
            <span class="text-blue-700 text-2xl font-bold">38</span>
        </div>
        <i class="fas fa-user text-blue-700 text-2xl"></i>
    </div>

    <div class="flex items-center justify-between bg-white border border-gray-300 p-4 rounded-lg shadow-md">
        <div>
            <p class="text-gray-600 text-sm">Jumlah Mahasiswa</p>
            <span class="text-yellow-700 text-2xl font-bold">7791</span>
        </div>
        <i class="fas fa-user text-yellow-700 text-2xl"></i>
    </div>

    <div class="flex items-center justify-between bg-white border border-gray-300 p-4 rounded-lg shadow-md">
        <div>
            <p class="text-gray-600 text-sm">Jumlah Dosen</p>
            <span class="text-teal-700 text-2xl font-bold">337</span>
        </div>
        <i class="fas fa-user text-teal-700 text-2xl"></i>
    </div>
</div>

<!-- Grafik Kunjungan -->
<div class="bg-white p-6 rounded-lg mt-6 shadow-md border border-gray-300">
    <h2 class="text-l font-bold">Grafik Kunjungan</h2>
    <canvas id="chart" class="max-w-full h-60 mt-4"></canvas>
</div>
@endsection
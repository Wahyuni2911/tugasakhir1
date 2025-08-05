@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center mt-4">
    <div class="card shadow-lg p-4"
        style="width: 450px; border-radius: 15px; background: linear-gradient(135deg, #667eea, #764ba2); color: white;">
        <div class="text-center">
            <h3 class="fw-bold">Kartu Perpustakaan</h3>
            <small class="text-light">Poliwangi Library Digital ID</small>
        </div>

        <div class="card-body text-center">
            <div class="d-flex align-items-center justify-content-center">
                <div class="me-3">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=ffffff&color=333333&size=100"
                        class="rounded-circle border border-3 border-white">
                </div>
                <div class="text-start">
                    <h5 class="fw-bold">{{ $user->name }}</h5>
                    <p class="mb-0"><i class="fas fa-envelope"></i> {{ $user->email }}</p>
                    <p class="mb-0"><i class="fas fa-id-badge"></i> {{ $user->libraryCard->barcode ?? 'N/A' }}</p>
                </div>
            </div>

            @if($user->libraryCard)
            <div class="mt-4">
                <h6>Scan QR Code ini di perpustakaan:</h6>
                <div class="d-flex justify-content-center">
                    <div class="bg-white p-3 rounded" style="display: inline-block;">
                        {!! $qrCode !!}
                    </div>
                </div>
                <p class="text-light mt-2"><i class="fas fa-id-card-alt"></i> RFID: {{ $user->libraryCard->rfid_code }}
                </p>
            </div>
            @else
            <p class="text-warning mt-4">Anda belum memiliki kartu perpustakaan</p>
            @endif

            <a href="{{ route('dashboard') }}" class="btn btn-light mt-3 w-100" style="border-radius: 50px;">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            @if($user->libraryCard)
            <a href="{{ route('library-card.print') }}" class="btn btn-success mt-3 w-100" style="border-radius: 50px;">
                <i class="fas fa-print"></i> Cetak Kartu
            </a>
            @endif

        </div>
    </div>
</div>
@endsection
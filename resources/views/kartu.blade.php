@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2>Kartu Perpustakaan Digital</h2>
    <p>Nama: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>

    <div>
        <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($user->id, 'C39') }}" alt="Barcode">
    </div>

    <a href="{{ route('anggota.index') }}" class="btn btn-primary mt-3">Kembali</a>
</div>
@endsection
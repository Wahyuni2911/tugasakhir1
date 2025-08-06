@extends('app-pemustaka')

@section('title', 'Profil Anggota')

@section('content')
    <div class="profil-container">
        <section class="profil-anggota">
            <div class="preview-kartu">
                <div class="kartu-digital-html">
                    <div class="kartu-header">
                        <div class="judul-kartu">
                            <h4>PERPUSTAKAAN POLITEKNIK NEGERI BANYUWANGI</h4>
                            <p>Kartu Anggota Digital</p>
                        </div>
                        <img src="/icons/icon-192x192.png" alt="Logo" class="logo-kanan">
                    </div>
                    <div class="kartu-body">
                        @php
                            $anggota = Auth::guard('anggota')->user();
                            $foto =
                                isset($anggota->foto) && is_string($anggota->foto) && $anggota->foto !== ''
                                    ? asset('storage/' . $anggota->foto)
                                    : asset('default-avatar.png');
                        @endphp

                        <img src="{{ $foto }}" class="foto-anggota" alt="Foto Anggota">

                        <div class="info-anggota">
                            <p><strong>Nama</strong><br>{{ Auth::guard('anggota')->user()?->nama ?? 'Guest' }}</p>
                            <p><strong>NIM</strong><br>{{ Auth::guard('anggota')->user()?->nomor_identitas ?? '-' }}</p>
                            <p><strong>Prodi</strong><br>TEKNOLOGI REKAYASA PERANGKAT LUNAK</p>
                            <p><strong>Berlaku s.d</strong><br>
                                {{ date('d M Y', strtotime(Auth::guard('anggota')->user()?->berlaku_hingga ?? now())) }}
                            </p>
                        </div>
                    </div>
                    <div class="kartu-barcode">
                        <div class="barcode-wrapper">
                            @php
                                $barcodeData = Auth::guard('anggota')->user()?->nomor_identitas;
                            @endphp

                            @if (!empty($barcodeData) && is_string($barcodeData))
                                {!! DNS1D::getBarcodeHTML($barcodeData, 'C128', 1, 30) !!}
                                <div class="barcode-text">{{ $barcodeData }}</div>
                            @else
                                <p style="color: red; font-size: 0.85rem;">Barcode tidak tersedia</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="kartu-actions">
                    <button class="btn-unduh" onclick="unduhKartu()">Unduh</button>
                    <button class="btn-cetak" onclick="bukaTabBaru()">Cetak</button>
                </div>
            </div>
        </section>
    </div>
    <!-- CSS -->
    <style>
        .profil-container {
            margin-top: 90px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: calc(100vh - 150px);
        }

        .kartu-digital-html {
            width: 520px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-family: 'Arial', sans-serif;
            background: white;
            margin: auto;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .kartu-header {
            background: #1c5aa6;
            color: white;
            padding: 10px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .judul-kartu h4 {
            font-size: 14px;
            margin: 0;
            font-weight: bold;
        }

        .judul-kartu p {
            font-size: 12px;
            margin: 0;
        }

        .logo-kanan {
            width: 40px;
            height: 40px;
        }

        .kartu-body {
            display: flex;
            padding: 15px;
            gap: 15px;
        }

        .foto-anggota {
            width: 90px;
            height: 110px;
            object-fit: cover;
            border-radius: 4px;
        }

        .info-anggota {
            font-size: 15px;
            line-height: 1.5;
            text-align: left;
            /* supaya rata kiri */
        }

        .info-anggota p {
            margin-bottom: 8px;
            /* spasi antar baris */
            font-size: 15px;
            /* ukuran huruf p */
        }

        .info-anggota strong {
            font-size: 16px;
            /* ukuran huruf strong */
        }

        .kartu-barcode {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }

        .kartu-barcode img {
            max-width: 80%;
            height: auto;
        }

        .barcode-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .barcode-text {
            font-size: 0.85rem;
            margin-top: 4px;
        }

        .kartu-actions {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .btn-unduh,
        .btn-cetak {
            padding: 10px 20px;
            border: none;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-unduh {
            background: #2e3e9e;
            color: white;
        }

        .btn-cetak {
            background: #ccc;
            color: #666;
        }

        @media (max-width: 600px) {
            .kartu-digital-html {
                width: 100%;
                max-width: 95%;
                font-size: 13px;
            }

            .kartu-header {
                padding: 8px 12px;
            }

            .judul-kartu h4 {
                font-size: 13px;
            }

            .judul-kartu p {
                font-size: 11px;
            }

            .logo-kanan {
                width: 32px;
                height: 32px;
            }

            .kartu-body {
                gap: 10px;
                padding: 12px;
            }

            .foto-anggota {
                width: 75px;
                height: 95px;
            }

            .info-anggota {
                font-size: 13px;
            }

            .info-anggota p {
                font-size: 13px;
                margin-bottom: 6px;
            }

            .info-anggota strong {
                font-size: 14px;
            }

            .barcode-text {
                font-size: 0.75rem;
            }

            .btn-unduh,
            .btn-cetak {
                padding: 8px 16px;
                font-size: 13px;
            }
        }
    </style>

    {{-- HTML2Canvas --}}
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

    <script>
        function unduhKartu() {
            const kartuElement = document.querySelector('.kartu-digital-html');

            html2canvas(kartuElement, {
                useCORS: true,
                scale: 2
            }).then(canvas => {
                const link = document.createElement('a');
                link.href = canvas.toDataURL("image/png");
                link.download = 'Kartu_Anggota_{{ Auth::guard('anggota')->user()?->id }}.png';
                link.click();
            });
        }

        function bukaTabBaru() {
            const kartuElement = document.querySelector('.kartu-digital-html');

            html2canvas(kartuElement, {
                useCORS: true,
                scale: 2
            }).then(canvas => {
                const dataUrl = canvas.toDataURL("image/png");
                const newTab = window.open();
                newTab.document.write('<img src="' + dataUrl + '" />');
            });
        }

        function scanBarcode() {
            window.location.href = "/scan-barcode";
        }
    </script>

@endsection

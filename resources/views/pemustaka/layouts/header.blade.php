<header>
    <div class="logo">
        <img src="/img/logo.png" alt="Logo Perpustakaan PNB">
        <span>PERPUSTAKAAN POLITEKNIK NEGERI BANYUWANGI</span>
    </div>


    @if(!Auth::guard('anggota')->check())
    <!-- Navigasi untuk Desktop (Jika belum login) -->
    <nav class="nav-links">
        <a href="#">Beranda</a>
        <a href="#">Informasi</a>
        <a href="#">Berita</a>
        <a href="#">Bantuan</a>
        <a href="#">Pustakawan</a>
        <a href="{{ route('barcode.login.form') }}">
            <button class="login-btn">Login</button>
        </a>
    </nav>
    @else
    <!-- Navigasi untuk Desktop -->
    <nav class="nav-links">
        <a href="/">Dashboard</a>
        <a href="/pinjaman">Pinjaman</a>
        <a href="/bayar-denda">Denda</a>
        <a href="/riwayat-kunjungan">Riwayat Kunjungan</a>
        <a href="/profil">Detail Keanggotaan</a>
    </nav>


    <!-- Profil User (Avatar + Nama) -->
    <div class="user-profile">
        @php
        $user = Auth::guard('anggota')->user();
        $nama = $user ? $user->nama : 'Guest';
        $foto = $user && $user->foto_anggota ? asset('storage/' . $user->foto_anggota) : null;
        $inisial = strtoupper(implode('', array_map(fn($word) => $word[0] ?? '', explode(' ', $nama))));
        @endphp

        @if($foto && file_exists(public_path('storage/' . $user->foto_anggota)))
        <img src="{{ $foto }}" alt="Avatar" class="avatar">
        @else
        <div class="avatar-placeholder">{{ $inisial }}</div>
        @endif
        <span class="user-name">{{ Auth::guard('anggota')->user()->nama }}</span>
        <div class="logout-container">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fa-solid fa-sign-out-alt"></i>Logout
                </button>
            </form>
        </div>
    </div>
    @endif

    <!-- Menu Toggle untuk Mobile -->
    <button class="menu-toggle" id="menu-toggle">
        <i class="fa-solid fa-bars"></i>
    </button>

    <!-- Dropdown Menu untuk Mobile -->
    <ul class="dropdown-menu" id="dropdown-menu">
        @if(!Auth::guard('anggota')->check())
        <!-- Jika belum login, tampilkan menu umum -->
        <li><a href="#">Beranda</a></li>
        <li><a href="#">Informasi</a></li>
        <li><a href="#">Berita</a></li>
        <li><a href="#">Bantuan</a></li>
        <li><a href="#">Pustakawan</a></li>
        <li>
            <a href="{{ route('barcode.login.form') }}">
                <button class="login-btn">Login</button>
            </a>
        </li>
        @else
        <!-- Jika sudah login, tampilkan profil dan logout -->
        <li class="profile-menu">
            @php
            $user = Auth::guard('anggota')->user();
            $nama = $user ? $user->nama : 'Guest';
            $foto = $user && $user->foto_anggota ? asset('storage/' . $user->foto_anggota) : null;
            $inisial = strtoupper(implode('', array_map(fn($word) => $word[0] ?? '', explode(' ', $nama))));
            @endphp

            @if($foto && file_exists(public_path('storage/' . $user->foto_anggota)))
            <img src="{{ $foto }}" alt="Avatar" class="avatar">
            @else
            <div class="avatar-placeholder">{{ $inisial }}</div>
            @endif
            <span class="user-name">{{ Auth::guard('anggota')->user()->nama }}</span>
        </li>
        <li>
            <a href="/">Dashboard</a>
        </li>
        <li>
            <a href="/perekam-kunjungan">Perekam Kunjungan</a>
        </li>
        <li>
            <a href="/bayar-denda">Denda</a>
        </li>
        <li>
            <a href="/riwayat-kunjungan">Riwayat Kunjungan</a>
        </li>
        <li>
            <a href="/profil">Detail Keanggotaan</a>
        </li>
        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fa-solid fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </li>
        @endif
    </ul>
</header>


<style>
header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #0d3b66;
    padding: 15px;
    color: white;
    position: relative;

}

.nav-links {
    display: flex;
    gap: 15px;
}


.user-profile {
    display: flex;
    align-items: center;
    gap: 10px;
}

.avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid white;
}

.avatar-placeholder {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #3498db;
    color: white;
    font-weight: bold;
    font-size: 18px;
    border-radius: 50%;
    text-transform: uppercase;
    border: 2px solid white;
}


.logout-container {
    display: flex;
    align-items: center;
}

.logout-btn {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 16px;
    color: white;
}

.logout-btn:hover {
    color: red;
}

.menu-toggle {
    display: none;
    background: none;
    border: none;
    color: white;
    font-size: 24px;
    cursor: pointer;
}

.dropdown-menu {
    display: none;
    position: absolute;
    top: 60px;
    right: 20px;
    background: white;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    padding: 10px;
}

.dropdown-menu.active {
    display: block;
}

.profile-menu {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px;
    border-top: 1px solid #ddd;
}

@media (max-width: 768px) {

    .nav-links,
    .user-profile {
        display: none;
    }

    .profile-menu {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        border-top: 1px solid #ddd;
    }

    .profile-menu .user-name {
        font-size: 16px;
        font-weight: bold;
        color: #0d3b66;
        margin-top: 2px;
    }

    /* Avatar di menu dropdown mobile */
    .profile-menu .avatar,
    .profile-menu .avatar-placeholder {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 2px solid #0d3b66;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: bold;
        text-transform: uppercase;
        background-color: #3498db;
        color: white;
    }

    /* Pastikan avatar asli tidak terdistorsi */
    .profile-menu .avatar {
        object-fit: cover;
    }

    .menu-toggle {
        display: block;
    }

    .logout-btn {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 16px;
        color: #0d3b66;
        padding: 10px;
        display: flex;
        align-items: center;
        width: 100%;
        gap: 8px;
        /* Memberi jarak antara ikon dan teks */
    }

    .logout-btn:hover {
        color: red;
    }

}
</style>

<script>
function toggleMenu() {
    const menu = document.querySelector('.dropdown-menu');
    menu.classList.toggle('show');
}
</script>

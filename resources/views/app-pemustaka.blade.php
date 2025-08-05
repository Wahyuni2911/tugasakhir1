<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <title>@yield('title') | Perpustakaan Poliwangi</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>

    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        text-align: center;
        background-color: #f8f9fa;
    }

    /* Header */
    header {
        background-color: #003366;
        color: white;
        padding: 15px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        position: relative;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .logo img {
        height: 40px;
    }

    .logo span {
        font-size: 18px;
        font-weight: bold;
        color: white;
    }

    /* Menu Navigasi */
    .nav-links {
        display: flex;
        gap: 20px;
    }

    .nav-links a {
        color: white;
        text-decoration: none;
        font-size: 16px;
        padding: 5px 10px;
        transition: 0.3s;
    }

    .nav-links a:hover {
        background-color: #FFD700;
        color: #003366;
        border-radius: 5px;
    }

    .menu-toggle {
        background: none;
        border: none;
        color: white;
        font-size: 24px;
        cursor: pointer;
        display: none;
    }

    .top-users,
    .user-dashboard {
        padding: 20px;
        background: white;
        margin: 20px auto;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 90%;
    }

    .user-list {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .user {
        text-align: center;
        flex: 1 1 30%;
        max-width: 150px;
    }

    .user img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
    }

    .dashboard-images {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .dashboard-images img {
        width: 150px;
        height: auto;
    }

    #app-content {
        flex: 1 0 auto;
        /* fleksibel dan ambil sisa ruang */
        padding: 20px;
        background-color: #f9f9f9;
    }

    footer {
        flex-shrink: 0;
        /* footer tidak ikut mengecil */
        background-color: #222;
        color: white;
        text-align: center;
        padding: 15px;
    }

    @media (max-width: 768px) {
        header {
            flex-direction: row;
            justify-content: space-between;
            padding: 10px 20px;
            position: relative;
        }

        .logo {
            justify-content: center;
        }

        .logo span {
            font-size: 12px;
            /* Ukuran lebih kecil untuk mobile */
            max-width: 180px;
            /* Batas lebar agar tidak terlalu panjang */
            justify-content: center;
        }

        .menu-toggle {
            display: block;
        }

        .user-list {
            display: flex;
            justify-content: center;
            flex-wrap: nowrap;
            /* Mencegah elemen turun ke bawah */
            overflow-x: auto;
            /* Tambahkan scroll horizontal jika perlu */
        }

        .user-list .user {
            flex: 1 1 30%;
            max-width: 30%;
            min-width: 100px;
            /* Agar tetap proporsional */
        }

        .dashboard-images img {
            flex: 1 1 45%;
            max-width: 45%;
        }

        .menu-toggle {
            right: 10px;
            top: 15px;
        }


        .nav-links {
            display: none;
        }


        .menu-toggle {
            display: block;
        }

        .dropdown-menu {
            display: none;
            flex-direction: column;
        }

        .dropdown-menu.active {
            display: flex;
        }

        footer {
            position: fixed;
            bottom: 0;
        }

    }


    /* Menu Toggle (Hanya muncul di Mobile) */
    .menu-toggle {
        background: none;
        border: none;
        color: white;
        font-size: 24px;
        cursor: pointer;
        display: block;
    }

    .menu-toggle i {
        font-size: 30px;
        color: #FFD700;
    }

    /* Dropdown Menu (Mobile) */
    .dropdown-menu {
        display: none;
        flex-direction: column;
        position: absolute;
        top: 60px;
        right: 20px;
        background: white;
        list-style: none;
        padding: 0;
        margin: 0;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        width: 150px;
        text-align: left;
    }

    .dropdown-menu a {
        padding: 10px;
        display: block;
        text-decoration: none;
        color: #003366;
        border-bottom: 1px solid #ddd;
    }

    .dropdown-menu a:hover {
        background: #003366;
        color: white;
    }


    /* Footer navbar seperti di gambar */
    footer {
        background-color: white;
        padding: 10px 0;
        position: static;
        /* Pastikan tidak fixed di desktop */
        bottom: 0;
        width: 100%;
        box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);

    }

    .footer-nav {
        display: flex;
        justify-content: space-around;
        align-items: center;
    }

    .footer-nav a {
        text-decoration: none;
        color: #333;
        font-size: 20px;
    }

    .footer-nav a.active {
        color: #003366;
    }

    /* Mengatasi 2 lingkaran kecil di User Dashboard */
    .dashboard-images {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: nowrap;
        overflow-x: auto;
        /* Scroll jika gambar lebih banyak */
        padding-bottom: 10px;
    }

    /* Hilangkan pagination (jika ada) */
    .swiper-pagination {
        display: none !important;
    }

    /* Atau jika itu bagian tidak diinginkan */
    .user-dashboard::after {
        display: none;
    }
    </style>
</head>

<body>

    @include('pemustaka.layouts.header')

    <main>
        @yield('content')
    </main>

    @include('pemustaka.layouts.footer')

    <script>
    const menuToggle = document.querySelector('.menu-toggle');
    const dropdownMenu = document.querySelector('.dropdown-menu');
    const menuIcon = menuToggle.querySelector('i');

    menuToggle.addEventListener('click', function() {
        dropdownMenu.classList.toggle('active'); // Tampilkan/sembunyikan menu

        if (dropdownMenu.classList.contains('active')) {
            menuIcon.classList.remove('fa-bars');
            menuIcon.classList.add('fa-times'); // Ubah ikon ke "X"
        } else {
            menuIcon.classList.remove('fa-times');
            menuIcon.classList.add('fa-bars'); // Kembali ke ikon menu
        }
    });
    </script>

    <script src="{{ asset('/sw.js') }}"></script>
    <script>
    if ("serviceWorker" in navigator) {
        // Register a service worker hosted at the root of the
        // site using the default scope.
        navigator.serviceWorker.register("/sw.js").then(
            (registration) => {
                console.log("Service worker registration succeeded:", registration);
            },
            (error) => {
                console.error(`Service worker registration failed: ${error}`);
            },
        );
    } else {
        console.error("Service workers are not supported.");
    }
    </script>

</body>






</html>

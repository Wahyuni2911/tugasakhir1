<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | E-Library Poliwangi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
    window.addEventListener("DOMContentLoaded", () => {
        lucide.createIcons();
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <div class="flex-1 ml-64 flex flex-col">
            <!-- Topbar -->
            @include('partials.topbar')

            <!-- Main Content -->
            <main class="flex-1 p-6 mt-16">
                <h1 class="text-l font-bold">@yield('pages')</h1>
                <!-- Stats Cards -->
                @yield('content')

            </main>

            <!-- Footer -->
            @include('partials.footer')
        </div>
    </div>

    <script>
    function toggleDropdown(id) {
        document.getElementById(id).classList.toggle('hidden');
    }
    </script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    const ctx = document.getElementById('chart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
            datasets: [{
                label: 'Kunjungan',
                data: [5, 10, 8, 6, 15, 30, 45],
                borderColor: 'blue',
                fill: false,
            }]
        }
    });
    </script>
</body>





</html>

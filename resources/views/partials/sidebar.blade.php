<aside class="w-64 bg-blue-100 p-5 flex flex-col fixed h-full shadow-lg">
    <div class="flex items-center space-x-3">
        <img src="/img/logo.png" alt="Logo Poliwangi" class="w-11 h-11">
        <h2 class="text-l font-bold">Sistem Kunjungan</h2>
    </div>
    <span class="text-l text-gray-900">Politeknik Negeri Banyuwangi</span>
    <nav class="mt-5">
        <ul class="space-y-2">
            <li class="text-gray-600 mt-5">HOME</li>
            <li class="py-2 p-2 rounded flex items-center space-x-3">
                <i class="fas fa-home"></i>
                <a href="/dashboard">Dashboard</a>
            </li>

            <li class="text-gray-600 ">MENU</li>
            <!-- Dropdown Master Data -->
            <li class="mt-2 cursor-pointer flex items-center justify-between p-2"
                onclick="toggleDropdown('masterDataDropdown')">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-database"></i>
                    <span>Master Data</span>
                </div>
                <i id="dropdownIcon" class="fas fa-chevron-down transition-transform"></i>
            </li>
            <ul id="masterDataDropdown" class="hidden pl-6 space-y-2 border-l-2 border-gray-300">
                <li class="flex items-center space-x-3 p-2">
                    <i class="fas fa-graduation-cap"></i>
                    <a href="/program-studi">Program Studi</a>
                </li>
                <li class="flex items-center space-x-3 p-2">
                    <i class="fas fa-list"></i>
                    <a href="/kategori-kunjungan">Kategori Kunjungan</a>
                </li>
                <li class="flex items-center space-x-3 p-2">
                    <i class="fas fa-user-plus"></i>
                    <a href="/pendaftaran-anggota">Pendaftaran Anggota</a>
                </li>
            </ul>

            <li class="mt-2 flex items-center space-x-3 p-2">
                <i class="fas fa-users"></i>
                <a href="/kelola-anggota">Kelola Anggota</a>
            </li>
            <li class="mt-2 flex items-center space-x-3 p-2">
                <i class="fas fa-map-pin"></i>
                <a href="/geolocation">Geolocation</a>
            </li>
            <li class="mt-2 flex items-center space-x-3 p-2">
                <i class="fas fa-file-text"></i>
                <a href="/laporan-kunjungan">Laporan</a>
            </li>
            <li class="mt-2 flex items-center space-x-3 p-2">
                <i class="fas fa-gear"></i>
                <a href="/setting-card">Setting Card</a>
            </li>
        </ul>
    </nav>
</aside>

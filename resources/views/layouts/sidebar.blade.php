<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">Perpustakaan</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'pegawai')
                <li class="nav-item">
                    <a href="{{ route('anggota.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Data Anggota</p>
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('profile.show', Auth::user()->id) }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li>

                @if(Auth::user()->role == 'admin')
                <li class="nav-item">
                    <a href="{{ route('visit.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-eye"></i>
                        <p>Visit</p>
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
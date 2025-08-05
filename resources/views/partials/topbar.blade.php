<header class="bg-white shadow p-4 flex justify-between items-center fixed w-[calc(100%-256px)] left-64 z-10">
    <div class="flex items-center space-x-3">
        <div class="w-6 h-6 flex flex-col justify-between cursor-pointer">
            <svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </div>
    </div>
    <div class="flex items-center space-x-3">
        @auth
        @php
        $user = Auth::user();
        $initial = strtoupper(substr($user->name, 0, 1)); // Ambil huruf pertama dari nama
        @endphp
        <div
            class="w-10 h-10 bg-blue-300 text-white flex items-center justify-center rounded-full shadow-md hover:scale-110 transition-transform">
            {{ $initial }}
        </div>
        <div class="flex items-center space-x-2 cursor-pointer group">
            <span class="font-semibold text-gray-700 group-hover:text-blue-700">{{ $user->name }}</span>
            <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                @csrf
                <button type="submit" class="flex items-center">
                    <svg class="w-5 h-5 text-gray-600 group-hover:text-red-600 transition-colors"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                    </svg>
                </button>
            </form>
        </div>
        @endauth
    </div>
</header>
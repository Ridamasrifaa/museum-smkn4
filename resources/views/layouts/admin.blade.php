<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>@yield('title', 'Admin Dashboard') - Museum Karya PPLG</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/admin/style.css') }}">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen bg-gray-100">

        {{-- SIDEBAR UTAMA --}}
        <div class="w-64 custom-nav-bg text-white shadow-lg flex flex-col justify-between">
            <div>
                <div class="p-6 border-b border-gray-700">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center font-bold text-md">A</div>
                        <div>
                            <p class="font-bold">Museum Karya Smkn 4</p>
                        </div>
                    </div>
                </div>
                <nav class="mt-6 space-y-2 px-4">
                <a href="{{ url('/admin/dashboard') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 {{ Request::is('admin/dashboard*') ? 'bg-blue-600 text-white font-semibold shadow-sm' : 'text-gray-300 hover:bg-gray-800' }}">
                    <span>Dashboard</span>
                </a>

                <a href="{{ url('/admin/karya') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 {{ Request::is('admin/karya*') ? 'bg-blue-600 text-white font-semibold shadow-sm' : 'text-gray-300 hover:bg-gray-800' }}">
                    <span>Karya</span>
                </a>

                <a href="{{ url('/admin/siswa') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 {{ Request::is('admin/siswa*') ? 'bg-blue-600 text-white font-semibold shadow-sm' : 'text-gray-300 hover:bg-gray-800' }}">
                    <span>Siswa</span>
                </a>

                <a href="{{ url('/admin/kategori') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 {{ Request::is('admin/kategori*') ? 'bg-blue-600 text-white font-semibold shadow-sm' : 'text-gray-300 hover:bg-gray-800' }}">
                    <span>Kategori</span>
                </a>

                <a href="{{ url('/admin/manajemen-admin') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 {{ Request::is('admin/manajemen-admin*') ? 'bg-gray-800 text-white font-semibold' : 'text-gray-300 hover:bg-gray-800' }}">
                    <span>Users</span>
                </a>

                <a href="{{ url('/admin/artikel') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 {{ Request::is('admin/artikel*') ? 'bg-blue-600 text-white font-semibold shadow-sm' : 'text-gray-300 hover:bg-gray-800' }}">
                    <span>Artikel</span>
                </a>

                <a href="{{ route('admin.kode-undangan.index') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 {{ request()->routeIs('admin.kode-undangan.*') ? 'bg-blue-600 text-white font-semibold shadow-sm' : 'text-gray-300 hover:bg-gray-800' }}">
                    <span>Kode Unik</span>
                </a>
            </nav>
            </div>
            
            {{-- TOMBOL LOGOUT --}}
            <div class="p-6 border-t border-gray-700">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
                <button type="button" onclick="openLogoutModal()" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold cursor-pointer">
                    Logout
                </button>
            </div>
        </div>

        {{-- AREA KONTEN UTAMA --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow-sm z-10">
                <div class="px-8 py-4 flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-900">@yield('page_title', 'Dashboard')</h1>
                    <div class="flex items-center gap-4">
                        @yield('header_action')
                        <div class="text-right">
                            <p class="font-semibold text-gray-900">{{ Auth::user()->name ?? 'Admin' }}</p>
                            <p class="text-sm text-gray-500">Login sebagai admin</p>
                        </div>
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-auto p-8 relative">
                @yield('content')
            </div>
        </div>
    </div>

    {{-- MODAL POP-UP LOGOUT KUSTOM --}}
    <div id="logoutModal" class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full overflow-hidden border border-gray-100 transform transition-all scale-100">
            
            <div class="bg-gradient-to-r from-amber-500 to-orange-500 p-5 text-white flex items-center gap-3">
                <div class="p-2 bg-white/20 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold">Konfirmasi Keluar</h3>
            </div>

            <div class="p-6 text-center">
                <p class="text-gray-700 font-medium leading-relaxed text-base">
                    "kamu mau keluar? Periksa dulu karya siswa, kalau belum cek dulu setuju atau tidak.<br>
                    <!-- <span class="font-semibold text-amber-600 block mt-2">Kalau sudah siip, mantapp kawann....."</span> -->
                </p>
            </div>

            <div class="bg-gray-50 px-6 py-4 flex gap-3 justify-end border-t border-gray-100">
                <button type="button" onclick="closeLogoutModal()" class="px-5 py-2.5 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition text-sm cursor-pointer">
                    Tidak
                </button>
                <button type="button" onclick="confirmLogout()" class="px-5 py-2.5 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition text-sm shadow-md cursor-pointer">
                    Yaa
                </button>
            </div>
        </div>
    </div>

    <script>
        function openLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }

        function confirmLogout() {
            document.getElementById('logout-form').submit();
        }
    </script>

    @stack('scripts')
</body>
</html>
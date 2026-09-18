<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>@yield('title', 'Super Admin') - Museum Karya PPLG</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/admin/style.css') }}">
</head>
<body class="bg-gray-100 text-gray-900 font-sans">
    <div class="flex h-screen bg-gray-100 overflow-hidden relative">

        {{-- OVERLAY MOBILE SAAT SIDEBAR BUKA --}}
        <div id="sidebarOverlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden"></div>

        {{-- SIDEBAR SUPER ADMIN (Responsive Drawer untuk Mobile) --}}
        <div id="appSidebar" class="fixed lg:static inset-y-0 left-0 w-64 shrink-0 h-full bg-white border-r-3 border-black text-gray-900 flex flex-col justify-between z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
            <div class="flex flex-col overflow-hidden h-full">
                <div class="p-6 border-b-3 border-black shrink-0 bg-[#ffcc00] flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-black text-white rounded-xl border-2 border-black flex items-center justify-center font-black text-md shadow-[2px_2px_0px_#000]">SA</div>
                        <div>
                            <p class="font-black text-sm">Museum Karya Smkn 4</p>
                            <p class="text-xs font-bold text-gray-800">Super Admin</p>
                        </div>
                    </div>
                    {{-- Tombol Close Sidebar Khusus Mobile --}}
                    <button onclick="toggleSidebar()" class="lg:hidden p-1 bg-white rounded-lg border-2 border-black font-black text-xs shadow-[2px_2px_0px_#000]">✕</button>
                </div>

                {{-- NAVIGASI SIDEBAR --}}
                <nav class="mt-4 space-y-2 px-4 overflow-y-auto flex-1 pb-4">
                    {{-- Dashboard --}}
                    <a href="{{ url('/superadmin/dashboard') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 border-2 border-black font-black text-sm {{ Request::is('superadmin/dashboard*') ? 'bg-[#ffcc00] shadow-[3px_3px_0px_#000] translate-x-1' : 'bg-white hover:bg-yellow-50 shadow-[2px_2px_0px_#000]' }}">
                        <span>Dashboard</span>
                    </a>

                    {{-- Manajemen Admin --}}
                    <a href="{{ url('/superadmin/manajemen-admin') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 border-2 border-black font-black text-sm {{ Request::is('superadmin/manajemen-admin*') ? 'bg-[#ffcc00] shadow-[3px_3px_0px_#000] translate-x-1' : 'bg-white hover:bg-yellow-50 shadow-[2px_2px_0px_#000]' }}">
                        <span>Manajemen Admin</span>
                    </a>

                    {{-- Karya --}}
                    <a href="{{ url('/admin/karya') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 border-2 border-black font-black text-sm {{ Request::is('admin/karya*') ? 'bg-[#ffcc00] shadow-[3px_3px_0px_#000] translate-x-1' : 'bg-white hover:bg-yellow-50 shadow-[2px_2px_0px_#000]' }}">
                        <span>Karya</span>
                    </a>

                    {{-- Siswa --}}
                    <a href="{{ url('/admin/siswa') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 border-2 border-black font-black text-sm {{ Request::is('admin/siswa*') ? 'bg-[#ffcc00] shadow-[3px_3px_0px_#000] translate-x-1' : 'bg-white hover:bg-yellow-50 shadow-[2px_2px_0px_#000]' }}">
                        <span>Siswa</span>
                    </a>

                    {{-- Kategori --}}
                    <a href="{{ url('/admin/kategori') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 border-2 border-black font-black text-sm {{ Request::is('admin/kategori*') ? 'bg-[#ffcc00] shadow-[3px_3px_0px_#000] translate-x-1' : 'bg-white hover:bg-yellow-50 shadow-[2px_2px_0px_#000]' }}">
                        <span>Kategori</span>
                    </a>

                    {{-- Artikel --}}
                    <a href="{{ url('/admin/artikel') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 border-2 border-black font-black text-sm {{ Request::is('admin/artikel*') ? 'bg-[#ffcc00] shadow-[3px_3px_0px_#000] translate-x-1' : 'bg-white hover:bg-yellow-50 shadow-[2px_2px_0px_#000]' }}">
                        <span>Artikel</span>
                    </a>

                    {{-- Kode Unik --}}
                    <a href="{{ route('admin.kode-undangan.index') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 border-2 border-black font-black text-sm {{ request()->routeIs('admin.kode-undangan.*') ? 'bg-[#ffcc00] shadow-[3px_3px_0px_#000] translate-x-1' : 'bg-white hover:bg-yellow-50 shadow-[2px_2px_0px_#000]' }}">
                        <span>Kode Unik</span>
                    </a>
                    <div class="pt-4 mt-4 border-t border-gray-800">
                        <a href="{{ url('/karya') }}"
                            class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 hover:bg-blue-600/20 text-blue-400 hover:text-blue-300 text-left font-medium">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                            </svg>
                            <span>Lihat Karya Siswa lain</span>
                        </a>
                    </div>
                </nav>
            </div>

            {{-- TOMBOL LOGOUT --}}
            <div class="p-6 border-t-3 border-black shrink-0 bg-gray-50">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
                <button type="button" onclick="openLogoutModal()" class="w-full px-4 py-2.5 bg-red-400 text-black border-2 border-black rounded-xl hover:bg-red-500 transition font-black text-sm shadow-[3px_3px_0px_#000] cursor-pointer">
                    Logout
                </button>
            </div>
        </div>

        {{-- AREA KONTEN UTAMA --}}
        <div class="flex-1 flex flex-col overflow-hidden bg-[#fcfcfc] w-full">
            <header class="bg-white border-b-3 border-black z-10 shrink-0">
                <div class="px-4 sm:px-8 py-4 flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        {{-- Tombol Hamburger untuk Mobile --}}
                        <button onclick="toggleSidebar()" class="lg:hidden p-2 bg-[#ffcc00] rounded-xl border-2 border-black shadow-[2px_2px_0px_#000] cursor-pointer font-black">
                            <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                        <h1 class="text-base sm:text-xl font-black text-gray-900 truncate">@yield('page_title', 'Dashboard')</h1>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        @yield('header_action')
                        <div class="text-right hidden sm:block">
                            <p class="font-black text-sm text-gray-900">{{ Auth::user()->name ?? 'Super Admin' }}</p>
                            <p class="text-xs font-bold text-purple-700">Super Admin</p>
                        </div>
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-4 sm:p-6 relative">
                @yield('content')
            </div>
        </div>
    </div>

    {{-- MODAL LOGOUT NEOBRUTALISM --}}
    <div id="logoutModal" class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-[6px_6px_0px_#000] max-w-md w-full overflow-hidden border-3 border-black">
            <div class="bg-[#ffcc00] p-5 border-b-3 border-black flex items-center gap-3">
                <div class="p-2 bg-white rounded-xl border-2 border-black shadow-[2px_2px_0px_#000]">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-black text-black">Konfirmasi Keluar</h3>
            </div>

            <div class="p-6 text-center">
                <p class="text-gray-800 font-bold text-base">
                    Yakin mau logout dari sistem?
                </p>
            </div>

            <div class="bg-gray-50 px-6 py-4 flex gap-3 justify-end border-t-3 border-black">
                <button type="button" onclick="closeLogoutModal()" class="px-5 py-2.5 bg-gray-200 text-black font-black rounded-xl border-2 border-black shadow-[2px_2px_0px_#000] hover:bg-gray-300 transition text-sm cursor-pointer">
                    Batal
                </button>
                <button type="button" onclick="confirmLogout()" class="px-5 py-2.5 bg-red-400 text-black font-black rounded-xl border-2 border-black shadow-[2px_2px_0px_#000] hover:bg-red-500 transition text-sm cursor-pointer">
                    Ya, Logout
                </button>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('appSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
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
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <title>@yield('title', 'Admin Dashboard') - Museum Karya SMKN 4</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- CSS Internal Khusus Admin -->
    <style>
        body {
            background-color: #fcfcfc;
            background-image:
                linear-gradient(to right, #ececec 1px, transparent 1px),
                linear-gradient(to bottom, #ececec 1px, transparent 1px);
            background-size: 24px 24px;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        .custom-nav-bg {
          background-color: #fffdf9;
          border-right: 3px solid #000000;
        }

        .nav-link-active {
          background-color: #ffcc00 !important;
          color: #000000 !important;
          border: 2px solid #000000 !important;
          font-weight: 800 !important;
          box-shadow: 2px 2px 0px #000000;
        }

        .nav-link-idle {
          color: #4b5563;
          font-weight: 700;
          border: 2px solid transparent;
          transition: all 0.1s ease-in-out;
        }

        .nav-link-idle:hover {
          background-color: #f3f4f6;
          color: #000000;
          border: 2px solid #000000;
          box-shadow: 2px 2px 0px #000000;
        }

        /* ============ DESAIN SISTEM NEUBRUTALISM (dipakai di semua halaman admin) ============ */

        /* Kartu dasar bergaya neubrutalism, statis (tanpa animasi fade-in) */
        .neubrutal-card {
            background: #ffffff;
            border: 3px solid #000000;
            border-radius: 1rem;
            box-shadow: 4px 4px 0px #000000;
        }

        /* Kartu yang fade-in saat halaman selesai loading (dipakai dashboard) */
        .counter-card,
        .stats-section-card {
            opacity: 0;
            transform: translateY(40px);
            transition: .5s ease;
            background: #ffffff;
            border: 3px solid #000000;
            border-radius: 1rem;
            box-shadow: 4px 4px 0px #000000;
        }

        .counter-card.show,
        .stats-section-card.show {
            opacity: 1;
            transform: translateY(0);
        }

        .admin-header {
            background: #ffffff;
            border-bottom: 3px solid #000000;
        }

        .sidebar-brand {
            border-bottom: 3px solid #000000;
        }

        .sidebar-logout {
            border-top: 3px solid #000000;
        }

        .btn-neubrutal {
            border: 2px solid #000000;
            box-shadow: 2px 2px 0px #000000;
            font-weight: 800;
            transition: all 0.1s ease;
        }
        .btn-neubrutal:hover {
            transform: translate(-1px, -1px);
            box-shadow: 3px 3px 0px #000000;
        }
        .btn-neubrutal:active {
            transform: translate(2px, 2px);
            box-shadow: 1px 1px 0px #000000;
        }

        /* Input field bergaya neubrutalism, dipakai di semua form pencarian/modal */
        .input-neubrutal {
            border: 2px solid #000000;
            box-shadow: 2px 2px 0px #000000;
            font-weight: 600;
            outline: none;
            background: #ffffff;
        }
        .input-neubrutal:focus {
            background-color: #fffdf9;
        }

        /* Badge/status pill bergaya neubrutalism */
        .badge-neubrutal {
            display: inline-block;
            border: 2px solid #000000;
            box-shadow: 2px 2px 0px #000000;
            border-radius: 0.5rem;
            font-weight: 800;
            font-size: 0.75rem;
            padding: 0.25rem 0.75rem;
        }

        /* Tabel bergaya neubrutalism */
        .table-neubrutal thead {
            background-color: #f3f4f6;
            border-bottom: 3px solid #000000;
        }
        .table-neubrutal tbody tr {
            border-bottom: 2px solid #e5e7eb;
        }
        .table-neubrutal tbody tr:hover {
            background-color: #fffbea;
        }

        /* Modal bergaya neubrutalism (overlay + kartu) */
        .modal-overlay {
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(2px);
        }
        .modal-card {
            background: #ffffff;
            border: 3px solid #000000;
            border-radius: 1rem;
            box-shadow: 6px 6px 0px #000000;
        }

        #mobileDropdown {
            max-height: 0;
            opacity: 0;
            transform: translateY(-15px) scaleY(0.95);
            transform-origin: top;
            overflow: hidden;
            pointer-events: none;
            transition: max-height 0.45s cubic-bezier(0.4, 0, 0.2, 1),
                        opacity 0.35s ease-in-out,
                        transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        #mobileDropdown.dropdown-open {
            max-height: 500px;
            opacity: 1;
            transform: translateY(0) scaleY(1);
            pointer-events: auto;
        }
    </style>
    @stack('styles')
</head>
<body class="overflow-x-hidden">

    <div class="flex h-screen overflow-hidden relative">

        <!-- SIDEBAR DESKTOP -->
        <aside class="hidden lg:flex w-64 custom-nav-bg text-gray-800 flex-col justify-between shrink-0">
            <div>
                <div class="p-6 sidebar-brand flex items-center gap-3">
                    <div class="w-10 h-10 bg-[#ffcc00] border-2 border-black rounded-full flex items-center justify-center font-black text-black shadow-[2px_2px_0px_#000]">M</div>
                    <p class="font-extrabold text-gray-900 text-sm">Museum Karya SMKN 4</p>
                </div>
<<<<<<< Updated upstream
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
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 {{ Request::is('admin/manajemen-admin*') ?'bg-blue-600 text-white font-semibold shadow-sm' : 'text-gray-300 hover:bg-gray-800' }}">
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
                @if(auth()->check() && auth()->user()->role === 0)
                    <a href="{{ url('/superadmin/dashboard') }}" 
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 {{ request()->routeIs('superadmin.dashboard*') ? 'bg-blue-600 text-white font-semibold shadow-sm' : 'text-gray-300 hover:bg-gray-800' }}">
                        <span>kembali ke super admin</span>
                    </a>
                @endif
            </nav>
=======
                <nav class="mt-6 space-y-2 px-4 overflow-y-auto max-h-[calc(100vh-200px)]">
                    <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('admin/dashboard*') ? 'nav-link-active' : 'nav-link-idle' }}">
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ url('/admin/karya') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('admin/karya*') ? 'nav-link-active' : 'nav-link-idle' }}">
                        <span>Karya</span>
                    </a>
                    <a href="{{ url('/admin/siswa') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('admin/siswa*') ? 'nav-link-active' : 'nav-link-idle' }}">
                        <span>Siswa</span>
                    </a>
                    <a href="{{ url('/admin/kategori') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('admin/kategori*') ? 'nav-link-active' : 'nav-link-idle' }}">
                        <span>Kategori</span>
                    </a>

                    @if(auth()->check() && auth()->user()->isSuperAdmin())
                        <a href="{{ url('/superadmin/manajemen-admin') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('superadmin/manajemen-admin*') || Request::is('admin/manajemen-admin*') ? 'nav-link-active' : 'nav-link-idle' }}">
                            <span>Users</span>
                        </a>
                    @endif

                    <a href="{{ url('/admin/artikel') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('admin/artikel*') ? 'nav-link-active' : 'nav-link-idle' }}">
                        <span>Artikel</span>
                    </a>
                    <a href="{{ route('admin.kode-undangan.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.kode-undangan.*') ? 'nav-link-active' : 'nav-link-idle' }}">
                        <span>Kode Unik</span>
                    </a>
                    <a href="{{ url('/admin/profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('admin/profile*') ? 'nav-link-active' : 'nav-link-idle' }}">
                        <span>Profil Saya</span>
                    </a>

                    @if(auth()->check() && auth()->user()->isSuperAdmin())
                        <a href="{{ url('/superadmin/dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('superadmin.dashboard*') ? 'nav-link-active' : 'nav-link-idle' }}">
                            <span>Kembali ke Super Admin</span>
                        </a>
                    @endif
                </nav>
>>>>>>> Stashed changes
            </div>

            <div class="p-6 sidebar-logout bg-[#fffdf9]">
                <button type="button" onclick="openLogoutModal()" class="w-full px-4 py-2.5 bg-red-500 text-white rounded-xl btn-neubrutal cursor-pointer">
                    Logout
                </button>
            </div>
        </aside>

        <!-- AREA KONTEN UTAMA -->
        <div class="flex-1 flex flex-col overflow-hidden w-full relative">

            <!-- HEADER UTAMA -->
            <header class="admin-header z-20 relative">
                <div class="px-4 sm:px-8 py-4 flex justify-between items-center gap-4">
                    <div class="flex items-center gap-3">
                        <button onclick="toggleMobileDropdown()" class="lg:hidden p-2 bg-[#ffcc00] border-2 border-black rounded-xl shadow-[2px_2px_0px_#000] font-bold cursor-pointer hover:bg-yellow-400 active:translate-y-0.5 transition">
                            🍔
                        </button>
                        <h1 class="text-xl sm:text-2xl font-black text-gray-900 tracking-tight">@yield('page_title', 'Dashboard Admin')</h1>
                    </div>
                    <div class="flex items-center gap-4">
                        @yield('header_action')
                        <div class="text-right">
<<<<<<< Updated upstream
                            <p class="font-semibold text-gray-900">{{ Auth::user()->name ?? 'Admin' }}</p>
                            <p class="text-sm text-gray-500">Login sebagai admin</p>
                        </div>
=======
                            <p class="font-extrabold text-gray-900 text-sm sm:text-base">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] sm:text-xs text-gray-500 font-bold">
                                {{ Auth::user()->isSuperAdmin() ? 'Super Admin' : 'Admin ' . (Auth::user()->jurusan ?? 'Museum PPLG / TIK') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- DROPDOWN NAVIGASI MOBILE -->
                <div id="mobileDropdown" class="lg:hidden bg-[#fffdf9] border-b-3 border-black shadow-[0_6px_0px_#000] px-4 py-3 absolute top-full left-0 right-0 z-30">
                    <nav class="space-y-2">
                        <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl {{ Request::is('admin/dashboard*') ? 'nav-link-active' : 'nav-link-idle' }}">
                            <span>Dashboard</span>
                        </a>
                        <a href="{{ url('/admin/karya') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl {{ Request::is('admin/karya*') ? 'nav-link-active' : 'nav-link-idle' }}">
                            <span>Karya</span>
                        </a>
                        <a href="{{ url('/admin/siswa') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl {{ Request::is('admin/siswa*') ? 'nav-link-active' : 'nav-link-idle' }}">
                            <span>Siswa</span>
                        </a>
                        <a href="{{ url('/admin/kategori') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl {{ Request::is('admin/kategori*') ? 'nav-link-active' : 'nav-link-idle' }}">
                            <span>Kategori</span>
                        </a>

                        @if(auth()->check() && auth()->user()->isSuperAdmin())
                            <a href="{{ url('/superadmin/manajemen-admin') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl {{ Request::is('superadmin/manajemen-admin*') || Request::is('admin/manajemen-admin*') ? 'nav-link-active' : 'nav-link-idle' }}">
                                <span>Users</span>
                            </a>
                        @endif

                        <a href="{{ url('/admin/artikel') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl {{ Request::is('admin/artikel*') ? 'nav-link-active' : 'nav-link-idle' }}">
                            <span>Artikel</span>
                        </a>
                        <a href="{{ route('admin.kode-undangan.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl {{ request()->routeIs('admin.kode-undangan.*') ? 'nav-link-active' : 'nav-link-idle' }}">
                            <span>Kode Unik</span>
                        </a>
                        <a href="{{ url('/admin/profile') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl {{ Request::is('admin/profile*') ? 'nav-link-active' : 'nav-link-idle' }}">
                            <span>Profil Saya</span>
                        </a>

                        @if(auth()->check() && auth()->user()->isSuperAdmin())
                            <a href="{{ url('/superadmin/dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl {{ request()->routeIs('superadmin.dashboard*') ? 'nav-link-active' : 'nav-link-idle' }}">
                                <span>Kembali ke Super Admin</span>
                            </a>
                        @endif
                    </nav>

                    <div class="pt-3 mt-3 border-t-2 border-black">
                        <button type="button" onclick="openLogoutModal()" class="w-full px-4 py-2 bg-red-500 text-white rounded-xl btn-neubrutal cursor-pointer text-sm">
                            Logout
                        </button>
>>>>>>> Stashed changes
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-auto p-4 sm:p-8 relative">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- MODAL LOGOUT -->
    <div id="logoutModal" class="hidden fixed inset-0 z-50 modal-overlay flex items-center justify-center p-4">
        <div class="modal-card rounded-2xl max-w-md w-full overflow-hidden">
            <div class="bg-[#ffcc00] border-b-3 border-black p-5 text-black flex items-center gap-3">
                <h3 class="text-lg font-black tracking-tight">Konfirmasi Keluar</h3>
            </div>
            <div class="p-6 text-center">
                <p class="text-gray-800 font-bold text-base">Yakin ingin keluar dari panel admin Museum SMKN 4?</p>
            </div>
            <div class="bg-gray-50 px-6 py-4 flex gap-3 justify-end border-t-3 border-black">
                <button type="button" onclick="closeLogoutModal()" class="px-5 py-2.5 bg-gray-200 text-gray-800 rounded-xl btn-neubrutal cursor-pointer">Tidak</button>
                <button type="button" onclick="confirmLogout()" class="px-5 py-2.5 bg-red-500 text-white rounded-xl btn-neubrutal cursor-pointer">Yaa</button>
            </div>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    <script>
        function toggleMobileDropdown() {
            const dropdown = document.getElementById('mobileDropdown');
            dropdown.classList.toggle('dropdown-open');
        }

        function openLogoutModal() { document.getElementById('logoutModal').classList.remove('hidden'); }
        function closeLogoutModal() { document.getElementById('logoutModal').classList.add('hidden'); }
        function confirmLogout() { document.getElementById('logout-form').submit(); }
    </script>

    @stack('scripts')
</body>
</html>
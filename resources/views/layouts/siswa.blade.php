<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>@yield('title', 'Student Dashboard') - Karya PPLG</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @stack('styles')
</head>
<body class="bg-gray-100">
    <div class="flex h-screen bg-gray-100 overflow-hidden">

        {{-- ================= SIDEBAR ================= --}}
        <div class="w-64 bg-gray-900 text-white shadow-lg flex flex-col shrink-0">
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center gap-3">
                    @if(Auth::user()->avatar)
                        <img src="{{ Auth::user()->avatar }}" alt="Foto Profil" class="w-10 h-10 rounded-full object-cover">
                    @else
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                    <div>
                        <p class="font-bold text-sm">{{ Auth::user()->name }}</p>
                    </div>
                </div>
            </div>

            <nav class="mt-6 flex-1 space-y-2 px-4">
                <a href="{{ url('/siswa/dashboard') }}"
                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 {{ request()->is('siswa/dashboard*') ? 'bg-blue-600 text-white font-semibold shadow-sm' : 'hover:bg-gray-800 text-gray-400 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ url('/siswa/profil') }}"
                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 {{ request()->is('siswa/profil*') ? 'bg-blue-600 text-white font-semibold shadow-sm' : 'hover:bg-gray-800 text-gray-400 hover:text-white' }} text-left">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                    <span>Profil</span>
                </a>

                <a href="{{ url('/siswa/karya') }}"
                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 {{ request()->is('siswa/karya*') ? 'bg-blue-600 text-white font-semibold shadow-sm' : 'hover:bg-gray-800 text-gray-400 hover:text-white' }} text-left">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
                    </svg>
                    <span>My Karya Gue</span>
                </a>

                <a href="{{ url('/siswa/upload') }}"
                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 {{ request()->is('siswa/upload*') ? 'bg-blue-600 text-white font-semibold shadow-sm' : 'hover:bg-gray-800 text-gray-400 hover:text-white' }} text-left">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.293a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                    <span>Kirim Project</span>
                </a>
            </nav>
            <div class="border-t border-gray-700 px-6 py-4">
                <button type="button" onclick="openLogoutModal()"
                    class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold cursor-pointer">
                    Logout
                </button>
            </div>
        </div>

        {{-- ================= KONTEN (Diizinkan Scroll Vertikal) ================= --}}
        <div class="flex-1 flex flex-col overflow-y-auto">
            @yield('content')
        </div>
    </div>

    {{-- ================= MODAL LOGOUT ================= --}}
    <div id="logoutModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 overflow-hidden transform transition-all">
            <div class="p-6 text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </div>

                <h3 class="text-xl font-bold text-gray-900 mb-3">Logout?</h3>

                <p class="text-gray-600 text-sm leading-relaxed mb-6">
                    Kamu mau logout?<br>
                    Udah kirim karya belom??<br><br>
                    Kalau belom kirim dulu,<br>
                    kalau sudah mantapp siip kawann...
                </p>

                <div class="flex gap-3">
                    <button type="button" onclick="closeLogoutModal()"
                        class="flex-1 px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-xs font-medium transition leading-snug">
                        Tidak
                    </button>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit"
                            class="w-full px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-xs font-medium transition leading-snug">
                            Yaa
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openLogoutModal() {
            const modal = document.getElementById('logoutModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeLogoutModal() {
            const modal = document.getElementById('logoutModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        document.getElementById('logoutModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeLogoutModal();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLogoutModal();
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>Dashboard - Student Dashboard Karya PPLG</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </head>
  <body class="bg-gray-100">
    <div class="flex h-screen bg-gray-100">
      
      <div class="w-64 bg-gray-900 text-white shadow-lg flex flex-col">
        <div class="p-6 border-b border-gray-700">
          <div class="flex items-center gap-3">
          @if(Auth::user()->avatar)
    <img
        src="{{ Auth::user()->avatar }}"
        alt="Foto Profil"
        class="w-10 h-10 rounded-full object-cover">
@else
    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
        {{ strtoupper(substr(Auth::user()->name,0,1)) }}
    </div>
@endif
            <div>
              <p class="font-bold text-sm">{{ Auth::user()->name }}</p>
            </div>
          </div>
        </div>

        <nav class="mt-6 flex-1">
          <a href="{{ url('/siswa/dashboard')}}" class="w-full flex items-center gap-3 px-6 py-3 bg-blue-600 text-white border-l-4 border-blue-500 transition">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
            </svg>
            <span>Dashboard</span>
          </a>

          <a href="{{ url('/siswa/karya')}}" class="w-full flex items-center gap-3 px-6 py-3 hover:bg-gray-800 text-gray-400 hover:text-white transition text-left">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
            </svg>
            <span>Karya Ku</span>
          </a>

          <a href="{{ url('/siswa/upload')}}" class="w-full flex items-center gap-3 px-6 py-3 hover:bg-gray-800 text-gray-400 hover:text-white transition text-left">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.293a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
            <span>Upload Project</span>
          </a>
        </nav>

        <div class="border-t border-gray-700 px-6 py-4">
          <form id="logout-form" action="/logout" method="POST" class="hidden">
            @csrf
          </form>
          <button type="button" onclick="handleLogout()" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold cursor-pointer">
            Logout
          </button>
        </div>
      </div>

      <div class="flex-1 flex flex-col overflow-hidden">
        
        <header class="bg-white shadow-sm z-10">
          <div class="px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Student Dashboard</h1>
           
          </div>
        </header>

        <div class="flex-1 overflow-auto p-8 space-y-6 relative">
          
          <div id="loading-content" class="absolute inset-0 bg-gray-100 z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out m-0!">
            <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-full shadow-sm border border-gray-200">
              <div class="w-5 h-5 border-3 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
              <p class="text-gray-700 font-medium text-sm tracking-wide">Memuat halaman dashboard...</p>
            </div>
          </div>

          <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow p-8 text-white">
           <h2 class="text-3xl font-bold mb-2">Selamat Datang, {{ explode(' ', Auth::user()->name)[0] }}! 👋</h2>
            <p class="text-blue-100">Kelola dan upload karya PPLG mu dengan mudah</p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow p-6">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-600 text-sm font-medium">Total Karya</p>
                  <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalProject }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center font-bold text-blue-600">📊</div>
              </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-600 text-sm font-medium">Karya Disetujui</p>
                  <p class="text-3xl font-bold text-green-600 mt-2">{{ $approved }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center font-bold text-green-600">✓</div>
              </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-600 text-sm font-medium">Menunggu Review</p>
                  <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $pending }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center font-bold text-yellow-600">⏳</div>
              </div>
            </div>
          </div>

          <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Aksi Cepat</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <a href="#" class="flex items-center gap-3 p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition border border-blue-200">
                <div class="text-left">
                  <p class="font-semibold text-gray-900">Upload Project Baru</p>
                  <p class="text-sm text-gray-600">Mulai upload karya terbaru mu</p>
                </div>
              </a>

              <a href="#" class="flex items-center gap-3 p-4 bg-green-50 hover:bg-green-100 rounded-lg transition border border-green-200">
                <div class="text-left">
                  <p class="font-semibold text-gray-900">Lihat Karya Ku</p>
                  <p class="text-sm text-gray-600">Cek status semua karya yang sudah diupload</p>
                </div>
              </a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <script>
      // SCRIPT LOADING SCREEN
      window.addEventListener('load', function() {
        const loadingContent = document.getElementById('loading-content');
        
        setTimeout(() => {
          loadingContent.classList.add('opacity-0');
          
          setTimeout(() => {
            loadingContent.classList.add('hidden');
          }, 300); // Sinkron dengan efek durasi fade-out Tailwind
        }, 1000);
      });

      // SCRIPT HANDLING LOGOUT SISTEM LARAVEL
      function handleLogout() {
        if (confirm('Anda yakin ingin logout?')) {
          // Menjalankan/submit form tersembunyi yang membawa token @csrf ke route logout Laravel
          document.getElementById('logout-form').submit();
        }
      }
    </script>
  </body>
</html>
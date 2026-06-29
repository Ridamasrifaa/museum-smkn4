<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>Karya Saya - Student Dashboard Karya PPLG</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  </head>
  <body class="bg-gray-100">
    <div class="flex h-screen bg-gray-100">
      
      <div class="w-64 bg-gray-900 text-white shadow-lg flex flex-col">
        <div class="p-6 border-b border-gray-700">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center font-bold text-lg">O</div>
            <div>
              <p class="font-bold text-sm">Oktavia Ayu W</p>
              <p class="text-xs text-gray-400">XII RPL 1</p>
            </div>
          </div>
        </div>

        <nav class="mt-6 flex-1">
          <a href="{{ url('/siswa/dashboard')}}" class="w-full flex items-center gap-3 px-6 py-3 hover:bg-gray-800 text-gray-400 hover:text-white transition text-left">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
            </svg>
            <span>Dashboard</span>
          </a>

          <a href="{{ url('/siswa/karya')}}" class="w-full flex items-center gap-3 px-6 py-3 bg-blue-600 text-white border-l-4 border-blue-500 transition">
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

      <div class="flex-1 overflow-auto flex flex-col">
        <header class="bg-white shadow-sm z-10">
          <div class="px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Karya Saya</h1>
            <div class="flex items-center gap-4">
              <div class="text-right">
                <p class="font-semibold text-gray-900">Oktavia Ayu W</p>
              </div>
              <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">O</div>
            </div>
          </div>
        </header>

        <div class="flex-1 overflow-auto p-8 relative">
          <div id="loading-content" class="absolute inset-0 bg-gray-100 z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out m-0!">
            <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-full shadow-sm border border-gray-200">
              <div class="w-5 h-5 border-3 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
              <p class="text-gray-700 font-medium text-sm tracking-wide">Memuat daftar karya...</p>
            </div>
          </div>

          <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
              <h2 class="text-xl font-bold text-gray-900">Karya Saya</h2>
              <p class="text-sm text-gray-500 mt-1">Kelola dan pantau status karya yang telah diupload</p>
            </div>

            <div class="overflow-x-auto">
              <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Judul Karya</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Tanggal Upload</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Aksi</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                  <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">Game Android Tebak Kata</td>
                    <td class="px-6 py-4"><span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">Game</span></td>
                    <td class="px-6 py-4"><span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">Menunggu</span></td>
                    <td class="px-6 py-4 text-sm text-gray-600">20 Juni 2024</td>
                    <td class="px-6 py-4">
                      <a href="{{ url('/siswa/karya/detail')}}" class="text-blue-600 hover:text-blue-800 text-sm font-medium inline-block">Lihat</a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      // SCRIPT LOADING SCREEN
      window.addEventListener("load", function () {
        const loadingContent = document.getElementById("loading-content");

        setTimeout(() => {
          loadingContent.classList.add("opacity-0");

          setTimeout(() => {
            loadingContent.classList.add("hidden");
          }, 300); // Sinkron dengan durasi efek fade-out Tailwind
        }, 1000);
      });

      // SCRIPT LOGOUT HANDLING
      function handleLogout() {
        if (confirm('Anda yakin ingin logout?')) {
          document.getElementById('logout-form').submit();
        }
      }
    </script>
  </body>
</html>
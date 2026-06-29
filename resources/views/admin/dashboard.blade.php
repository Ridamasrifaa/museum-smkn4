<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - Karya PPLG</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="../assets/css/admin/style.css">
  </head>
  <body class="bg-gray-100">
    <div class="flex h-screen bg-gray-100">
      
      <div class="w-64 custom-nav-bg text-white shadow-lg flex flex-col justify-between">
        <div>
          <div class="p-6 border-b border-gray-700">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center font-bold text-lg">A <img src="" alt=""></div>
              <div>
                <p class="font-bold">Admin</p>
                <p class="text-xs text-gray-400">PPLG</p>
              </div>
            </div>
          </div>
          <nav class="mt-6 space-y-1">
            <a href="dashboard.html" class="flex items-center gap-3 px-6 py-3  nav-link-idle nav-link-active">
              <span>Dashboard</span>
            </a>
            <a href="karya.html" class="flex items-center gap-3 px-6 py-3 nav-link-idle:hover text-gray-300 transition">
              <span>Data Karya</span>
            </a>
            <a href="siswa.html" class="flex items-center gap-3 px-6 py-3 nav-link-idle:hover text-gray-300 transition">
              <span>Data Siswa</span>
            </a>
            <a href="kategori.html" class="flex items-center gap-3 px-6 py-3 nav-link-idle:hover text-gray-300 transition">
              <span>Kategori</span>
            </a>
          </nav>
        </div>
        <div class="p-6 border-t border-gray-700">
          <button class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">Logout</button>
        </div>
      </div>

      <div class="flex-1 flex flex-col overflow-hidden">
        <header class="bg-white shadow-sm z-10">
          <div class="px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Dashboard Admin</h1>
            <div class="flex items-center gap-4">
              <div class="text-right">
                <p class="font-semibold text-gray-900">Admin</p>
                <p class="text-sm text-gray-500">Login sebagai admin</p>
              </div>
            </div>
          </div>
        </header>

        <div class="p-8 flex-1 overflow-auto">
          <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white rounded-lg shadow p-6">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-600 text-sm font-medium">Total Karya</p>
                  <p class="text-3xl font-bold text-gray-900 mt-2">245</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 font-bold">📊</div>
              </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-600 text-sm font-medium">Karya Menunggu</p>
                  <p class="text-3xl font-bold text-yellow-600 mt-2">12</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center text-yellow-600 font-bold">⏳</div>
              </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-600 text-sm font-medium">Karya Disetujui</p>
                  <p class="text-3xl font-bold text-green-600 mt-2">198</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center text-green-600 font-bold">✅</div>
              </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-gray-600 text-sm font-medium">Total Siswa</p>
                  <p class="text-3xl font-bold text-purple-600 mt-2">156</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600 font-bold">👥</div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </body>
</html>
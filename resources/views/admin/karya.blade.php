<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>Manajemen Data Karya - Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/admin/style.css') }}" />
</head>
<body class="bg-gray-100">

    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="w-64 custom-nav-bg text-white shadow-lg flex flex-col justify-between">
            <div>
                <div class="p-6 border-b border-gray-700">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center font-bold text-lg">A</div>
                        <div>
                            <p class="font-bold">Museum Karya Smkn 4</p>
                            <!-- <p class="text-xs text-gray-400">PPLG</p> -->
                        </div>
                    </div>
                </div>
                <nav class="mt-6 space-y-1">
                    <a href="{{ url('/admin/dashboard')}}" class="flex items-center gap-3 px-6 py-3 text-gray-300 hover:bg-gray-800 transition"><span>Dashboard</span></a>
                    <a href="{{ url('/admin/karya')}}" class="flex items-center gap-3 px-6 py-3 bg-blue-600 text-white transition"><span>Data Karya</span></a>
                    <a href="{{ url('/admin/siswa')}}" class="flex items-center gap-3 px-6 py-3 text-gray-300 hover:bg-gray-800 transition"><span>Data Siswa</span></a>
                    <a href="{{ url('/admin/kategori')}}" class="flex items-center gap-3 px-6 py-3 text-gray-300 hover:bg-gray-800 transition"><span>Kategori</span></a>
                    <a href="{{ url('/admin/manajemen-admin')}}" class="flex items-center gap-3 px-6 py-3 nav-link-idle:hover text-gray-300 transition"><span>Manajemen Admin</span></a>
                    <a href="{{ url('/admin/artikel')}}" class="flex items-center gap-3 px-6 py-3 nav-link-idle:hover text-gray-300 transition"><span>Manajemen Artikel</span></a>
                </nav>
            </div>
            <div class="p-6 border-t border-gray-700">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                <button type="button" onclick="handleLogout()" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">Logout</button>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow-sm z-10">
                <div class="px-8 py-4 flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Manajemen Data Karya</h1>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-gray-500">Login sebagai admin</p>
                    </div>
                </div>
            </header>

            <!-- Menggunakan class 'relative' agar overlay spinner menutup area ini dengan sempurna -->
            <div class="p-8 flex-1 overflow-auto relative">
                
                <!-- SPINNER OVERLAY (Sesuai Versi Anda) -->
                <div id="loading-content" class="absolute inset-0 bg-gray-100 z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
                    <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-full shadow-sm border border-gray-200">
                        <div class="w-5 h-5 border-3 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
                        <p class="text-gray-700 font-medium text-sm tracking-wide">Memuat data karya...</p>
                    </div>
                </div>

                <!-- Form Pencarian -->
                <div class="bg-white mb-6 rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Cari Karya</h2>
                    <form action="{{ url('/admin/karya') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul atau nama siswa..." class="flex-1 px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600 text-sm">
                        <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700">Cari</button>
                        <a href="{{ url('/admin/karya') }}" class="px-6 py-2.5 bg-blue-700 text-white rounded-lg font-semibold hover:bg-blue-700">Reset</a>
                    </form>
                </div>

                <!-- KARTU KONTEN -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-900">Daftar Karya</h2>
                    </div>

                    <div class="overflow-x-auto overflow-y-auto max-h-[500px]">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Judul</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Siswa</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($projects as $project)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 font-semibold text-gray-900 text-sm">{{ $project->title }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $project->user->name }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">{{ $project->category->name }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                            {{ $project->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 
                                               ($project->status == 'approved' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') }}">
                                            {{ $project->status == 'pending' ? 'Menunggu' : ($project->status == 'approved' ? 'Disetujui' : 'Ditolak') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ url('/admin/karya/'.$project->id) }}" class="text-blue-600 hover:underline text-sm font-semibold">Detail</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-12 text-gray-500">Belum ada karya ditemukan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $projects->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/admin/dashboard.js')}}"></script>
</body>
</html>
@extends('layouts.siswa')

@section('title', 'Dashboard')

@section('content')
    <header class="bg-white shadow-sm z-10">
        <div class="px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Student Dashboard</h1>
        </div>
    </header>

    <div class="flex-1 overflow-auto p-8 space-y-6 relative">
        {{-- Loading screen --}}
        <div id="loading-content" class="absolute inset-0 bg-gray-100 z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
            <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-full shadow-sm border border-gray-200">
                <div class="w-5 h-5 border-3 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
                <p class="text-gray-700 font-medium text-sm tracking-wide">Memuat halaman dashboard...</p>
            </div>
        </div>

        {{-- Welcome --}}
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow p-8 text-white">
            <h2 class="text-3xl font-bold mb-2">Selamat Datang, {{ explode(' ', Auth::user()->name)[0] }}! 👋</h2>
            <p class="text-blue-100">Kelola dan kirim karyamu dengan mudah</p>
        </div>

        {{-- Stats (3 Card) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Card 1: Total Karya --}}
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Karya</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalProject ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl">
                        📊
                    </div>
                </div>
            </div>

            {{-- Card 2: Karya Disetujui --}}
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Karya Disetujui</p>
                        <p class="text-3xl font-bold text-green-600 mt-2">{{ $approvedProject ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center text-lg font-bold">
                        ✓
                    </div>
                </div>
            </div>

            {{-- Card 3: Menunggu Review --}}
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Menunggu Review</p>
                        <p class="text-3xl font-bold text-amber-500 mt-2">{{ $pendingProject ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-amber-50 text-amber-500 rounded-xl flex items-center justify-center text-xl">
                        ⏳
                    </div>
                </div>
            </div>
        </div>

        {{-- Aksi Cepat --}}
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Aksi Cepat</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="{{ url('/siswa/upload') }}" class="block p-5 bg-blue-50/50 hover:bg-blue-50 rounded-xl border border-blue-100 transition">
                    <p class="font-bold text-gray-900">Upload Project Baru</p>
                    <p class="text-sm text-gray-500 mt-1">Mulai upload karya terbaru mu</p>
                </a>
                <a href="{{ url('/siswa/karya') }}" class="block p-5 bg-emerald-50/40 hover:bg-emerald-50/70 rounded-xl border border-emerald-100 transition">
                    <p class="font-bold text-gray-900">Lihat Karya Ku</p>
                    <p class="text-sm text-gray-500 mt-1">Cek status semua karya yang sudah diupload</p>
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    window.addEventListener('load', function() {
        const loadingContent = document.getElementById('loading-content');
        setTimeout(() => {
            loadingContent.classList.add('opacity-0');
            setTimeout(() => loadingContent.classList.add('hidden'), 300);
        }, 1000);
    });
</script>
@endpush
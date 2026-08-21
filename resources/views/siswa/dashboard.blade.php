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
            <p class="text-blue-100">Kelola dan upload karya PPLG mu dengan mudah</p>
        </div>

        {{-- Stats --}}
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
            {{-- ... stats lainnya --}}
        </div>

        {{-- Aksi Cepat --}}
        {{-- ... --}}
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
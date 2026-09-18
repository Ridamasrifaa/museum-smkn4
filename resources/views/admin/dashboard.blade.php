@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page_title', 'Dashboard Admin')

@section('content')
    <!-- Loading Screen -->
    <div id="loading-content" class="absolute inset-0 bg-[#fcfcfc]/90 z-50 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
        <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-xl border-3 border-black shadow-[4px_4px_0px_#000]">
            <div class="w-5 h-5 border-3 border-black border-t-[#ffcc00] rounded-full animate-spin"></div>
            <p class="text-gray-900 font-extrabold text-sm tracking-wide">Memuat data museum...</p>
        </div>
    </div>

    <!-- Stats Cards -->
<<<<<<< Updated upstream
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
=======
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <div class="p-6 counter-card">
>>>>>>> Stashed changes
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-xs font-black uppercase tracking-wider">Total Karya</p>
                    <p class="text-3xl font-black text-gray-900 mt-2">{{ $totalProject }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 border-2 border-black rounded-xl flex items-center justify-center text-blue-600 font-bold shadow-[2px_2px_0px_#000]">🎨</div>
            </div>
        </div>
<<<<<<< Updated upstream
        <div class="bg-white rounded-lg shadow p-6">
=======
        <div class="p-6 counter-card">
>>>>>>> Stashed changes
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-xs font-black uppercase tracking-wider">Karya Menunggu</p>
                    <p class="text-3xl font-black text-yellow-600 mt-2">{{ $pending }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 border-2 border-black rounded-xl flex items-center justify-center text-yellow-600 font-bold shadow-[2px_2px_0px_#000]">⏳</div>
            </div>
        </div>
<<<<<<< Updated upstream
        <div class="bg-white rounded-lg shadow p-6">
=======
        <div class="p-6 counter-card">
>>>>>>> Stashed changes
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-xs font-black uppercase tracking-wider">Karya Disetujui</p>
                    <p class="text-3xl font-black text-green-600 mt-2">{{ $approved }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 border-2 border-black rounded-xl flex items-center justify-center text-green-600 font-bold shadow-[2px_2px_0px_#000]">✅</div>
            </div>
        </div>
<<<<<<< Updated upstream
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Siswa</p>
                    <p class="text-3xl font-bold text-purple-600 mt-2">{{ $totalSiswa }}</p>
=======
        <div class="p-6 counter-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-xs font-black uppercase tracking-wider">Total Siswa</p>
                    <p class="text-3xl font-black text-purple-600 mt-2">{{ $totalSiswa }}</p>
>>>>>>> Stashed changes
                </div>
                <div class="w-12 h-12 bg-purple-100 border-2 border-black rounded-xl flex items-center justify-center text-purple-600 font-bold shadow-[2px_2px_0px_#000]">🎓</div>
            </div>
        </div>
    </div>
<<<<<<< Updated upstream
=======

    <!-- BAGIAN GRAFIK DISTRIBUSI KARYA PER JURUSAN -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6 sm:mt-8">
        <!-- Grafik Berdasarkan Jurusan (dinamis dari database) -->
        <div class="p-6 stats-section-card lg:col-span-2 flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-lg font-black text-gray-900">Statistik Karya per Jurusan</h3>
                        <p class="text-xs font-bold text-gray-500">Jumlah dan persentase karya dari 5 jurusan</p>
                    </div>
                </div>

                <div class="space-y-5 my-4">
                    @foreach($jurusanStats as $stat)
                        <div>
                            <div class="flex justify-between text-xs font-black text-gray-900 mb-1.5">
                                <span>{{ $stat['emoji'] }} {{ $stat['label'] }}</span>
                                <span>{{ $stat['count'] }} Karya ({{ $stat['percentage'] }}%)</span>
                            </div>
                            <div class="w-full bg-gray-100 h-4 rounded-lg border-2 border-black overflow-hidden shadow-[2px_2px_0px_#000]">
                                <div class="{{ $stat['bar'] }} h-full rounded-none border-r-2 border-black" style="width: {{ $stat['percentage'] }}%;"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Aktivitas Sistem (dinamis: karya terbaru per jurusan) -->
        <div class="p-6 stats-section-card flex flex-col justify-between">
            <div>
                <h3 class="text-lg font-black text-gray-900 mb-4">Aktivitas Sistem</h3>
                <ul class="space-y-3 text-sm font-semibold text-gray-700">
                    @foreach($jurusanStats as $stat)
                        <li class="flex items-start gap-2.5 pb-2 {{ !$loop->last ? 'border-b-2 border-dashed border-gray-200' : '' }}">
                            <span class="w-2.5 h-2.5 {{ $stat['dot'] }} rounded-full border border-black mt-1 shrink-0"></span>
                            <div>
                                <span class="block text-xs font-bold text-gray-900">{{ $stat['emoji'] }} {{ $stat['label'] }}</span>
                                @if($stat['latest'])
                                    <span class="text-xs text-gray-600">
                                        "{{ \Illuminate\Support\Str::limit($stat['latest']->title, 40) }}" — {{ $stat['latest']->getStatusLabel() }}
                                        <span class="text-gray-400">({{ $stat['latest']->created_at->diffForHumans() }})</span>
                                    </span>
                                @else
                                    <span class="text-xs text-gray-400 italic">Belum ada aktivitas.</span>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-6 pt-4 border-t-2 border-black">
                <a href="{{ url('/admin/karya') }}" class="block text-center py-2.5 bg-[#ffcc00] text-black rounded-xl btn-neubrutal text-sm">
                    Kelola Semua Karya
                </a>
            </div>
        </div>
    </div>
>>>>>>> Stashed changes
@endsection

@push('scripts')
    <script>
        window.addEventListener("load", function () {
            const loadingContent = document.getElementById("loading-content");
            const counterCards = document.querySelectorAll(".counter-card");
            const statsSectionCards = document.querySelectorAll(".stats-section-card");

            if (loadingContent) {
                setTimeout(() => {
                    loadingContent.classList.add("opacity-0");
                    setTimeout(() => {
                        loadingContent.classList.add("hidden");
                        counterCards.forEach((card, index) => setTimeout(() => card.classList.add("show"), index * 100));
                        statsSectionCards.forEach((card, index) => setTimeout(() => card.classList.add("show"), (counterCards.length * 100) + (index * 150)));
                    }, 300);
                }, 800);
            }
        });
    </script>
@endpush
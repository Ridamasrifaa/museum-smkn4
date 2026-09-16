@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page_title', 'Dashboard Admin ' . ($user->isSuperAdmin() ? 'Utama' : $user->jurusan))

@section('content')
    <!-- Loading Screen -->
    <div id="loading-content" class="absolute inset-0 bg-gray-100 z-50 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
        <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-full shadow-sm border border-gray-200">
            <div class="w-5 h-5 border-3 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
            <p class="text-gray-700 font-medium text-sm tracking-wide">Memuat data...</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Karya</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalProject }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 font-bold">📊</div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Karya Menunggu</p>
                    <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $pending }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center text-yellow-600 font-bold">⏳</div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Karya Disetujui</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $approved }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center text-green-600 font-bold">✅</div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Siswa ({{ $user->jurusan ?? 'Semua' }})</p>
                    <p class="text-3xl font-bold text-purple-600 mt-2">{{ $totalSiswa }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600 font-bold">👥</div>
            </div>
        </div>
    </div>

    <!-- Overview Section (2 Kolom) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <!-- Kolom Kiri: Perlu Moderasi Cepat -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4 border-b pb-3 border-gray-100">
                <h3 class="text-lg font-bold text-gray-900">Perlu Moderasi Cepat</h3>
                <a href="{{ url('/admin/karya') }}" class="text-xs text-blue-600 hover:underline font-semibold">Lihat Semua</a>
            </div>

            <div class="space-y-3">
                @forelse($pendingProjects as $item)
                    <div class="p-3 bg-gray-50 rounded-lg flex items-center justify-between border border-gray-100">
                        <div>
                            <h4 class="font-semibold text-gray-900 text-sm">{{ $item->title }}</h4>
                            <p class="text-xs text-gray-500">Oleh: {{ $item->user->name ?? 'Siswa' }} • <span class="text-blue-600 font-medium">{{ $item->jurusan }}</span></p>
                        </div>
                        <a href="{{ url('/admin/karya/' . $item->id) }}" class="px-3 py-1.5 bg-blue-600 text-white rounded-md text-xs font-semibold hover:bg-blue-700 transition">
                            Tinjau
                        </a>
                    </div>
                @empty
                    <div class="text-center py-6 text-gray-400 text-sm">
                        🎉 Tidak ada karya baru yang menunggu peninjauan.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Kolom Kanan: Karya Terbaru Disetujui -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4 border-b pb-3 border-gray-100">
                <h3 class="text-lg font-bold text-gray-900">Karya Terbaru Disetujui</h3>
                <a href="{{ url('/admin/karya') }}" class="text-xs text-blue-600 hover:underline font-semibold">Lihat Semua</a>
            </div>

            <div class="space-y-3">
                @forelse($approvedProjects as $item)
                    <div class="p-3 bg-gray-50 rounded-lg flex items-center justify-between border border-gray-100">
                        <div>
                            <h4 class="font-semibold text-gray-900 text-sm">{{ $item->title }}</h4>
                            <p class="text-xs text-gray-500">Siswa: {{ $item->user->name ?? 'Siswa' }}</p>
                        </div>
                        <span class="px-2.5 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">
                            Disetujui
                        </span>
                    </div>
                @empty
                    <div class="text-center py-6 text-gray-400 text-sm">
                        Belum ada karya yang disetujui.
                    </div>
                @endforelse
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/admin/dashboard.js') }}"></script>
@endpush
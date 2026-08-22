@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page_title', 'Dashboard Admin')

@section('content')
    <!-- Loading Screen -->
    <div id="loading-content" class="absolute inset-0 bg-gray-100 z-50 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
        <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-full shadow-sm border border-gray-200">
            <div class="w-5 h-5 border-3 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
            <p class="text-gray-700 font-medium text-sm tracking-wide">Memuat data...</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
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
                    <p class="text-gray-600 text-sm font-medium">Total Siswa</p>
                    <p class="text-3xl font-bold text-purple-600 mt-2">{{ $totalSiswa }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600 font-bold">👥</div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/admin/dashboard.js') }}"></script>
@endpush
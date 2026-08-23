@extends('layouts.superadmin')

@section('title', 'Dashboard Super Admin')
@section('page_title', 'Dashboard Super Admin')

@section('content')

    {{-- ================= WELCOME BANNER ================= --}}
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-xl font-bold">Selamat datang, Super Admin!</h2>
        <p class="text-gray-600 mt-2">Ini adalah dashboard khusus Super Admin.</p>
    </div>

    {{-- ================= RINGKASAN / STAT CARDS ================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">

        <div class="bg-white rounded-lg shadow p-5 flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Karya</p>
                <p class="text-2xl font-bold text-gray-900">{{ $totalKarya }}</p>
            </div>
            <div class="w-11 h-11 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 font-bold">K</div>
        </div>

        <div class="bg-white rounded-lg shadow p-5 flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Siswa</p>
                <p class="text-2xl font-bold text-gray-900">{{ $totalSiswa }}</p>
            </div>
            <div class="w-11 h-11 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">S</div>
        </div>

        <div class="bg-white rounded-lg shadow p-5 flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Kode Unik</p>
                <p class="text-2xl font-bold text-gray-900">{{ $totalKodeUnik }}</p>
            </div>
            <div class="w-11 h-11 rounded-full bg-red-100 flex items-center justify-center text-red-600 font-bold">U</div>
        </div>

    </div>

    {{-- ================= 2 TABEL BERDAMPINGAN (KIRI - KANAN) ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- ===== KIRI: KARYA TERBARU DARI SISWA ===== --}}
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-900">Karya Terbaru Siswa</h3>
                <a href="{{ url('/admin/karya') }}" class="text-sm text-purple-600 font-medium hover:underline">Lihat semua</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="text-gray-500 border-b">
                            <th class="py-2 pr-3 font-medium">Judul Karya</th>
                            <th class="py-2 pr-3 font-medium">Siswa</th>
                            <th class="py-2 pr-3 font-medium">Jurusan</th>
                            <th class="py-2 pr-3 font-medium">Status</th>
                            <th class="py-2 pr-3 font-medium">Direview Oleh</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($karyaTerbaru as $karya)
                            @php
                                $badgeClass = match($karya->status) {
                                    'approved' => 'bg-green-50 text-green-600',
                                    'rejected' => 'bg-red-50 text-red-600',
                                    'pending'  => 'bg-yellow-50 text-yellow-600',
                                    default    => 'bg-gray-100 text-gray-500',
                                };
                            @endphp
                            <tr class="border-b last:border-0 hover:bg-gray-50">
                                <td class="py-3 pr-3 font-medium text-gray-800">{{ $karya->title }}</td>
                                <td class="py-3 pr-3 text-gray-600">{{ $karya->user->name ?? '-' }}</td>
                                <td class="py-3 pr-3 text-gray-600">{{ $karya->jurusan }}</td>
                                <td class="py-3 pr-3">
                                    <span class="px-2 py-1 text-xs rounded-full font-medium {{ $badgeClass }}">
                                        {{ $karya->getStatusLabel() }}
                                    </span>
                                </td>
                                <td class="py-3 pr-3 text-gray-600">{{ $karya->reviewer->name ?? 'Belum direview' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-6 text-center text-gray-400">Belum ada karya yang diupload.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ===== KANAN: DAFTAR ADMIN & AKTIVITASNYA ===== --}}
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-900">Admin & Aktivitasnya</h3>
                <a href="{{ url('/superadmin/manajemen-admin') }}" class="text-sm text-purple-600 font-medium hover:underline">Kelola admin</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="text-gray-500 border-b">
                            <th class="py-2 pr-3 font-medium">Nama Admin</th>
                            <th class="py-2 pr-3 font-medium">Email</th>
                            <th class="py-2 pr-3 font-medium">Karya Direview</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($daftarAdmin as $admin)
                            <tr class="border-b last:border-0 hover:bg-gray-50">
                                <td class="py-3 pr-3 font-medium text-gray-800">{{ $admin->name }}</td>
                                <td class="py-3 pr-3 text-gray-600">{{ $admin->email }}</td>
                                <td class="py-3 pr-3">
                                    <span class="px-2 py-1 text-xs rounded-full bg-purple-50 text-purple-600 font-medium">
                                        {{ $admin->reviewed_projects_count }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-6 text-center text-gray-400">Belum ada data admin.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <script src="{{ asset('assets/js/superadmin/manajemen-admin.js') }}"></script>
@endpush
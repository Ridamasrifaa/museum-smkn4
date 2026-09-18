@extends('layouts.superadmin')

@section('title', 'Dashboard Super Admin')
@section('page_title', 'Dashboard Super Admin')

@section('content')

    {{-- ================= WELCOME BANNER ================= --}}
    <div class="bg-white rounded-2xl border-3 border-black shadow-[4px_4px_0px_#000] p-5 sm:p-6 mb-6">
        <h2 class="text-lg sm:text-xl font-black text-gray-900">Selamat datang, Super Admin!</h2>
        <p class="text-gray-700 font-bold mt-1 text-xs sm:text-sm">Ini adalah dashboard khusus pengawasan Super Admin.</p>
    </div>

    {{-- ================= RINGKASAN / STAT CARDS ================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-2xl border-3 border-black shadow-[4px_4px_0px_#000] p-5 flex items-center justify-between">
            <div>
                <p class="text-xs font-black text-gray-600 uppercase tracking-wide">Total Karya</p>
                <p class="text-2xl font-black text-gray-900 mt-1">{{ $totalKarya }}</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-purple-200 border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center text-black font-black">K</div>
        </div>

        <div class="bg-white rounded-2xl border-3 border-black shadow-[4px_4px_0px_#000] p-5 flex items-center justify-between">
            <div>
                <p class="text-xs font-black text-gray-600 uppercase tracking-wide">Total Siswa</p>
                <p class="text-2xl font-black text-gray-900 mt-1">{{ $totalSiswa }}</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-200 border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center text-black font-black">S</div>
        </div>

        <div class="bg-white rounded-2xl border-3 border-black shadow-[4px_4px_0px_#000] p-5 flex items-center justify-between">
            <div>
                <p class="text-xs font-black text-gray-600 uppercase tracking-wide">Kode Unik</p>
                <p class="text-2xl font-black text-gray-900 mt-1">{{ $totalKodeUnik }}</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-red-200 border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center text-black font-black">U</div>
        </div>
    </div>

    {{-- ================= 2 BAGIAN BERDAMPINGAN ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- ===== KIRI: KARYA TERBARU DARI SISWA ===== --}}
        <div class="bg-white rounded-2xl border-3 border-black shadow-[4px_4px_0px_#000] p-4 sm:p-6">
            <div class="flex justify-between items-center mb-4 pb-3 border-b-2 border-black">
                <h3 class="text-sm sm:text-base font-black text-gray-900">Karya Terbaru Siswa</h3>
                <a href="{{ url('/admin/karya') }}" class="px-3 py-1 bg-[#ffcc00] text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] hover:translate-y-[-1px] transition">Lihat semua</a>
            </div>

            {{-- Tampilan Desktop: Tabel Biasa --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-sm text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 border-b-2 border-black text-gray-900 font-black uppercase text-xs">
                            <th class="py-2.5 px-3">Judul Karya</th>
                            <th class="py-2.5 px-3">Siswa</th>
                            <th class="py-2.5 px-3">Jurusan</th>
                            <th class="py-2.5 px-3">Status</th>
                            <th class="py-2.5 px-3">Reviewer</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-gray-200">
                        @forelse($karyaTerbaru as $karya)
                            @php
                                $badgeClass = match($karya->status) {
                                    'approved' => 'bg-green-200 text-green-900',
                                    'rejected' => 'bg-red-200 text-red-900',
                                    'pending'  => 'bg-amber-200 text-amber-900',
                                    default    => 'bg-gray-200 text-gray-800',
                                };
                            @endphp
                            <tr class="hover:bg-yellow-50/50">
                                <td class="py-3 px-3 font-bold text-gray-900 max-w-[120px] truncate">{{ $karya->title }}</td>
                                <td class="py-3 px-3 text-gray-700 font-medium">{{ $karya->user->name ?? '-' }}</td>
                                <td class="py-3 px-3 text-gray-700 font-medium">{{ $karya->jurusan }}</td>
                                <td class="py-3 px-3">
                                    <span class="px-2 py-0.5 text-[10px] rounded-lg font-black border-2 border-black shadow-[2px_2px_0px_#000] inline-block {{ $badgeClass }}">
                                        {{ $karya->getStatusLabel() }}
                                    </span>
                                </td>
                                <td class="py-3 px-3 text-gray-700 font-medium">{{ $karya->reviewer->name ?? 'Belum' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-6 text-center text-gray-500 font-bold">Belum ada karya.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Tampilan Mobile: Card Vertikal (Tanpa Scroll Samping) --}}
            <div class="md:hidden space-y-3">
                @forelse($karyaTerbaru as $karya)
                    @php
                        $badgeClass = match($karya->status) {
                            'approved' => 'bg-green-200 text-green-900',
                            'rejected' => 'bg-red-200 text-red-900',
                            'pending'  => 'bg-amber-200 text-amber-900',
                            default    => 'bg-gray-200 text-gray-800',
                        };
                    @endphp
                    <div class="p-3 bg-gray-50 border-2 border-black rounded-xl shadow-[2px_2px_0px_#000]">
                        <div class="flex justify-between items-start gap-2 mb-1">
                            <h4 class="font-black text-sm text-gray-900">{{ $karya->title }}</h4>
                            <span class="px-2 py-0.5 text-[10px] rounded-md font-black border border-black {{ $badgeClass }}">
                                {{ $karya->getStatusLabel() }}
                            </span>
                        </div>
                        <div class="text-xs text-gray-700 space-y-0.5 font-medium">
                            <p>Siswa: <span class="font-bold text-gray-900">{{ $karya->user->name ?? '-' }}</span> ({{ $karya->jurusan }})</p>
                            <p>Reviewer: <span class="font-bold text-gray-900">{{ $karya->reviewer->name ?? 'Belum' }}</span></p>
                        </div>
                    </div>
                @empty
                    <p class="py-4 text-center text-gray-500 font-bold text-sm">Belum ada karya yang diupload.</p>
                @endforelse
            </div>
        </div>

        {{-- ===== KANAN: DAFTAR ADMIN & AKTIVITASNYA ===== --}}
        <div class="bg-white rounded-2xl border-3 border-black shadow-[4px_4px_0px_#000] p-4 sm:p-6">
            <div class="flex justify-between items-center mb-4 pb-3 border-b-2 border-black">
                <h3 class="text-sm sm:text-base font-black text-gray-900">Admin & Aktivitasnya</h3>
                <a href="{{ url('/superadmin/manajemen-admin') }}" class="px-3 py-1 bg-[#ffcc00] text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] hover:translate-y-[-1px] transition">Kelola admin</a>
            </div>

            {{-- Tampilan Desktop: Tabel Biasa --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-sm text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 border-b-2 border-black text-gray-900 font-black uppercase text-xs">
                            <th class="py-2.5 px-3">Nama Admin</th>
                            <th class="py-2.5 px-3">Email</th>
                            <th class="py-2.5 px-3 text-center">Review</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-gray-200">
                        @forelse($daftarAdmin as $admin)
                            <tr class="hover:bg-yellow-50/50">
                                <td class="py-3 px-3 font-bold text-gray-900">{{ $admin->name }}</td>
                                <td class="py-3 px-3 text-gray-700 font-medium">{{ $admin->email }}</td>
                                <td class="py-3 px-3 text-center">
                                    <span class="px-2.5 py-0.5 text-xs rounded-lg bg-purple-200 text-purple-900 border-2 border-black font-black shadow-[2px_2px_0px_#000] inline-block">
                                        {{ $admin->reviewed_projects_count }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-6 text-center text-gray-500 font-bold">Belum ada data admin.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Tampilan Mobile: Card Vertikal --}}
            <div class="md:hidden space-y-3">
                @forelse($daftarAdmin as $admin)
                    <div class="p-3 bg-gray-50 border-2 border-black rounded-xl shadow-[2px_2px_0px_#000] flex justify-between items-center">
                        <div>
                            <h4 class="font-black text-sm text-gray-900">{{ $admin->name }}</h4>
                            <p class="text-xs text-gray-600 font-medium">{{ $admin->email }}</p>
                        </div>
                        <div class="text-right">
                            <span class="px-2 py-0.5 text-xs rounded-lg bg-purple-200 text-purple-900 border-2 border-black font-black shadow-[2px_2px_0px_#000] inline-block">
                                {{ $admin->reviewed_projects_count }} Review
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="py-4 text-center text-gray-500 font-bold text-sm">Belum ada data admin.</p>
                @endforelse
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <script src="{{ asset('assets/js/superadmin/manajemen-admin.js') }}"></script>
@endpush
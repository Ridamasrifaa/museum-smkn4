@extends('layouts.siswa')

@section('title', 'Profil Saya')

@section('content')
<div class="flex-1 p-6 md:p-10 overflow-y-auto">

    <h1 class="text-2xl font-bold text-gray-900 mb-6">Profil Saya</h1>

    <section class="max-w-4xl mx-auto bg-white rounded-xl shadow-sm p-6 md:p-10">

        {{-- Bagian Atas: Foto & Nama --}}
        <div class="flex flex-col items-center text-center">
            <div class="p-1 rounded-full" style="background: linear-gradient(135deg, #2563eb, #1e40af);">
                @if ($user->avatar)
                    <img src="{{ $user->avatar }}" alt="Foto Profil {{ $user->name }}"
                        class="w-28 h-28 md:w-32 md:h-32 rounded-full object-cover border-4 border-white">
                @else
                    <div class="w-28 h-28 md:w-32 md:h-32 rounded-full border-4 border-white bg-blue-600 flex items-center justify-center text-white font-bold text-4xl">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
            </div>

            <h2 class="mt-4 text-xl md:text-2xl font-bold text-gray-900">
                {{ $user->name }}
            </h2>

            {{-- Bagian Tengah: Biodata (SUDAH DIPERBAIKI) --}}
            <div class="mt-2 flex flex-wrap items-center justify-center gap-x-3 gap-y-1 text-sm text-gray-500">
                <span>{{ $user->kelas ?? '-' }}</span>
                <span class="text-gray-300">•</span>
                <span>{{ $user->jurusan ?? '-' }}</span>
                <span class="text-gray-300">•</span>
                <span>Angkatan {{ $user->angkatan ?? '-' }}</span>
            </div>

            {{-- Tombol Edit Profil --}}
            <a href="{{ route('siswa.profil.edit') }}"
               class="mt-5 inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm hover:shadow transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                Edit Profil
            </a>
        </div>

        <div class="mt-8 mb-6 border-t border-gray-100"></div>

        {{-- Bagian Bawah: Karya Siswa (SUDAH DIPERBAIKI) --}}
        <div>
            <h3 class="font-semibold text-lg text-gray-900 mb-4">
                My Karya Gue 
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse ($projects as $project)
                    <article class="group bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                        <div class="h-36 flex items-center justify-center bg-blue-50">
                            @if ($project->file_path)
                                <img src="{{ asset('storage/' . $project->file_path) }}" 
                                     alt="{{ $project->title }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <svg class="w-10 h-10 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            @endif
                        </div>
                        <div class="p-4">
                            <div class="flex items-start justify-between gap-2">
                                <h4 class="font-medium text-gray-900 text-sm leading-snug">
                                    {{ $project->title }}
                                </h4>
                                @if($project->status == 'approved')
                                    <span class="shrink-0 text-[11px] font-medium bg-green-50 text-green-600 px-2 py-0.5 rounded-full">Disetujui</span>
                                @elseif($project->status == 'pending')
                                    <span class="shrink-0 text-[11px] font-medium bg-amber-50 text-amber-600 px-2 py-0.5 rounded-full">Menunggu</span>
                                @else
                                    <span class="shrink-0 text-[11px] font-medium bg-red-50 text-red-600 px-2 py-0.5 rounded-full">Ditolak</span>
                                @endif
                            </div>
                            <p class="mt-1 text-xs text-gray-400">{{ $project->jurusan ?? '-' }}</p>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center text-gray-400 text-sm py-8">
                        Belum ada karya yang diupload.
                    </div>
                @endforelse
            </div>
        </div>

    </section>
</div>
@endsection
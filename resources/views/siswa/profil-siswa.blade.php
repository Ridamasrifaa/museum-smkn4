<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Museum Karya</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

<div class="flex min-h-screen bg-gray-50">

    {{-- ======================================================= --}}
    {{-- SIDEBAR --}}
    {{-- ======================================================= --}}
    <div class="w-64 bg-gray-900 text-white shadow-lg flex flex-col">
        <div class="p-6 border-b border-gray-700">
            <div class="flex items-center gap-3">
                @if (Auth::user()->avatar)
                    <img src="{{ Auth::user()->avatar }}" alt="Foto Profil"
                        class="w-10 h-10 rounded-full object-cover">
                @else
                    <div
                        class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <p class="font-bold text-sm">{{ Auth::user()->name }}</p>
                </div>
            </div>
        </div>

        <nav class="mt-6 flex-1">
            <a href="{{ url('/siswa/dashboard') }}"
                class="w-full flex items-center gap-3 px-6 py-3 hover:bg-gray-800 text-gray-400 hover:text-white transition text-left">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ url('/siswa/profil') }}" class="w-full flex items-center gap-3 px-6 py-3 hover:bg-gray-800 text-gray-400 hover:text-white transition text-left">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                </svg>
                <span>profil</span>
            </a>

            <a href="{{ url('/siswa/karya') }}"
                class="w-full flex items-center gap-3 px-6 py-3 hover:bg-gray-800 text-gray-400 border-l-4 border-blue-500 transition">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
                </svg>
                <span>My karya</span>
            </a>

            <a href="{{ url('/siswa/upload') }}"
                class="w-full flex items-center gap-3 px-6 py-3 bg-blue-600 text-white hover:text-white transition text-left">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.293a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
                <span>Submit Project</span>
            </a>
        </nav>

        <div class="border-t border-gray-700 px-6 py-4">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
            <button type="button" onclick="handleLogout()"
                class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold cursor-pointer">Logout</button>
        </div>
    </div>

    {{-- ======================================================= --}}
    {{-- KONTEN UTAMA: HALAMAN PROFIL SISWA --}}
    {{-- ======================================================= --}}
    <div class="flex-1 p-6 md:p-10">

        <h1 class="text-2xl font-bold text-gray-900 mb-6">Profil Saya</h1>

        <section class="max-w-4xl mx-auto bg-white rounded-xl shadow-sm p-6 md:p-10">

            {{-- Bagian Atas: Foto & Nama --}}
            <div class="flex flex-col items-center text-center">
                <div class="p-1 rounded-full" style="background: linear-gradient(135deg, #2563eb, #1e40af);">
                    @if (Auth::user()->avatar)
                        <img src="{{ Auth::user()->avatar }}" alt="Foto Profil {{ Auth::user()->name }}"
                            class="w-28 h-28 md:w-32 md:h-32 rounded-full object-cover border-4 border-white">
                    @else
                        <div
                            class="w-28 h-28 md:w-32 md:h-32 rounded-full border-4 border-white bg-blue-600 flex items-center justify-center text-white font-bold text-4xl">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                </div>

                <h2 class="mt-4 text-xl md:text-2xl font-bold text-gray-900">
                    {{ Auth::user()->name }}
                </h2>

                {{-- Bagian Tengah: Biodata --}}
                <div class="mt-2 flex flex-wrap items-center justify-center gap-x-3 gap-y-1 text-sm text-gray-500">
                    <span>{{ $siswa->kelas ?? '-' }}</span>
                    <span class="text-gray-300">•</span>
                    <span>{{ $siswa->nisn ?? '-' }}</span>
                    <span class="text-gray-300">•</span>
                    <span>{{ $siswa->jurusan ?? 'PPLG' }}</span>
                    <span class="text-gray-300">•</span>
                    <span>Angkatan {{ $siswa->angkatan ?? '-' }}</span>
                </div>

                {{-- Tombol Edit Profil --}}
                <a href="{{ url('/siswa/profil/edit') }}"
                   class="mt-5 inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm hover:shadow transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Edit Profil
                </a>
            </div>

            <div class="mt-8 mb-6 border-t border-gray-100"></div>

            {{-- Bagian Bawah: Karya Siswa --}}
            <div>
                <h3 class="font-semibold text-lg text-gray-900 mb-4">
                    Karya Siswa Ini
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse ($karyas ?? [] as $karya)
                        <article class="group bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                            <div class="h-36 flex items-center justify-center" style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);">
                                @if ($karya->thumbnail)
                                    <img src="{{ $karya->thumbnail }}" alt="{{ $karya->judul }}" class="w-full h-full object-cover">
                                @else
                                    <svg class="w-10 h-10 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                @endif
                            </div>
                            <div class="p-4">
                                <div class="flex items-start justify-between gap-2">
                                    <h4 class="font-medium text-gray-900 text-sm leading-snug">
                                        {{ $karya->judul }}
                                    </h4>
                                    @php
                                        $statusStyle = match($karya->status ?? 'draft') {
                                            'disetujui' => 'bg-green-50 text-green-600',
                                            'menunggu' => 'bg-amber-50 text-amber-600',
                                            default => 'bg-gray-100 text-gray-500',
                                        };
                                    @endphp
                                    <span class="shrink-0 text-[11px] font-medium {{ $statusStyle }} px-2 py-0.5 rounded-full">
                                        {{ ucfirst($karya->status ?? 'Draft') }}
                                    </span>
                                </div>
                                <p class="mt-1 text-xs text-gray-400">{{ $karya->kategori ?? '-' }}</p>
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
</div>

<script>
    function handleLogout() {
        if (confirm('Yakin ingin logout?')) {
            document.getElementById('logout-form').submit();
        }
    }
</script>

</body>
</html>
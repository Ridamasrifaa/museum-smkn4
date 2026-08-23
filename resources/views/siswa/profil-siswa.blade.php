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
                        onclick="openModal('{{ $user->avatar }}')"
                        class="w-28 h-28 md:w-32 md:h-32 rounded-full object-cover border-4 border-white cursor-pointer hover:opacity-90 transition">
                @else
                    <div class="w-28 h-28 md:w-32 md:h-32 rounded-full border-4 border-white bg-blue-600 flex items-center justify-center text-white font-bold text-4xl">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
            </div>

            <h2 class="mt-4 text-xl md:text-2xl font-bold text-gray-900">
                {{ $user->name }}
            </h2>

            <div class="mt-2 flex flex-wrap items-center justify-center gap-x-3 gap-y-1 text-sm text-gray-500">
                <span>{{ $user->kelas ?? '-' }}</span>
                <span class="text-gray-300">•</span>
                <span>{{ $user->jurusan ?? '-' }}</span>
                <span class="text-gray-300">•</span>
                <span>Angkatan {{ $user->angkatan ?? '-' }}</span>
            </div>

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

        {{-- Bagian Bawah: Karya Siswa --}}
        <div>
            <h3 class="font-semibold text-lg text-gray-900 mb-4">
                My Karya Gue
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse ($projects as $project)
                    <article class="group bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow overflow-hidden cursor-pointer"
                             onclick="openProfilModal(this)"
                             data-title="{{ $project->title }}"
                             data-desc="{{ $project->description }}"
                             data-jurusan="{{ $project->jurusan ?? '-' }}"
                             data-status="{{ $project->status }}"
                             data-tech="{{ $project->technology_stack ?? '-' }}"
                             data-live="{{ $project->live_link ?? '' }}"
                             data-file-path="{{ $project->file_path ? asset('storage/' . $project->file_path) : '' }}"
                             data-file-type="{{ $project->file_type ?? '' }}"
                             data-tahun="{{ $project->created_at->format('Y') }}">

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

{{-- Modal Lightbox Foto Profil --}}
<div id="imageModal" class="hidden fixed inset-0 bg-black/70 z-[60] flex items-center justify-center p-4" onclick="if(event.target === this) closeModal()">
    <button onclick="closeModal()" class="absolute top-5 right-5 text-white/80 hover:text-white transition">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
    <img id="modalImage" src="" alt="Foto Profil"
         class="max-w-full max-h-[85vh] rounded-lg shadow-2xl object-contain">
</div>

{{-- Modal Detail Karya --}}
<div id="profilDetailModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white rounded-t-xl">
            <h3 id="profilModalTitle" class="text-xl font-bold text-gray-900"></h3>
            <button onclick="closeProfilModal()" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="p-6 space-y-5">
            {{-- Preview --}}
            <div>
                <img id="profilModalImage" class="hidden w-full rounded-lg object-contain max-h-72" />
                <iframe id="profilModalIframe" class="hidden w-full h-64 rounded-lg border" allowfullscreen></iframe>
                <div id="profilModalEmpty" class="hidden w-full h-64 flex items-center justify-center rounded-lg bg-gray-100 text-gray-500 border border-dashed">
                    Tidak ada preview
                </div>
            </div>

            {{-- Status & Jurusan --}}
            <div class="flex gap-2 flex-wrap">
                <span id="profilModalStatus" class="px-3 py-1 rounded-full text-sm font-semibold"></span>
                <span id="profilModalJurusan" class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold"></span>
            </div>

            {{-- Deskripsi --}}
            <div>
                <h4 class="font-semibold text-gray-900 mb-1">Deskripsi</h4>
                <p id="profilModalDesc" class="text-gray-700 text-sm leading-relaxed"></p>
            </div>

            {{-- Info tambahan --}}
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 p-3 rounded-lg">
                    <p class="text-xs text-gray-500 mb-1">Tahun</p>
                    <p id="profilModalTahun" class="font-semibold text-gray-900"></p>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg">
                    <p class="text-xs text-gray-500 mb-1">Teknologi</p>
                    <p id="profilModalTech" class="font-semibold text-gray-900 text-sm"></p>
                </div>
            </div>

            {{-- Tombol Live --}}
            <div id="profilLiveWrapper" class="pt-2 hidden">
                <a id="profilLiveBtn" href="#" target="_blank"
                   class="inline-block px-5 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition text-sm">
                    Buka Live Demo
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // ================= LIGHTBOX FOTO PROFIL =================
    function openModal(imageSrc) {
        const modal = document.getElementById('imageModal');
        const modalImg = document.getElementById('modalImage');

        modalImg.src = imageSrc;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        const modal = document.getElementById('imageModal');

        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // ================= MODAL DETAIL KARYA =================
    function openProfilModal(card) {
        const title = card.dataset.title;
        const desc = card.dataset.desc;
        const jurusan = card.dataset.jurusan;
        const status = card.dataset.status;
        const tech = card.dataset.tech;
        const live = card.dataset.live;
        const filePath = card.dataset.filePath;
        const fileType = card.dataset.fileType || '';
        const tahun = card.dataset.tahun;

        // Isi data dasar
        document.getElementById('profilModalTitle').textContent = title;
        document.getElementById('profilModalDesc').textContent = desc || '-';
        document.getElementById('profilModalJurusan').textContent = jurusan;
        document.getElementById('profilModalTahun').textContent = tahun;
        document.getElementById('profilModalTech').textContent = tech;

        // Status badge
        const statusEl = document.getElementById('profilModalStatus');
        if (status === 'approved') {
            statusEl.textContent = 'Disetujui';
            statusEl.className = 'px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-700';
        } else if (status === 'pending') {
            statusEl.textContent = 'Menunggu';
            statusEl.className = 'px-3 py-1 rounded-full text-sm font-semibold bg-amber-100 text-amber-700';
        } else {
            statusEl.textContent = 'Ditolak';
            statusEl.className = 'px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-700';
        }

        // Preview
        const img = document.getElementById('profilModalImage');
        const iframe = document.getElementById('profilModalIframe');
        const empty = document.getElementById('profilModalEmpty');

        img.classList.add('hidden');
        iframe.classList.add('hidden');
        empty.classList.add('hidden');

        if (filePath && fileType.startsWith('image/')) {
            img.src = filePath;
            img.classList.remove('hidden');
        } else if (live) {
            iframe.src = live;
            iframe.classList.remove('hidden');
        } else if (filePath) {
            // Fallback: tampilkan gambar meskipun file_type tidak image
            img.src = filePath;
            img.classList.remove('hidden');
        } else {
            empty.classList.remove('hidden');
        }

        // Live button
        const liveWrapper = document.getElementById('profilLiveWrapper');
        const liveBtn = document.getElementById('profilLiveBtn');
        if (live) {
            liveBtn.href = live;
            liveWrapper.classList.remove('hidden');
        } else {
            liveWrapper.classList.add('hidden');
        }

        document.getElementById('profilDetailModal').classList.remove('hidden');
    }

    function closeProfilModal() {
        document.getElementById('profilDetailModal').classList.add('hidden');
        document.getElementById('profilModalIframe').src = '';
    }

    // Tutup modal jika klik di luar konten
    document.getElementById('profilDetailModal')?.addEventListener('click', function (e) {
        if (e.target === this) {
            closeProfilModal();
        }
    });
</script>
@endpush
@extends('layouts.siswa')

@section('title', 'Profil Saya')

@section('content')
<div class="flex-1 p-6 md:p-10 overflow-y-auto">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Profil Saya</h1>

        <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-10">
            {{-- Bagian Header Profil --}}
           <div class="w-28 h-28 sm:w-36 sm:h-36 rounded-full overflow-hidden bg-blue-600 text-white flex items-center justify-center font-bold text-4xl shadow-md shrink-0 relative">
    @if(!empty($user->avatar))
        <img src="{{ str_starts_with($user->avatar, 'http') ? $user->avatar : (str_starts_with($user->avatar, '/storage') ? asset($user->avatar) : asset('storage/' . $user->avatar)) }}" 
             alt="{{ $user->name }}" 
             onclick="openModal('{{ str_starts_with($user->avatar, 'http') ? $user->avatar : (str_starts_with($user->avatar, '/storage') ? asset($user->avatar) : asset('storage/' . $user->avatar)) }}')"
             class="w-full h-full object-cover cursor-pointer hover:opacity-90 transition absolute inset-0">
    @else
        <div class="w-full h-full flex items-center justify-center bg-gray-300 text-gray-700 text-2xl font-bold">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
    @endif
</div>

                <div class="flex-1 text-center sm:text-left">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4 mb-3">
                        <h2 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h2>
                        <span class="text-xs bg-blue-100 text-blue-600 px-3 py-1 rounded-full font-semibold self-center">
                            {{ $user->jurusan ?? 'PPLG' }}
                        </span>
                    </div>

                    <div class="flex justify-center sm:justify-start gap-8 mb-4 text-sm">
                        <div>
                            <span class="font-bold text-lg text-gray-900">{{ $projects->count() }}</span> <span class="text-gray-500">Karya</span>
                        </div>
                    </div>

                    <div class="text-sm text-gray-700 space-y-1 mb-6">
                        <p class="font-medium"> {{ $user->bio ?? 'Belum ada bio.' }}</p>
                        
                    </div>

                    <a href="{{ route('siswa.profil.edit') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-xl shadow-sm transition-all duration-200 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        Edit Profil
                    </a>
                </div>
            </div>

            {{-- Bagian Bawah: Karya Siswa dengan Tombol Like, Komentar, & Share --}}
            <div class="pt-8">
                <h3 class="text-xs uppercase tracking-widest text-gray-400 font-bold mb-6">
                    Karya yang Di-upload
                </h3>

          @if($projects->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach ($projects as $project)
            <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 flex flex-col justify-between">
                <div>
                    <div class="h-48 bg-gray-100 overflow-hidden flex items-center justify-center relative">
                        @php
                            $extension = $project->file_path ? strtolower(pathinfo($project->file_path, PATHINFO_EXTENSION)) : '';
                            $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'webp', 'gif']);
                            $isVideo = in_array($extension, ['mp4', 'webm', 'ogg', 'mov']);
                        @endphp

                        @if ($project->file_path)
                            @if ($isImage)
                                {{-- Tampilan Jika Foto/Gambar --}}
                                <img src="{{ asset('storage/' . $project->file_path) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                            @elseif ($isVideo)
                                {{-- Tampilan Jika Video --}}
                                <video class="w-full h-full object-cover" controls>
                                    <source src="{{ asset('storage/' . $project->file_path) }}" type="video/{{ $extension }}">
                                    Browser kamu tidak mendukung pemutar video.
                                </video>
                            @else
                                {{-- Tampilan Jika Web / File Lain --}}
                                <div class="flex flex-col items-center justify-center text-gray-500 p-4 text-center">
                                    <svg class="w-10 h-10 mb-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                    </svg>
                                    <span class="text-xs font-semibold text-gray-700">Preview Web / Aplikasi</span>
                                </div>
                            @endif
                        @else
                            <div class="text-xs text-gray-400">Preview Karya</div>
                        @endif
                    </div>
                    <div class="p-4">
                        <span class="text-[10px] font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded">
                            {{ $project->jurusan ?? 'PPLG' }}
                        </span>
                        <h3 class="font-semibold text-sm mt-2 truncate text-gray-900">{{ $project->title }}</h3>
                    </div>
                </div>

                {{-- Bagian Interaksi Ala Instagram (Like, Komentar, Share) --}}
                <div class="px-4 py-3 border-t border-gray-100 flex items-center justify-between text-sm">
                    <div class="flex items-center gap-4">
                        {{-- Tombol Like --}}
                        <button type="button" onclick="toggleLike({{ $project->id }})" class="flex items-center gap-1.5 text-gray-600 hover:text-red-500 transition group cursor-pointer">
                            <svg id="like-icon-{{ $project->id }}" class="w-5 h-5 transition transform group-active:scale-125 {{ $project->likes->isNotEmpty() ? 'text-red-500' : '' }}" fill="{{ $project->likes->isNotEmpty() ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span id="like-count-{{ $project->id }}" class="font-semibold text-xs">{{ $project->likes_count ?? 0 }}</span>
                        </button>

                        {{-- Tombol Komentar --}}
                        <a href="{{ route('project.detail', $project->id) }}" class="flex items-center gap-1.5 text-gray-600 hover:text-blue-500 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <span class="font-semibold text-xs">{{ $project->comments_count ?? 0 }}</span>
                        </a>
                    </div>

                    {{-- Tombol Bagikan / Share Link --}}
                    <button type="button" onclick="shareProject('{{ route('project.detail', $project->id) }}')" class="text-gray-600 hover:text-green-500 transition cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="text-center py-16 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
        <p class="text-gray-500 text-sm">Belum ada karya yang di-upload.</p>
    </div>
@endif
            </div>
        </section>
    </div>
</div>

{{-- Modal Lightbox Foto Profil --}}
<div id="imageModal" class="hidden fixed inset-0 bg-black/70 z-[60] flex items-center justify-center p-4" onclick="if(event.target === this) closeModal()">
    <button onclick="closeModal()" class="absolute top-5 right-5 text-white/80 hover:text-white transition">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
    <img id="modalImage" src="" alt="Foto Profil" class="max-w-full max-h-[85vh] rounded-lg shadow-2xl object-contain">
</div>
@endsection

@push('scripts')
<script>
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

    function toggleLike(projectId) {
        fetch(`/project/${projectId}/like`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
        })
        .then(response => {
            if (!response.ok) {
                if (response.status === 401) {
                    alert('Silakan login terlebih dahulu untuk menyukai karya!');
                }
                throw new Error('Gagal memproses like');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                const countSpan = document.getElementById(`like-count-${projectId}`);
                const likeIcon = document.getElementById(`like-icon-${projectId}`);
                
                countSpan.textContent = data.likes_count;
                
                if (data.liked) {
                    likeIcon.setAttribute('fill', 'currentColor');
                    likeIcon.classList.add('text-red-500');
                } else {
                    likeIcon.setAttribute('fill', 'none');
                    likeIcon.classList.remove('text-red-500');
                }
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function shareProject(url) {
        navigator.clipboard.writeText(url).then(() => {
            alert("Link karya berhasil disalin! Silakan bagikan ke temanmu.");
        }).catch(err => {
            console.error('Gagal menyalin:', err);
        });
    }
</script>
@endpush
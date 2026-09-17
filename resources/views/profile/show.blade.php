<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil {{ $user->name }} - Museum Karya SMKN 4 Tasikmalaya</title>
    <!-- CSRF Token untuk keamanan AJAX Laravel -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 min-h-screen">

    <header class="bg-white dark:bg-gray-900 shadow-sm border-b border-gray-200 dark:border-gray-800">
        <div class="max-w-5xl mx-auto px-6 py-4">
            <a href="{{ url('/') }}" class="text-sm font-semibold text-blue-600 hover:underline">
                ← Kembali ke Beranda
            </a>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-6 py-10">
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
                <div class="flex flex-col sm:flex-row sm:items-center gap-4 mb-4">
                    <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
                    <span class="text-xs bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 px-3 py-1 rounded-full font-semibold self-center">
                        {{ $user->jurusan ?? 'PPLG' }}
                    </span>
                </div>

                <div class="flex justify-center sm:justify-start gap-8 mb-4 text-sm">
                    <div>
                        <span class="font-bold text-lg">{{ $user->projects->count() }}</span> <span class="text-gray-500">Karya</span>
                    </div>
                </div>

                <div class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                    <p class="font-medium"> {{ $user->bio ?? 'Belum ada bio.' }}</p>
                    
                </div>
            </div>
        </div>

        {{-- Grid Karya --}}
        <div class="py-8">
            <h2 class="text-xs uppercase tracking-widest text-gray-400 font-bold mb-6">Karya yang Di-upload</h2>

            @if($user->projects->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach($user->projects as $project)
                        <div class="bg-white dark:bg-gray-900 rounded-xl overflow-hidden shadow-sm border border-gray-100 dark:border-gray-800 flex flex-col justify-between">
                            <div>
                                <div class="h-48 bg-gray-100 dark:bg-gray-800 overflow-hidden">
                                    @if(isset($project->file_path) && str_starts_with($project->file_type ?? '', 'image/'))
                                        <img src="{{ asset('storage/' . $project->file_path) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="flex items-center justify-center h-full text-xs text-gray-400">Preview Karya</div>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <span class="text-[10px] font-bold text-blue-600 bg-blue-50 dark:bg-blue-950 px-2 py-0.5 rounded">
                                        {{ $project->jurusan ?? 'PPLG' }}
                                    </span>
                                    <h3 class="font-semibold text-sm mt-2 truncate">{{ $project->title }}</h3>
                                </div>
                            </div>

                            {{-- Bagian Interaksi Ala Instagram (Like, Komentar, Share) --}}
                            <div class="px-4 py-3 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between text-sm">
                                <div class="flex items-center gap-4">
                                    {{-- Tombol Like --}}
                                   
<button type="button" onclick="toggleLike({{ $project->id }})" class="flex items-center gap-1.5 text-gray-600 dark:text-gray-300 hover:text-red-500 transition group cursor-pointer">
    <svg id="like-icon-{{ $project->id }}" class="w-5 h-5 transition transform group-active:scale-125 {{ $project->likes->isNotEmpty() ? 'text-red-500' : '' }}" fill="{{ $project->likes->isNotEmpty() ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
    </svg>
    <span id="like-count-{{ $project->id }}" class="font-semibold text-xs">{{ $project->likes_count ?? 0 }}</span>
</button>

                                    {{-- Tombol Komentar (Menampilkan jumlah komentar asli dari database) --}}
                                    <a href="{{ route('project.detail', $project->id) }}" class="flex items-center gap-1.5 text-gray-600 dark:text-gray-300 hover:text-blue-500 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                        <span class="font-semibold text-xs">{{ $project->comments_count ?? 0 }}</span>
                                    </a>
                                </div>

                                {{-- Tombol Bagikan / Share Link --}}
                                <button type="button" onclick="shareProject('{{ route('project.detail', $project->id) }}')" class="text-gray-600 dark:text-gray-300 hover:text-green-500 transition cursor-pointer">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 bg-white dark:bg-gray-900 rounded-2xl border border-dashed border-gray-200 dark:border-gray-800">
                    <p class="text-gray-500 text-sm">Belum ada karya yang di-upload.</p>
                </div>
            @endif
        </div>
    </main>

    {{-- Script Interaktif Like & Share --}}
    <script>
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
</body>
</html>
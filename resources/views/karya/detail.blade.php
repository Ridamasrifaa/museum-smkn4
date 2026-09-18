<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $project->title }} - Museum Karya SMKN 4 Tasikmalaya</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        #comment-modal {
            transition: opacity 0.3s ease;
        }
        #comment-sheet {
            transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .scrollbar-thin::-webkit-scrollbar {
            height: 4px;
            width: 4px;
        }
        .scrollbar-thin::-webkit-scrollbar-track {
            background: transparent;
        }
        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: rgba(156, 163, 175, 0.5);
            border-radius: 4px;
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 min-h-screen">

    <header class="bg-white dark:bg-gray-900 shadow-sm border-b border-gray-200 dark:border-gray-800 sticky top-0 z-20">
        <div class="max-w-4xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ url('/karya') }}" class="text-sm font-semibold text-blue-600 hover:underline">
                ← Kembali ke Museum Karya
            </a>
            <span class="text-xs bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 px-3 py-1 rounded-full font-semibold">
                {{ $project->jurusan ?? 'PPLG' }}
            </span>
        </div>
    </header>

    <main class="max-w-3xl mx-auto px-4 sm:px-6 py-8">
        <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">
            
            @if(isset($project->file_path) && str_starts_with($project->file_type ?? '', 'image/'))
                <div class="w-full max-h-[450px] bg-gray-100 dark:bg-gray-800 overflow-hidden flex items-center justify-center">
                    <img src="{{ asset('storage/' . $project->file_path) }}" alt="{{ $project->title }}" class="w-full h-full object-contain">
                </div>
            @endif

            <div class="p-6 sm:p-8 space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">{{ $project->title }}</h1>
                        <p class="text-xs text-gray-500">
                            Dibuat oleh: <span class="text-blue-600 font-semibold">{{ $project->user->name ?? 'Siswa' }}</span>
                        </p>
                    </div>

                    <button onclick="openCommentModal()" class="flex items-center gap-2 px-4 py-2 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-full transition text-sm font-semibold cursor-pointer">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <span id="trigger-comment-count">{{ count($project->comments ?? []) }} Komentar</span>
                    </button>
                </div>

                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-1">Tentang Project</h3>
                    <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">{{ $project->description }}</p>
                </div>
            </div>
        </div>
    </main>

    {{-- MODAL KOMENTAR & BALASAN (IG STYLE) --}}
    <div id="comment-modal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-end sm:items-center justify-center opacity-0 pointer-events-none">
        
        <div id="comment-sheet" class="w-full sm:max-w-lg bg-white dark:bg-gray-900 rounded-t-3xl sm:rounded-3xl shadow-2xl overflow-hidden flex flex-col h-[85vh] sm:h-[700px] transform translate-y-full sm:translate-y-10 sm:scale-95">
            
            <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between relative shrink-0">
                <div class="w-10 h-1 bg-gray-300 dark:bg-gray-700 rounded-full absolute top-2 left-1/2 transform -translate-x-1/2 sm:hidden"></div>
                <h3 class="font-bold text-base mx-auto sm:mx-0">Komentar</h3>
                <button onclick="closeCommentModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 p-1 cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            {{-- KONTAINER KOMENTAR UTAMA --}}
            <div class="flex-1 overflow-y-auto p-4 sm:p-6 space-y-6" id="comments-container">
                @forelse($project->comments()->whereNull('parent_id')->latest()->get() as $comment)
                    <div class="space-y-3 comment-item" data-id="{{ $comment->id }}">
                        
                        {{-- Komentar Utama (Level 0) --}}
                        <div class="flex items-start gap-3 text-sm">
                            <div class="w-9 h-9 rounded-full overflow-hidden bg-blue-600 text-white flex items-center justify-center font-bold text-xs shrink-0 relative">
                                @if(!empty($comment->user->avatar))
                                    <img src="{{ str_starts_with($comment->user->avatar, 'http') ? $comment->user->avatar : (str_starts_with($comment->user->avatar, '/storage') ? asset($comment->user->avatar) : asset('storage/' . $comment->user->avatar)) }}" 
                                         alt="{{ $comment->user->name ?? 'User' }}" 
                                         class="w-full h-full object-cover absolute inset-0">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-blue-600 text-white">
                                        {{ strtoupper(substr($comment->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="bg-gray-50 dark:bg-gray-800/60 p-3.5 rounded-2xl border border-gray-100 dark:border-gray-800">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="font-bold text-xs text-gray-900 dark:text-gray-100">{{ $comment->user->name ?? 'Anonim' }}</span>
                                        <span class="text-[10px] text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    @if($comment->type === 'gif')
                                        <div class="my-2 rounded-xl overflow-hidden max-w-[200px] bg-black/5 border border-gray-200 dark:border-gray-700 shadow-xs">
                                            <img src="{{ $comment->attachment }}" alt="GIF Komentar" class="w-full object-cover">
                                        </div>
                                    @else
                                        <p class="text-xs text-gray-700 dark:text-gray-300 leading-relaxed">{{ $comment->body }}</p>
                                    @endif
                                </div>
                                <div class="flex items-center gap-4 mt-1 ml-2">
                                    <button onclick="setReplyTo({{ $comment->id }}, '{{ $comment->user->name ?? 'Anonim' }}')" class="text-[11px] font-semibold text-gray-500 hover:text-blue-600 cursor-pointer">
                                        Balas
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- DAFTAR BALASAN --}}
                        @php
                            $allReplies = collect();
                            $gatherReplies = function($parent) use (&$gatherReplies, &$allReplies) {
                                foreach($parent->replies as $reply) {
                                    $allReplies->push($reply);
                                    if($reply->replies->count() > 0) {
                                        $gatherReplies($reply);
                                    }
                                }
                            };
                            $gatherReplies($comment);
                        @endphp

                        @if($allReplies->count() > 0)
                            <div class="ml-9 pl-4 border-l-2 border-gray-200 dark:border-gray-700 space-y-3">
                                <button onclick="toggleReplies({{ $comment->id }})" id="view-btn-{{ $comment->id }}" class="flex items-center gap-2 text-[11px] font-bold text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 cursor-pointer pt-1">
                                    <span id="view-text-{{ $comment->id }}">Lihat {{ $allReplies->count() }} balasan</span>
                                </button>

                                <div id="replies-{{ $comment->id }}" class="hidden space-y-3 pt-1">
                                    @foreach($allReplies as $reply)
                                        <div class="flex items-start gap-2.5 text-xs">
                                            <div class="w-7 h-7 rounded-full overflow-hidden bg-indigo-600 text-white flex items-center justify-center font-bold text-[10px] shrink-0 relative">
                                                @if(!empty($reply->user->avatar))
                                                    <img src="{{ str_starts_with($reply->user->avatar, 'http') ? $reply->user->avatar : (str_starts_with($reply->user->avatar, '/storage') ? asset($reply->user->avatar) : asset('storage/' . $reply->user->avatar)) }}" 
                                                         alt="{{ $reply->user->name ?? 'User' }}" 
                                                         class="w-full h-full object-cover absolute inset-0">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center bg-indigo-600 text-white">
                                                        {{ strtoupper(substr($reply->user->name ?? 'U', 0, 1)) }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex-1">
                                                <div class="bg-gray-50 dark:bg-gray-800/40 p-3 rounded-2xl border border-gray-100 dark:border-gray-800">
                                                    <div class="flex items-center justify-between mb-1">
                                                        <span class="font-bold text-gray-900 dark:text-gray-100">{{ $reply->user->name ?? 'Anonim' }}</span>
                                                        <span class="text-[9px] text-gray-400">{{ $reply->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $reply->body }}</p>
                                                </div>
                                                <div class="flex items-center gap-4 mt-1 ml-2">
                                                    <button onclick="setReplyTo({{ $reply->id }}, '{{ $reply->user->name ?? 'Anonim' }}')" class="text-[10px] font-semibold text-gray-500 hover:text-blue-600 cursor-pointer">
                                                        Balas
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </div>
                @empty
                    <div id="no-comments" class="text-center py-16 text-gray-400 text-xs">
                        Belum ada komentar. Jadilah yang pertama memberikan apresiasi!
                    </div>
                @endforelse
            </div>

            {{-- PANEL GIF KOLEKSI --}}
            <div id="gif-picker-panel" class="hidden flex-col bg-gray-50 dark:bg-gray-800/90 border-t border-gray-100 dark:border-gray-800 p-3 shrink-0 h-60">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-bold text-gray-500">Pilih GIF / Stiker Animasi</span>
                    <button type="button" onclick="toggleGifPicker(false)" class="text-xs text-blue-600 font-semibold cursor-pointer">Tutup</button>
                </div>
                
                <input type="text" id="gif-search-input" placeholder="Cari GIF (misal: keren, senyum, kucing)..." oninput="filterGifs(this.value)" class="w-full px-3 py-2 text-xs rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 mb-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                
                <div id="gif-results-container" class="flex-1 overflow-y-auto grid grid-cols-3 gap-2 scrollbar-thin">
                </div>
            </div>

            {{-- INPUT & TOMBOL TRIGGER GIF --}}
            <div class="border-t border-gray-100 dark:border-gray-800 bg-white dark:bg-gray-900 shrink-0">
                @auth
                    <form id="comment-form" onsubmit="postComment(event, {{ $project->id }})" class="p-4 flex items-center gap-2">
                        @csrf
                        <button type="button" onclick="toggleGifPicker()" title="Kirim GIF" class="p-2.5 rounded-full bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 text-xs font-extrabold text-blue-600 transition shrink-0 cursor-pointer">
                            GIF
                        </button>
                        <input type="text" id="comment-input" required placeholder="Tulis komentar atau apresiasi..." class="flex-1 px-4 py-3 rounded-full border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="submit" id="submit-btn" class="px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-full text-xs font-semibold transition shrink-0 cursor-pointer">
                            Kirim
                        </button>
                    </form>
                @else
                    <div class="text-center py-4 text-xs text-gray-500">
                        <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">Login</a> untuk ikut mengirim komentar & balasan.
                    </div>
                @endauth
            </div>

        </div>
    </div>

    <script>
        const modal = document.getElementById('comment-modal');
        const sheet = document.getElementById('comment-sheet');
        let currentParentId = null;

        const localGifs = [
            { name: "Keren Mantap", url: "https://media.giphy.com/media/26BRv0ThflsHCqDrG/giphy.gif" },
            { name: "Kucing Lucu", url: "https://media.giphy.com/media/JIX9t2j0ZTN9S/giphy.gif" },
            { name: "Spongebob Happy", url: "https://media.giphy.com/media/3oKIPnAiaMCws8nOsE/giphy.gif" },
            { name: "Jempol Salut", url: "https://media.giphy.com/media/111ebonMs90YLu/giphy.gif" },
            { name: "Tepuk Tangan", url: "https://media.giphy.com/media/13CoXPoqCJRO6A/giphy.gif" },
            { name: "Tertawa", url: "https://media.giphy.com/media/9uIV1q5I949V6/giphy.gif" },
            { name: "Keren Banget", url: "https://media.giphy.com/media/Z6f7vzq3iP6Mw/giphy.gif" },
            { name: "Bingung", url: "https://media.giphy.com/media/g01ZnwAUvutuK8GIQn/giphy.gif" },
            { name: "Mantap Jiwa", url: "https://media.giphy.com/media/L3ERvA6jWCdYqO44Xm/giphy.gif" }
        ];

        function openCommentModal() {
            modal.classList.remove('opacity-0', 'pointer-events-none');
            sheet.classList.remove('translate-y-full', 'sm:translate-y-10', 'sm:scale-95');
            sheet.classList.add('translate-y-0', 'sm:translate-y-0', 'sm:scale-100');
            sessionStorage.setItem('comment_modal_state', 'open');
        }

        function closeCommentModal() {
            modal.classList.add('opacity-0', 'pointer-events-none');
            sheet.classList.remove('translate-y-0', 'sm:translate-y-0', 'sm:scale-100');
            sheet.classList.add('translate-y-full', 'sm:translate-y-10', 'sm:scale-95');
            sessionStorage.removeItem('comment_modal_state');
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (sessionStorage.getItem('comment_modal_state') === 'open') {
                openCommentModal();
            }
            renderGifList(localGifs);
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeCommentModal();
        });

        function setReplyTo(commentId, userName) {
            currentParentId = commentId;
            const inputField = document.getElementById('comment-input');
            inputField.placeholder = `Membalas @${userName}...`;
            inputField.focus();

            let indicator = document.getElementById('reply-indicator');
            const commentForm = document.getElementById('comment-form');
            if (!indicator) {
                indicator = document.createElement('div');
                indicator.id = 'reply-indicator';
                indicator.className = 'text-[11px] text-blue-600 dark:text-blue-400 px-4 pt-2 flex justify-between items-center bg-gray-50 dark:bg-gray-800/50 border-t border-gray-100 dark:border-gray-800';
                commentForm.parentNode.insertBefore(indicator, commentForm);
            }
            indicator.innerHTML = `<span>Membalas <b>@${userName}</b></span> <button type="button" onclick="cancelReply()" class="text-red-500 font-bold hover:underline cursor-pointer">Batal</button>`;
        }

        function cancelReply() {
            currentParentId = null;
            const inputField = document.getElementById('comment-input');
            inputField.placeholder = 'Tulis komentar atau apresiasi...';
            const indicator = document.getElementById('reply-indicator');
            if (indicator) indicator.remove();
        }

        function toggleReplies(commentId) {
            const repliesContainer = document.getElementById(`replies-${commentId}`);
            const viewText = document.getElementById(`view-text-${commentId}`);
            if(!repliesContainer) return;
            const isHidden = repliesContainer.classList.contains('hidden');
            
            if (isHidden) {
                repliesContainer.classList.remove('hidden');
                viewText.dataset.originalText = viewText.textContent;
                viewText.textContent = 'Sembunyikan balasan';
            } else {
                repliesContainer.classList.add('hidden');
                viewText.textContent = viewText.dataset.originalText || 'Lihat balasan';
            }
        }

        function toggleGifPicker(forceState) {
            const panel = document.getElementById('gif-picker-panel');
            if (forceState !== undefined) {
                panel.classList.toggle('hidden', !forceState);
                panel.classList.toggle('flex', forceState);
            } else {
                panel.classList.toggle('hidden');
                panel.classList.toggle('flex');
            }
        }

        function filterGifs(keyword) {
            const filtered = localGifs.filter(g => g.name.toLowerCase().includes(keyword.toLowerCase()));
            renderGifList(filtered);
        }

        function renderGifList(gifs) {
            const container = document.getElementById('gif-results-container');
            container.innerHTML = '';
            
            if(gifs.length === 0) {
                container.innerHTML = '<div class="col-span-3 text-center text-xs text-gray-400 py-4">GIF tidak ditemukan.</div>';
                return;
            }

            gifs.forEach(gif => {
                const img = document.createElement('img');
                img.src = gif.url;
                img.title = gif.name;
                img.className = 'w-full h-20 object-cover rounded-lg cursor-pointer hover:opacity-80 transition border border-gray-200 dark:border-gray-700';
                img.onclick = () => selectGif(gif.url);
                container.appendChild(img);
            });
        }

        function selectGif(gifUrl) {
            const projectId = {{ $project->id }};
            toggleGifPicker(false);

            sendDataToServer(projectId, {
                comment: 'GIF',
                type: 'gif',
                attachment: gifUrl,
                parent_id: currentParentId
            });
        }

        function postComment(event, projectId) {
            event.preventDefault();
            const inputField = document.getElementById('comment-input');
            const commentText = inputField.value.trim();

            if (!commentText) return;

            sendDataToServer(projectId, {
                comment: commentText,
                type: 'text',
                parent_id: currentParentId
            });
        }

        function sendDataToServer(projectId, payload) {
            const submitBtn = document.getElementById('submit-btn');
            if(submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = '...';
            }

            fetch(`/project/${projectId}/comment`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            })
            .then(async response => {
                const contentType = response.headers.get("content-type");
                if (contentType && contentType.indexOf("application/json") !== -1) {
                    const data = await response.json();
                    if (!response.ok) throw new Error(data.message || 'Terjadi kesalahan pada server.');
                    return data;
                } else {
                    throw new Error('Server mengembalikan format non-JSON.');
                }
            })
            .then(data => {
                if (data.success) {
                    const inputField = document.getElementById('comment-input');
                    if(inputField) inputField.value = '';
                    
                    appendCommentToDOM(data);
                    cancelReply();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal mengirim komentar: ' + error.message);
            })
            .finally(() => {
                if(submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Kirim';
                }
            });
        }

        function appendCommentToDOM(res) {
            const userName = res.user_name;
            const initial = res.user_initial;
            const userAvatar = res.user_avatar; // Pastikan controller mengirim data avatar jika pakai realtime AJAX, atau gunakan fallback initial
            const timeAgo = res.created_at;
            const commentBody = res.comment;
            const commentType = res.type;
            const commentAttachment = res.attachment;
            const parentId = res.parent_id ? String(res.parent_id).trim() : null;
            const commentId = res.id;

            const isReply = parentId && parentId !== "null" && parentId !== "" && parentId !== "undefined" && parentId !== "0";

            // Helper render avatar untuk realtime DOM
            const avatarHtml = userAvatar 
                ? `<img src="${userAvatar.startsWith('http') || userAvatar.startsWith('/storage') ? userAvatar : '/storage/' + userAvatar}" class="w-full h-full object-cover absolute inset-0">`
                : `<div class="w-full h-full flex items-center justify-center">${initial}</div>`;

            if (!isReply) {
                const container = document.getElementById('comments-container');
                const noComments = document.getElementById('no-comments');
                if (noComments) noComments.remove();

                const commentHTML = `
                    <div class="space-y-3 comment-item" data-id="${commentId}">
                        <div class="flex items-start gap-3 text-sm">
                            <div class="w-9 h-9 rounded-full overflow-hidden bg-blue-600 text-white flex items-center justify-center font-bold text-xs shrink-0 relative">
                                ${avatarHtml}
                            </div>
                            <div class="flex-1">
                                <div class="bg-gray-50 dark:bg-gray-800/60 p-3.5 rounded-2xl border border-gray-100 dark:border-gray-800">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="font-bold text-xs text-gray-900 dark:text-gray-100">${userName}</span>
                                        <span class="text-[10px] text-gray-400">${timeAgo}</span>
                                    </div>
                                    ${commentType === 'gif' ? `
                                        <div class="my-2 rounded-xl overflow-hidden max-w-[200px] bg-black/5 border border-gray-200 dark:border-gray-700 shadow-xs">
                                            <img src="${commentAttachment}" alt="GIF Komentar" class="w-full object-cover">
                                        </div>
                                    ` : `
                                        <p class="text-xs text-gray-700 dark:text-gray-300 leading-relaxed">${commentBody}</p>
                                    `}
                                </div>
                                <div class="flex items-center gap-4 mt-1 ml-2">
                                    <button onclick="setReplyTo(${commentId}, '${userName}')" class="text-[11px] font-semibold text-gray-500 hover:text-blue-600 cursor-pointer">
                                        Balas
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                container.insertAdjacentHTML('afterbegin', commentHTML);
            } else {
                const parentCommentItem = document.querySelector(`.comment-item[data-id="${parentId}"]`);
                
                if (parentCommentItem) {
                    let repliesContainer = parentCommentItem.querySelector(`#replies-${parentId}`);
                    
                    if (!repliesContainer) {
                        const wrapperHTML = `
                            <div class="ml-9 pl-4 border-l-2 border-gray-200 dark:border-gray-700 space-y-3 mt-3">
                                <button onclick="toggleReplies(${parentId})" id="view-btn-${parentId}" class="flex items-center gap-2 text-[11px] font-bold text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 cursor-pointer pt-1">
                                    <span id="view-text-${parentId}">Sembunyikan balasan</span>
                                </button>
                                <div id="replies-${parentId}" class="space-y-3 pt-1"></div>
                            </div>
                        `;
                        parentCommentItem.insertAdjacentHTML('beforeend', wrapperHTML);
                        repliesContainer = parentCommentItem.querySelector(`#replies-${parentId}`);
                    } else {
                        repliesContainer.classList.remove('hidden');
                        const viewBtn = document.getElementById(`view-text-${parentId}`);
                        if(viewBtn) viewBtn.textContent = 'Sembunyikan balasan';
                    }

                    const replyHTML = `
                        <div class="flex items-start gap-2.5 text-xs">
                            <div class="w-7 h-7 rounded-full overflow-hidden bg-indigo-600 text-white flex items-center justify-center font-bold text-[10px] shrink-0 relative">
                                ${avatarHtml}
                            </div>
                            <div class="flex-1">
                                <div class="bg-gray-50 dark:bg-gray-800/40 p-3 rounded-2xl border border-gray-100 dark:border-gray-800">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="font-bold text-gray-900 dark:text-gray-100">${userName}</span>
                                        <span class="text-[9px] text-gray-400">${timeAgo}</span>
                                    </div>
                                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">${commentBody}</p>
                                </div>
                                <div class="flex items-center gap-4 mt-1 ml-2">
                                    <button onclick="setReplyTo(${commentId}, '${userName}')" class="text-[10px] font-semibold text-gray-500 hover:text-blue-600 cursor-pointer">
                                        Balas
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                    repliesContainer.insertAdjacentHTML('beforeend', replyHTML);
                }
            }

            const badgeCount = document.getElementById('trigger-comment-count');
            if (badgeCount) {
                badgeCount.textContent = res.total_comments + ' Komentar';
            }
        }
    </script>
</body>
</html>
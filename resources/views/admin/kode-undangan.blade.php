@extends('layouts.admin')

@section('title', 'Kode Undangan')
@section('page_title', 'Kode Undangan')

@section('content')

    @if(session('success'))
        <div class="mb-6 neubrutal-card bg-green-100 px-4 py-3 font-bold text-green-900">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 neubrutal-card bg-red-100 px-4 py-3">
            <ul class="list-disc pl-5 font-bold text-red-800">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- ACTION BAR (DI ATAS TABEL SEBELAH KANAN) -->
    <div class="mb-4 flex justify-end">
        <button onclick="openModal('modalTambah')" class="px-4 py-2.5 bg-[#ffcc00] text-black rounded-xl btn-neubrutal flex items-center gap-1.5 text-sm cursor-pointer">
            <span class="font-black text-base leading-none">+</span>
            <span>Tambah Kode</span>
        </button>
    </div>

    <!-- RESPONSIVE LIST / TABLE CONTAINER -->
    <div class="neubrutal-card overflow-hidden">

        <!-- 1. TAMPILAN DESKTOP (TABEL) -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full border-collapse">
                <thead class="bg-gray-100 border-b-3 border-black">
                    <tr>
                        <th class="px-4 py-3.5 text-left text-xs font-black text-gray-900 uppercase">No</th>
                        <th class="px-6 py-3.5 text-left text-xs font-black text-gray-900 uppercase">Kode Unik</th>
                        <th class="px-6 py-3.5 text-left text-xs font-black text-gray-900 uppercase">Kelas</th>
                        <th class="px-6 py-3.5 text-left text-xs font-black text-gray-900 uppercase">Jurusan</th>
                        <th class="px-6 py-3.5 text-left text-xs font-black text-gray-900 uppercase">Deskripsi</th>
                        <th class="px-6 py-3.5 text-left text-xs font-black text-gray-900 uppercase">Pemakaian</th>
                        <th class="px-6 py-3.5 text-left text-xs font-black text-gray-900 uppercase">Status</th>
                        <th class="px-6 py-3.5 text-left text-xs font-black text-gray-900 uppercase">Kadaluarsa</th>
                        <th class="px-6 py-3.5 text-center text-xs font-black text-gray-900 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-gray-200">
                    @forelse($codes as $index => $code)
                        <tr class="hover:bg-yellow-50/50">
                            <td class="px-4 py-4 text-sm font-bold text-gray-900">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-mono font-black text-black bg-yellow-200 px-2.5 py-1 rounded-lg text-sm border-2 border-black shadow-[2px_2px_0px_#000]">
                                    {{ $code->code }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 font-extrabold whitespace-nowrap">{{ $code->kelas }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 font-bold whitespace-nowrap">{{ $code->jurusan }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 font-medium max-w-xs truncate">{{ $code->description ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm font-black whitespace-nowrap {{ $code->used_count >= $code->max_uses ? 'text-red-600' : 'text-gray-900' }}">
                                {{ $code->used_count }} / {{ $code->max_uses }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($code->is_active)
                                    <span class="inline-block px-3 py-1 rounded-lg text-xs font-black bg-green-200 text-green-900 border-2 border-black shadow-[2px_2px_0px_#000]">Aktif</span>
                                @else
                                    <span class="inline-block px-3 py-1 rounded-lg text-xs font-black bg-red-200 text-red-900 border-2 border-black shadow-[2px_2px_0px_#000]">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700 font-semibold whitespace-nowrap">
                                {{ $code->expires_at ? $code->expires_at->format('d M Y') : '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-center whitespace-nowrap">
                                <button type="button"
                                        data-id="{{ $code->id }}"
                                        data-code="{{ $code->code }}"
                                        data-kelas="{{ $code->kelas }}"
                                        data-jurusan="{{ $code->jurusan }}"
                                        data-description="{{ $code->description ?? '' }}"
                                        data-max-uses="{{ $code->max_uses }}"
                                        data-used-count="{{ $code->used_count }}"
                                        data-expires-at="{{ optional($code->expires_at)->format('Y-m-d') }}"
                                        data-is-active="{{ $code->is_active ? 1 : 0 }}"
                                        onclick="openEditModalFromButton(this)"
                                        class="px-3 py-1.5 bg-sky-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] inline-block mr-2 hover:translate-y-[-1px] cursor-pointer">
                                    Edit
                                </button>
                                <button type="button"
                                        data-url="{{ route('admin.kode-undangan.destroy', $code) }}"
                                        data-code="{{ $code->code }}"
                                        onclick="confirmDelete(this)"
                                        class="px-3 py-1.5 bg-red-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] cursor-pointer hover:translate-y-[-1px]">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-10 text-gray-500 font-bold">
                                Belum ada kode undangan. Silakan tambah terlebih dahulu.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- 2. TAMPILAN MOBILE (CARD LIST) -->
        <div class="block md:hidden divide-y-2 divide-gray-200">
            @forelse($codes as $code)
                <div class="p-4 space-y-3 hover:bg-yellow-50/40 transition">
                    <div class="flex items-start justify-between gap-2">
                        <span class="font-mono font-black text-black bg-yellow-200 px-2.5 py-1 rounded-lg text-xs border-2 border-black shadow-[2px_2px_0px_#000]">
                            {{ $code->code }}
                        </span>
                        @if($code->is_active)
                            <span class="px-2.5 py-0.5 rounded-lg text-[10px] font-black bg-green-200 text-green-900 border-2 border-black shadow-[2px_2px_0px_#000]">Aktif</span>
                        @else
                            <span class="px-2.5 py-0.5 rounded-lg text-[10px] font-black bg-red-200 text-red-900 border-2 border-black shadow-[2px_2px_0px_#000]">Nonaktif</span>
                        @endif
                    </div>

                    <div class="space-y-1">
                        <p class="text-sm font-extrabold text-gray-900">{{ $code->kelas }} <span class="font-normal text-xs text-gray-600">({{ $code->jurusan }})</span></p>
                        <p class="text-xs text-gray-600 font-medium">{{ $code->description ?? '-' }}</p>
                    </div>

                    <div class="flex flex-wrap items-center justify-between text-xs font-bold text-gray-700 pt-1">
                        <span>Pemakaian: <strong class="{{ $code->used_count >= $code->max_uses ? 'text-red-600' : 'text-black' }}">{{ $code->used_count }} / {{ $code->max_uses }}</strong></span>
                        <span>Kadaluarsa: {{ $code->expires_at ? $code->expires_at->format('d M Y') : '-' }}</span>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-2 border-t border-gray-100">
                        <button type="button"
                                data-id="{{ $code->id }}"
                                data-code="{{ $code->code }}"
                                data-kelas="{{ $code->kelas }}"
                                data-jurusan="{{ $code->jurusan }}"
                                data-description="{{ $code->description ?? '' }}"
                                data-max-uses="{{ $code->max_uses }}"
                                data-used-count="{{ $code->used_count }}"
                                data-expires-at="{{ optional($code->expires_at)->format('Y-m-d') }}"
                                data-is-active="{{ $code->is_active ? 1 : 0 }}"
                                onclick="openEditModalFromButton(this)"
                                class="px-3 py-1 bg-sky-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] cursor-pointer">
                            Edit
                        </button>
                        <button type="button"
                                data-url="{{ route('admin.kode-undangan.destroy', $code) }}"
                                data-code="{{ $code->code }}"
                                onclick="confirmDelete(this)"
                                class="px-3 py-1 bg-red-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] cursor-pointer">
                            Hapus
                        </button>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-gray-500 font-bold">Belum ada kode undangan. Silakan tambah terlebih dahulu.</div>
            @endforelse
        </div>
    </div>

    <!-- MODAL TAMBAH KODE -->
    <div id="modalTambah" class="hidden fixed inset-0 z-50 modal-overlay flex items-center justify-center p-4">
        <div class="modal-card rounded-2xl max-w-md w-full overflow-hidden">
            <div class="bg-[#ffcc00] border-b-3 border-black p-4 text-black flex justify-between items-center">
                <h3 class="text-lg font-black">Tambah Kode Unik</h3>
                <button type="button" onclick="closeModal('modalTambah')" class="text-black hover:opacity-75 text-2xl font-black cursor-pointer">&times;</button>
            </div>

            <form action="{{ route('admin.kode-undangan.store') }}" method="POST" class="p-5 sm:p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-black text-gray-900 mb-1">Kode Unik *</label>
                    <input type="text" name="code" value="{{ old('code') }}" required placeholder="Contoh: XII-PPLG-2-2026" class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-black text-gray-900 mb-1">Kelas *</label>
                        <input type="text" name="kelas" value="{{ old('kelas') }}" required placeholder="XII PPLG 2" class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                    </div>
                    <div>
                        <label class="block text-sm font-black text-gray-900 mb-1">Jurusan *</label>
                        <input type="text" name="jurusan" value="{{ old('jurusan') }}" required placeholder="PPLG" class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-black text-gray-900 mb-1">Deskripsi</label>
                    <input type="text" name="description" value="{{ old('description') }}" placeholder="Deskripsi opsional..." class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-black text-gray-900 mb-1">Maks. Pemakaian *</label>
                        <input type="number" name="max_uses" value="{{ old('max_uses', 36) }}" min="1" required class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                    </div>
                    <div>
                        <label class="block text-sm font-black text-gray-900 mb-1">Tanggal Kadaluarsa</label>
                        <input type="date" name="expires_at" value="{{ old('expires_at') }}" class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                    </div>
                </div>

                <div class="pt-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 rounded border-2 border-black text-yellow-500 focus:ring-0">
                        <span class="text-sm font-black text-gray-900">Status Aktif</span>
                    </label>
                </div>

                <div class="pt-3 flex gap-3 justify-end border-t-3 border-black">
                    <button type="button" onclick="closeModal('modalTambah')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-xl btn-neubrutal text-xs sm:text-sm cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-[#ffcc00] text-black rounded-xl btn-neubrutal text-xs sm:text-sm cursor-pointer">
                        Simpan Kode
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT KODE -->
    <div id="modalEdit" class="hidden fixed inset-0 z-50 modal-overlay flex items-center justify-center p-4">
        <div class="modal-card rounded-2xl max-w-md w-full overflow-hidden">
            <div class="bg-sky-400 border-b-3 border-black p-4 text-black flex justify-between items-center">
                <h3 class="text-lg font-black">Edit Kode Unik</h3>
                <button type="button" onclick="closeModal('modalEdit')" class="text-black hover:opacity-75 text-2xl font-black cursor-pointer">&times;</button>
            </div>

            <form id="formEditKode" method="POST" class="p-5 sm:p-6 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-black text-gray-900 mb-1">Kode Unik *</label>
                    <input type="text" name="code" id="editCode" required class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-black text-gray-900 mb-1">Kelas *</label>
                        <input type="text" name="kelas" id="editKelas" required class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                    </div>
                    <div>
                        <label class="block text-sm font-black text-gray-900 mb-1">Jurusan *</label>
                        <input type="text" name="jurusan" id="editJurusan" required class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-black text-gray-900 mb-1">Deskripsi</label>
                    <input type="text" name="description" id="editDescription" class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-black text-gray-900 mb-1">Maks. Pemakaian *</label>
                        <input type="number" name="max_uses" id="editMaxUses" min="1" required class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                        <p class="text-[11px] font-bold text-gray-600 mt-1">Sudah dipakai: <span id="editUsedCount" class="font-black text-black">0</span></p>
                    </div>
                    <div>
                        <label class="block text-sm font-black text-gray-900 mb-1">Tanggal Kadaluarsa</label>
                        <input type="date" name="expires_at" id="editExpiresAt" class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                    </div>
                </div>

                <div class="pt-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" id="editIsActive" class="w-4 h-4 rounded border-2 border-black text-sky-500 focus:ring-0">
                        <span class="text-sm font-black text-gray-900">Status Aktif</span>
                    </label>
                </div>

                <div class="pt-3 flex gap-3 justify-end border-t-3 border-black">
                    <button type="button" onclick="closeModal('modalEdit')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-xl btn-neubrutal text-xs sm:text-sm cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-sky-400 text-black rounded-xl btn-neubrutal text-xs sm:text-sm cursor-pointer">
                        Update Kode
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL CUSTOM KONFIRMASI HAPUS -->
    <div id="modalHapus" class="hidden fixed inset-0 z-50 modal-overlay flex items-center justify-center p-4">
        <div class="modal-card rounded-2xl max-w-sm w-full overflow-hidden text-center p-6 space-y-4">
            <div class="w-14 h-14 bg-red-100 border-2 border-black rounded-full flex items-center justify-center mx-auto shadow-[2px_2px_0px_#000]">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>

            <div>
                <h3 class="text-lg font-black text-gray-900">Hapus Kode Undangan?</h3>
                <p class="text-sm text-gray-600 font-bold mt-1">
                    Kamu yakin mau menghapus kode <span id="deleteCodeName" class="font-black text-red-600"></span>? Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>

            <form id="formHapusKode" method="POST" class="pt-2 flex gap-3 justify-center">
                @csrf
                @method('DELETE')
                <button type="button" onclick="closeModal('modalHapus')" class="w-full py-2.5 bg-gray-200 text-gray-800 rounded-xl btn-neubrutal text-sm cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="w-full py-2.5 bg-red-500 text-white rounded-xl btn-neubrutal text-sm cursor-pointer">
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        function openEditModalFromButton(button) {
            let id = button.getAttribute('data-id');
            let code = button.getAttribute('data-code');
            let kelas = button.getAttribute('data-kelas');
            let jurusan = button.getAttribute('data-jurusan');
            let description = button.getAttribute('data-description');
            let maxUses = button.getAttribute('data-max-uses');
            let usedCount = button.getAttribute('data-used-count');
            let expiresAt = button.getAttribute('data-expires-at');
            let isActive = button.getAttribute('data-is-active');

            let actionUrl = "{{ route('admin.kode-undangan.update', ':id') }}".replace(':id', id);
            document.getElementById('formEditKode').action = actionUrl;

            document.getElementById('editCode').value = code;
            document.getElementById('editKelas').value = kelas;
            document.getElementById('editJurusan').value = jurusan;
            document.getElementById('editDescription').value = description;
            document.getElementById('editMaxUses').value = maxUses;
            document.getElementById('editUsedCount').innerText = usedCount;
            document.getElementById('editExpiresAt').value = expiresAt;
            document.getElementById('editIsActive').checked = (isActive == 1);

            openModal('modalEdit');
        }

        function confirmDelete(button) {
            let url = button.getAttribute('data-url');
            let code = button.getAttribute('data-code');

            document.getElementById('formHapusKode').action = url;
            document.getElementById('deleteCodeName').innerText = code;
            openModal('modalHapus');
        }
    </script>
@endpush
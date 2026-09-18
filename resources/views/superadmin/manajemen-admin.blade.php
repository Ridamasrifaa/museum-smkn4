@extends('layouts.superadmin')

@section('title', 'Manajemen Admin')
@section('page_title', 'Manajemen Akun Admin')

@section('content')
    <div id="loading-content" class="absolute inset-0 bg-[#fcfcfc]/90 z-50 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
        <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-xl border-3 border-black shadow-[4px_4px_0px_#000]">
            <div class="w-5 h-5 border-3 border-black border-t-[#ffcc00] rounded-full animate-spin"></div>
            <p class="text-gray-900 font-black text-sm tracking-wide">Memuat data...</p>
        </div>
    </div>

    {{-- Alert Sukses --}}
    @if(session('success'))
        <div id="successAlert" class="mb-6 bg-green-200 border-3 border-black rounded-2xl p-4 shadow-[4px_4px_0px_#000] flex justify-between items-center transition-all">
            <div class="flex items-center gap-3">
                <span class="w-6 h-6 bg-black text-white rounded-lg flex items-center justify-center font-black text-xs">✓</span>
                <p class="font-black text-sm text-gray-900">{{ session('success') }}</p>
            </div>
            <button onclick="document.getElementById('successAlert').style.display='none'" class="font-black text-sm px-2 py-1 bg-white border-2 border-black rounded-lg shadow-[2px_2px_0px_#000] cursor-pointer hover:bg-gray-100">✕</button>
        </div>
    @endif

    {{-- Alert Error --}}
    @if(session('error'))
        <div id="errorAlert" class="mb-6 bg-red-200 border-3 border-black rounded-2xl p-4 shadow-[4px_4px_0px_#000] flex justify-between items-center transition-all">
            <div class="flex items-center gap-3">
                <span class="w-6 h-6 bg-black text-white rounded-lg flex items-center justify-center font-black text-xs">!</span>
                <p class="font-black text-sm text-gray-900">{{ session('error') }}</p>
            </div>
            <button onclick="document.getElementById('errorAlert').style.display='none'" class="font-black text-sm px-2 py-1 bg-white border-2 border-black rounded-lg shadow-[2px_2px_0px_#000] cursor-pointer hover:bg-gray-100">✕</button>
        </div>
    @endif

    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <h2 class="text-base sm:text-lg font-black text-gray-900">Daftar Akun Admin</h2>
        <button onclick="openCreateModal()" class="w-full sm:w-auto px-4 py-2.5 bg-[#ffcc00] text-black rounded-xl border-3 border-black shadow-[3px_3px_0px_#000] hover:translate-y-[-2px] transition font-black text-sm flex items-center justify-center gap-2 cursor-pointer">
            <span class="text-base leading-none">+</span> Tambah Admin
        </button>
    </div>

    <div class="bg-white rounded-2xl border-3 border-black shadow-[4px_4px_0px_#000] mb-6 p-4 sm:p-5">
        <h2 class="text-sm sm:text-base font-black text-gray-900 mb-3">Cari Admin</h2>
        <div class="flex flex-col sm:flex-row gap-3">
            <form method="GET" class="flex flex-col sm:flex-row flex-1 gap-3">
                <input id="searchInput" name="search" value="{{ request('search') }}" placeholder="Cari username atau email..." class="flex-1 px-4 py-2.5 rounded-xl border-2 border-black shadow-[2px_2px_0px_#000] focus:outline-none text-sm font-bold bg-white">
                <button type="submit" class="bg-[#ffcc00] text-black px-5 py-2.5 rounded-xl border-2 border-black shadow-[2px_2px_0px_#000] font-black hover:translate-y-[-1px] transition cursor-pointer text-sm">Cari</button>
            </form>
            <a href="{{ url('/superadmin/manajemen-admin') }}" class="px-6 py-2.5 bg-gray-200 text-black rounded-xl border-2 border-black shadow-[2px_2px_0px_#000] font-black hover:bg-gray-300 transition text-sm text-center cursor-pointer flex items-center justify-center">Reset</a>
        </div>
    </div>

    <div class="bg-white rounded-2xl border-3 border-black shadow-[4px_4px_0px_#000] overflow-hidden mb-6">
        <div class="px-4 sm:px-6 py-3.5 bg-yellow-100 border-b-2 border-black flex flex-col sm:flex-row justify-between items-start sm:items-center text-xs font-black text-gray-900 gap-1">
            <span>Catatan Untuk Role</span>
            <span>Role 0 = Super Admin &nbsp;|&nbsp; Role 1 = Admin Jurusan</span>
        </div>

        {{-- Tampilan Desktop: Tabel Biasa --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-100 border-b-3 border-black text-gray-900 font-black text-xs uppercase">
                    <tr>
                        <th class="px-6 py-3.5 w-16">No</th>
                        <th class="px-6 py-3.5">Username</th>
                        <th class="px-6 py-3.5">Email</th>
                        <th class="px-6 py-3.5">Role / Jurusan</th>
                        <th class="px-6 py-3.5 text-center w-36">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-gray-200">
                    @forelse($admins as $admin)
                        <tr class="hover:bg-yellow-50/50">
                            <td class="px-6 py-4 text-sm font-bold text-gray-900">
                                {{ $loop->iteration + ($admins->currentPage() - 1) * $admins->perPage() }}
                            </td>
                            <td class="px-6 py-4 text-sm font-black text-gray-900">{{ $admin->name }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-700">{{ $admin->email }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="px-2.5 py-0.5 rounded-lg text-xs font-black border-2 border-black shadow-[2px_2px_0px_#000] inline-block {{ $admin->role == 0 ? 'bg-purple-200 text-purple-900' : 'bg-blue-200 text-blue-900' }}">
                                    {{ $admin->role == 0 ? 'Super Admin' : 'Admin: ' . ($admin->jurusan ?? '-') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-center">
                                <div class="flex justify-center gap-2">
                                    <button type="button" 
                                        data-action="edit" 
                                        data-id="{{ $admin->id }}" 
                                        data-username="{{ $admin->name }}" 
                                        data-email="{{ $admin->email }}"
                                        data-role="{{ $admin->role }}"
                                        data-jurusan="{{ $admin->jurusan }}"
                                        class="px-3 py-1.5 bg-sky-300 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] hover:translate-y-[-1px] cursor-pointer">
                                        Edit
                                    </button>

                                    <button type="button" 
                                        onclick="confirmDelete('{{ $admin->id }}', '{{ $admin->name }}')"
                                        class="px-3 py-1.5 bg-red-300 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] hover:translate-y-[-1px] cursor-pointer">
                                        Hapus
                                    </button>

                                    <form id="delete-form-{{ $admin->id }}" action="{{ url('/superadmin/manajemen-admin/' . $admin->id) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-10 text-gray-500 font-bold">Belum ada data admin.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Tampilan Mobile: Card Vertikal Terstruktur --}}
        <div class="md:hidden p-4 space-y-4">
            @forelse($admins as $admin)
                <div class="p-4 bg-gray-50 border-2 border-black rounded-xl shadow-[3px_3px_0px_#000] space-y-3">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="text-[10px] font-black text-gray-500 uppercase">No. {{ $loop->iteration + ($admins->currentPage() - 1) * $admins->perPage() }}</span>
                            <h3 class="font-black text-base text-gray-900">{{ $admin->name }}</h3>
                        </div>
                        <span class="px-2.5 py-0.5 rounded-lg text-xs font-black border-2 border-black shadow-[2px_2px_0px_#000] {{ $admin->role == 0 ? 'bg-purple-200 text-purple-900' : 'bg-blue-200 text-blue-900' }}">
                            {{ $admin->role == 0 ? 'Super Admin' : 'Admin: ' . ($admin->jurusan ?? '-') }}
                        </span>
                    </div>

                    <div class="text-xs font-bold text-gray-700">
                        <p>Email: <span class="font-medium text-gray-900">{{ $admin->email }}</span></p>
                    </div>

                    <div class="flex gap-2 pt-2 border-t border-gray-200">
                        <button type="button" 
                            data-action="edit" 
                            data-id="{{ $admin->id }}" 
                            data-username="{{ $admin->name }}" 
                            data-email="{{ $admin->email }}"
                            data-role="{{ $admin->role }}"
                            data-jurusan="{{ $admin->jurusan }}"
                            class="flex-1 py-2 bg-sky-300 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] text-center cursor-pointer">
                            Edit
                        </button>

                        <button type="button" 
                            onclick="confirmDelete('{{ $admin->id }}', '{{ $admin->name }}')"
                            class="flex-1 py-2 bg-red-300 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] text-center cursor-pointer">
                            Hapus
                        </button>
                    </div>
                </div>
            @empty
                <p class="text-center py-6 text-gray-500 font-bold text-sm">Belum ada data admin.</p>
            @endforelse
        </div>

        <div class="px-4 sm:px-6 py-4 bg-gray-50 border-t-3 border-black flex flex-col sm:flex-row justify-between items-center text-xs sm:text-sm font-bold text-gray-800 gap-2">
            <span>Total: <span class="font-black">{{ $admins->total() }}</span> Admin</span>
            <div>
                {{ $admins->links() }}
            </div>
        </div>
    </div>

    {{-- Modal Tambah / Edit Admin --}}
    <div id="adminModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-xs z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl border-3 border-black shadow-[6px_6px_0px_#000] max-w-md w-full overflow-hidden">
            <div class="px-6 py-4 bg-[#ffcc00] border-b-3 border-black flex justify-between items-center">
                <h3 id="modalTitle" class="text-base font-black text-black">Tambah Admin Baru</h3>
                <button type="button" onclick="closeModal()" class="w-8 h-8 bg-white rounded-lg border-2 border-black flex items-center justify-center font-black text-black shadow-[2px_2px_0px_#000] cursor-pointer hover:bg-gray-100">✕</button>
            </div>

            <form id="adminForm" class="p-4 sm:p-6 space-y-4" method="POST" action="{{ url('/superadmin/manajemen-admin') }}">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <input type="hidden" id="adminId">
                
                <div>
                    <label class="block text-xs font-black text-gray-800 uppercase mb-1">Username</label>
                    <input type="text" name="name" id="username" placeholder="Masukkan username" class="w-full px-4 py-2.5 border-2 border-black rounded-xl shadow-[2px_2px_0px_#000] focus:outline-none text-sm font-bold bg-white" required>
                </div>

                <div>
                    <label class="block text-xs font-black text-gray-800 uppercase mb-1">Email</label>
                    <input type="email" name="email" id="email" placeholder="Masukkan email" class="w-full px-4 py-2.5 border-2 border-black rounded-xl shadow-[2px_2px_0px_#000] focus:outline-none text-sm font-bold bg-white" required>
                </div>
                
                <div>
                    <label class="block text-xs font-black text-gray-800 uppercase mb-1">Role</label>
                    <select name="role" id="role" onchange="toggleJurusanField()" class="w-full px-4 py-2.5 border-2 border-black rounded-xl shadow-[2px_2px_0px_#000] focus:outline-none text-sm font-bold bg-white cursor-pointer" required>
                        <option value="1">Admin Jurusan</option>
                        <option value="0">Super Admin</option>
                    </select>
                </div>

                <div id="jurusanGroup">
                    <label class="block text-xs font-black text-gray-800 uppercase mb-1">Jurusan</label>
                    <select name="jurusan" id="jurusan" class="w-full px-4 py-2.5 border-2 border-black rounded-xl shadow-[2px_2px_0px_#000] focus:outline-none text-sm font-bold bg-white cursor-pointer">
                        <option value="" disabled selected>-- Pilih Jurusan --</option>
                        <option value="PPLG">PPLG (Pengembangan Perangkat Lunak dan Gim)</option>
                        <option value="DKV">DKV (Desain Komunikasi Visual)</option>
                        <option value="TOI">TOI (Teknik Otomasi Industri)</option>
                        <option value="TJKT">TJKT (Teknik Jaringan Komputer Telekomunikasi)</option>
                        <option value="TSM">TSM (Teknik Sepeda Motor)</option>
                    </select>
                </div>

                <div id="passwordGroup">
                    <label class="block text-xs font-black text-gray-800 uppercase mb-1">Password</label>
                    <input type="password" name="password" id="password" placeholder="Masukkan password" class="w-full px-4 py-2.5 border-2 border-black rounded-xl shadow-[2px_2px_0px_#000] focus:outline-none text-sm font-bold bg-white">
                    <p id="passwordHelp" class="text-xs font-bold text-gray-600 mt-1.5 hidden">*Kosongkan password jika tidak ingin mengubahnya.</p>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closeModal()" class="flex-1 px-4 py-2.5 border-2 border-black bg-gray-200 text-black rounded-xl shadow-[2px_2px_0px_#000] hover:bg-gray-300 transition font-black text-sm cursor-pointer">Batal</button>
                    <button type="submit" class="flex-1 px-4 py-2.5 bg-[#ffcc00] text-black border-2 border-black rounded-xl shadow-[2px_2px_0px_#000] hover:translate-y-[-1px] transition font-black text-sm cursor-pointer">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Konfirmasi Hapus --}}
    <div id="deleteModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-xs z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl border-3 border-black shadow-[6px_6px_0px_#000] max-w-sm w-full overflow-hidden text-center p-6 space-y-4">
            <div class="w-14 h-14 bg-red-200 border-3 border-black rounded-2xl mx-auto flex items-center justify-center text-2xl font-black shadow-[3px_3px_0px_#000]">
                !
            </div>
            <div>
                <h3 class="text-base font-black text-gray-900">Yakin ingin menghapus?</h3>
                <p id="deleteAdminName" class="text-xs font-bold text-gray-600 mt-1">Admin yang dihapus tidak dapat dipulihkan kembali.</p>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeDeleteModal()" class="flex-1 px-4 py-2.5 border-2 border-black bg-gray-200 text-black rounded-xl shadow-[2px_2px_0px_#000] hover:bg-gray-300 transition font-black text-sm cursor-pointer">Batal</button>
                <button type="button" id="confirmDeleteBtn" class="flex-1 px-4 py-2.5 bg-red-400 text-black border-2 border-black rounded-xl shadow-[2px_2px_0px_#000] hover:translate-y-[-1px] transition font-black text-sm cursor-pointer">Ya, Hapus</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Memanggil file JavaScript eksternal --}}
    <script src="{{ asset('assets/js/superadmin/manajemen-admin.js') }}"></script>
@endpush
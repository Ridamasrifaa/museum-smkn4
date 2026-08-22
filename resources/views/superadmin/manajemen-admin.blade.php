@extends('layouts.superadmin')

@section('title', 'Manajemen Admin')
@section('page_title', 'Manajemen Akun Admin')

@section('content')
    <div id="loading-content" class="absolute inset-0 bg-gray-100 z-50 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
        <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-full shadow-sm border border-gray-200">
            <div class="w-5 h-5 border-3 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
            <p class="text-gray-700 font-medium text-sm tracking-wide">Memuat data...</p>
        </div>
    </div>

    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-900">Daftar Akun Admin</h2>
        <button onclick="openCreateModal()" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold flex items-center gap-2 cursor-pointer">
            <span>+</span> Tambah Admin
        </button>
    </div>

    <div class="bg-white rounded-lg shadow mb-6 p-4">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Cari Admin</h2>
        <div class="flex flex-col sm:flex-row gap-3">
            <form method="GET" class="flex flex-1 gap-3">
                <input id="searchInput" name="search" value="{{ request('search') }}" placeholder="Cari username atau email..." class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="bg-blue-600 text-white px-5 rounded-lg font-semibold hover:bg-blue-700 transition cursor-pointer">Cari</button>
            </form>
            <a href="{{ url('/superadmin/manajemen-admin') }}" class="px-6 py-2.5 bg-gray-500 text-white rounded-lg font-semibold hover:bg-gray-600 transition text-sm whitespace-nowrap text-center cursor-pointer">Reset</a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider w-16">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Username</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($admins as $admin)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $loop->iteration + ($admins->currentPage() - 1) * $admins->perPage() }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $admin->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $admin->email }}</td>
                            <td class="px-6 py-4 text-sm text-center">
                                <div class="flex justify-center gap-2">
                                    <button type="button" 
                                        data-action="edit" 
                                        data-id="{{ $admin->id }}" 
                                        data-username="{{ $admin->name }}" 
                                        data-email="{{ $admin->email }}"
                                        data-role="{{ $admin->role }}"
                                        class="px-3 py-1 bg-blue-100 text-blue-600 rounded hover:bg-blue-200 transition font-medium text-xs cursor-pointer">
                                        Edit
                                    </button>

                                    <form id="deleteForm-{{ $admin->id }}" action="{{ url('/superadmin/manajemen-admin/' . $admin->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" data-action="delete" data-id="{{ $admin->id }}" data-username="{{ $admin->name }}" class="px-3 py-1 bg-red-100 text-red-600 rounded hover:bg-red-200 transition font-medium text-xs cursor-pointer">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-8 text-gray-500 text-sm">Belum ada admin.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center text-sm text-gray-600">
            <span>Total: <span class="font-bold">{{ $admins->total() }}</span> Admin</span>
            <div>
                {{ $admins->links() }}
            </div>
        </div>
    </div>

    {{-- Modal Admin --}}
    <div id="adminModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 id="modalTitle" class="text-lg font-semibold text-gray-900">Tambah Admin Baru</h3>
                <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-gray-600 cursor-pointer">✕</button>
            </div>

            <form id="adminForm" class="p-6 space-y-4" method="POST" action="{{ url('/superadmin/manajemen-admin') }}">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <input type="hidden" id="adminId">
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" name="name" id="username" placeholder="Masukkan username" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" placeholder="Masukkan email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <select name="role" id="role" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" required>
                        <option value="1">Admin Biasa</option>
                        <option value="0">Super Admin</option>
                    </select>
                </div>

                <div id="passwordGroup">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" placeholder="Masukkan password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    <p id="passwordHelp" class="text-xs text-gray-400 mt-1 hidden">*Kosongkan password jika tidak ingin mengubahnya.</p>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closeModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium text-sm cursor-pointer">Batal</button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium text-sm cursor-pointer">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/superadmin/manajemen-admin.js') }}"></script>
@endpush
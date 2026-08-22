@extends('layouts.admin')

@section('title', 'Edit Kode Undangan')
@section('page_title', 'Edit Kode Unik')

@section('content')
    <div class="max-w-2xl bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.kode-undangan.update', $kodeUndangan) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Kode Unik *</label>
                <input type="text" name="code" value="{{ old('code', $kodeUndangan->code) }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('code') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kelas *</label>
                    <input type="text" name="kelas" value="{{ old('kelas', $kodeUndangan->kelas) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('kelas') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jurusan *</label>
                    <input type="text" name="jurusan" value="{{ old('jurusan', $kodeUndangan->jurusan) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('jurusan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <input type="text" name="description" value="{{ old('description', $kodeUndangan->description) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Maksimal Pemakaian *</label>
                    <input type="number" name="max_uses" value="{{ old('max_uses', $kodeUndangan->max_uses) }}" min="1" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('max_uses') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    <p class="text-xs text-gray-500 mt-1">Sudah dipakai: {{ $kodeUndangan->used_count }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kadaluarsa</label>
                    <input type="date" name="expires_at" 
                           value="{{ old('expires_at', $kodeUndangan->expires_at?->format('Y-m-d')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="mb-6">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" value="1" 
                           {{ old('is_active', $kodeUndangan->is_active) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="text-sm text-gray-700">Aktifkan kode ini</span>
                </label>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition">
                    Update Kode
                </button>
                <a href="{{ route('admin.kode-undangan.index') }}" 
                   class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded-lg font-medium transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
@extends('layouts.app')

@section('content')
<div class="py-10">
    <div class="mb-10">
        <h1 class="text-4xl font-bold mb-2">Jelajahi Koleksi</h1>
        <p class="text-slate-500">Temukan berbagai karya dan artefak bersejarah dari SMKN 4.</p>
    </div>

    <!-- Grid Layout -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($collections as $item)
        <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden hover:border-blue-500 transition-all duration-300">
            <!-- Gambar -->
            <div class="h-56 w-full bg-slate-800">
                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
            </div>
            
            <!-- Detail -->
            <div class="p-6">
                <h2 class="text-xl font-bold text-white mb-2">{{ $item->name }}</h2>
                <p class="text-slate-400 text-sm mb-4 line-clamp-2">{{ $item->description }}</p>
                <a href="{{ route('collections.show', $item->id) }}" class="inline-block text-blue-400 font-semibold hover:underline">
                    Lihat Detail →
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-20 text-slate-500">
            <p>Belum ada karya yang diunggah.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
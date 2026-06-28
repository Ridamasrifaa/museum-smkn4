@extends('layouts.app')

@section('content')
<div class="py-10">
    <a href="/" class="text-slate-500 hover:text-white transition mb-6 block">&larr; Kembali ke Beranda</a>
    
    <div class="max-w-4xl mx-auto bg-slate-900 border border-slate-800 rounded-3xl p-8">
        <!-- Gambar Besar -->
        <div class="w-full h-96 bg-slate-800 rounded-2xl mb-8 overflow-hidden">
            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
        </div>
        
        <!-- Tulisan -->
        <h1 class="text-4xl font-bold mb-4">{{ $item->name }}</h1>
        <div class="text-slate-300 leading-relaxed text-lg">
            {{ $item->description }}
        </div>
    </div>
</div>
@endsection
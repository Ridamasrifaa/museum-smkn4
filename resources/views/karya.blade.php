```blade
@extends('layouts.app')

@section('title','Galeri Karya')

@section('content')

<!-- HERO -->

<section class="relative py-20">

    <div class="text-center max-w-4xl mx-auto">

        <span class="inline-block px-4 py-2 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400">
            🎨 Galeri Digital
        </span>

        <h1 class="text-5xl font-black mt-8">

            Galeri Karya
            <span class="text-blue-500">
                Siswa PPLG
            </span>

        </h1>

        <p class="text-slate-400 mt-6 text-lg">

            Temukan berbagai karya Website, Aplikasi,
            Game, UI/UX, Poster, Video,
            serta project terbaik siswa
            SMKN 4 Tasikmalaya.

        </p>

    </div>

</section>

<!-- SEARCH -->

<section>

<div class="card p-7">

<div class="grid lg:grid-cols-4 gap-5">

<input
type="text"
placeholder="Cari karya..."
class="bg-slate-900 border border-slate-700 rounded-xl px-5 py-4">

<select
class="bg-slate-900 border border-slate-700 rounded-xl px-5">

<option>Semua</option>
<option>Website</option>
<option>Game</option>
<option>Aplikasi</option>
<option>Poster</option>
<option>UI UX</option>

</select>

<select
class="bg-slate-900 border border-slate-700 rounded-xl px-5">

<option>Terbaru</option>
<option>Terlama</option>
<option>Populer</option>

</select>

<button class="btn-primary">

Cari

</button>

</div>

</div>

</section>

<!-- GRID -->

<section class="mt-16">

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

@for($i=1;$i<=12;$i++)

<div class="card overflow-hidden group">

<div class="overflow-hidden">

<img
src="https://picsum.photos/600/400?random={{$i}}"
class="w-full h-56 object-cover duration-500 group-hover:scale-110">

</div>

<div class="p-6">

<div class="flex justify-between">

<span class="bg-blue-500/20 text-blue-400 px-3 py-1 rounded-full text-sm">

Website

</span>

<span class="text-yellow-400">

★★★★★

</span>

</div>

<h2 class="text-2xl font-bold mt-5">

Museum Digital {{$i}}

</h2>

<p class="text-slate-400 mt-3">

Project Laravel 12 + Tailwind CSS.

</p>

<div class="flex justify-between items-center mt-8">

<div>

<p class="font-semibold">

Ridda Masrifa

</p>

<p class="text-slate-500 text-sm">

PPLG XI

</p>

</div>

<a
href="/karya/{{$i}}"
class="btn-primary">

Lihat

</a>

</div>

</div>

</div>

@endfor

</div>

</section>

<!-- PAGINATION -->

<section class="mt-20">

<div class="flex justify-center gap-3">

<button class="px-5 py-3 rounded-lg bg-blue-600">
1
</button>

<button class="px-5 py-3 rounded-lg bg-slate-800 hover:bg-blue-600">
2
</button>

<button class="px-5 py-3 rounded-lg bg-slate-800 hover:bg-blue-600">
3
</button>

<button class="px-5 py-3 rounded-lg bg-slate-800 hover:bg-blue-600">
→
</button>

</div>

</section>

@endsection
```
```blade
@extends('layouts.app')

@section('title','Galeri Karya')

@section('content')

<!-- HERO -->

<section class="relative py-20">

    <div class="text-center max-w-4xl mx-auto">

        <span class="inline-block px-4 py-2 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400">
            🎨 Galeri Digital
        </span>

        <h1 class="text-5xl font-black mt-8">

            Galeri Karya
            <span class="text-blue-500">
                Siswa PPLG
            </span>

        </h1>

        <p class="text-slate-400 mt-6 text-lg">

            Temukan berbagai karya Website, Aplikasi,
            Game, UI/UX, Poster, Video,
            serta project terbaik siswa
            SMKN 4 Tasikmalaya.

        </p>

    </div>

</section>

<!-- SEARCH -->

<section>

<div class="card p-7">

<div class="grid lg:grid-cols-4 gap-5">

<input
type="text"
placeholder="Cari karya..."
class="bg-slate-900 border border-slate-700 rounded-xl px-5 py-4">

<select
class="bg-slate-900 border border-slate-700 rounded-xl px-5">

<option>Semua</option>
<option>Website</option>
<option>Game</option>
<option>Aplikasi</option>
<option>Poster</option>
<option>UI UX</option>

</select>

<select
class="bg-slate-900 border border-slate-700 rounded-xl px-5">

<option>Terbaru</option>
<option>Terlama</option>
<option>Populer</option>

</select>

<button class="btn-primary">

Cari

</button>

</div>

</div>

</section>

<!-- GRID -->

<section class="mt-16">

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

@for($i=1;$i<=12;$i++)

<div class="card overflow-hidden group">

<div class="overflow-hidden">

<img
src="https://picsum.photos/600/400?random={{$i}}"
class="w-full h-56 object-cover duration-500 group-hover:scale-110">

</div>

<div class="p-6">

<div class="flex justify-between">

<span class="bg-blue-500/20 text-blue-400 px-3 py-1 rounded-full text-sm">

Website

</span>

<span class="text-yellow-400">

★★★★★

</span>

</div>

<h2 class="text-2xl font-bold mt-5">

Museum Digital {{$i}}

</h2>

<p class="text-slate-400 mt-3">

Project Laravel 12 + Tailwind CSS.

</p>

<div class="flex justify-between items-center mt-8">

<div>

<p class="font-semibold">

Ridda Masrifa

</p>

<p class="text-slate-500 text-sm">

PPLG XI

</p>

</div>

<a
href="/karya/{{$i}}"
class="btn-primary">

Lihat

</a>

</div>

</div>

</div>

@endfor

</div>

</section>

<!-- PAGINATION -->

<section class="mt-20">

<div class="flex justify-center gap-3">

<button class="px-5 py-3 rounded-lg bg-blue-600">
1
</button>

<button class="px-5 py-3 rounded-lg bg-slate-800 hover:bg-blue-600">
2
</button>

<button class="px-5 py-3 rounded-lg bg-slate-800 hover:bg-blue-600">
3
</button>

<button class="px-5 py-3 rounded-lg bg-slate-800 hover:bg-blue-600">
→
</button>

</div>

</section>

@endsection
```

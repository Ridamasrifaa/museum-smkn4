<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel - Museum Karya SMKN 4 Tasikmalaya</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style type="text/tailwindcss">
        @custom-variant dark (&:where(.dark, .dark *));
    </style>
</head>

<body class="bg-gray-100 dark:bg-gray-900 transition">

<header class="bg-white dark:bg-gray-800 shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">

        <a href="/" class="text-2xl font-bold text-blue-600">
            🏛 Museum Karya
        </a>

        <div class="space-x-6">
            <a href="/" class="hover:text-blue-600">Beranda</a>
            <a href="/karya" class="hover:text-blue-600">Karya</a>
            <a href="/artikel" class="text-blue-600 font-bold">Artikel</a>
        </div>

    </div>
</header>

<section class="bg-blue-600 text-white py-16">

    <div class="max-w-7xl mx-auto px-6">

        <h1 class="text-5xl font-bold">
            Artikel Museum
        </h1>

        <p class="mt-4 text-blue-100">
            Berita, Prestasi, Kegiatan dan Informasi terbaru Museum Karya SMKN 4 Tasikmalaya.
        </p>

    </div>

</section>

<section class="max-w-7xl mx-auto px-6 py-12">

    @if($articles->count())

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

        @foreach($articles as $article)

        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow hover:shadow-xl duration-300 overflow-hidden">

            <img
                src="{{ asset('storage/'.$article->cover) }}"
                class="w-full h-56 object-cover">

            <div class="p-6">

                <span class="text-blue-600 text-sm font-semibold">

                    {{ $article->category->name }}

                </span>

                <h2 class="text-2xl font-bold mt-2 mb-3">

                    {{ $article->title }}

                </h2>

                <p class="text-gray-600 dark:text-gray-300 line-clamp-3">

                    {{ $article->excerpt }}

                </p>

                <div class="mt-5 flex justify-between items-center">

                    <small class="text-gray-500">

                        {{ $article->author->name }}

                    </small>

                    <small class="text-gray-500">

                        {{ $article->created_at->format('d M Y') }}

                    </small>

                </div>

                <a
                    href="{{ route('artikel.show',$article->slug) }}"
                    class="mt-6 inline-block bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">

                    Baca Selengkapnya →

                </a>

            </div>

        </div>

        @endforeach

    </div>

    @else

    <div class="text-center py-32">

        <h2 class="text-3xl font-bold">
            Belum ada artikel.
        </h2>

        <p class="mt-3 text-gray-500">
            Artikel akan muncul setelah dipublikasikan oleh admin.
        </p>

    </div>

    @endif

</section>

</body>
</html>
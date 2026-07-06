<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;

class ArticlePageController extends Controller
{
    public function index()
    {
        $articles = Article::with(['category','author'])
            ->where('status','published')
            ->latest()
            ->get();

        return view('artikel', compact('articles'));
    }

public function show($slug)
{
    $article = Article::with(['category', 'author'])
        ->where('slug', $slug)
        ->where('status', 'published')
        ->firstOrFail();

    // Tambah jumlah pembaca
    $article->increment('views');

    // Kategori
    $categories = ArticleCategory::withCount('articles')->get();

    // Artikel terkait
    $related = Article::with('category')
        ->where('status', 'published')
        ->where('category_id', $article->category_id)
        ->where('id', '!=', $article->id)
        ->latest()
        ->take(3)
        ->get();

    // Kalau artikel terkait kurang dari 3
    if ($related->count() < 3) {

        $more = Article::with('category')
            ->where('status', 'published')
            ->whereNotIn('id', $related->pluck('id'))
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(3 - $related->count())
            ->get();

        $related = $related->merge($more);
    }

    // Artikel paling banyak dibaca
    $popular = Article::with('category')
        ->where('status', 'published')
        ->where('id', '!=', $article->id)
        ->orderByDesc('views')
        ->take(4)
        ->get();

    return view('artikel.show', compact(
        'article',
        'categories',
        'related',
        'popular'
    ));
}
}
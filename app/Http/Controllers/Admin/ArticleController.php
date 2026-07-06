<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
    {
      $articles = Article::with(['author','category'])->get();
$categories = ArticleCategory::all();

return view('admin.artikel', compact(
    'articles',
    'categories'
));
    }

    /**
     * Show the form for creating a new resource.
     */
  public function create()
{
    $categories = ArticleCategory::orderBy('name')->get();

    return view('admin.upload-artikel', compact('categories'));
}
    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:255',
        'category_id' => 'required|exists:article_categories,id',
        'excerpt' => 'required|max:200',
        'content' => 'required',
        'cover' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        'status' => 'required|in:draft,published',
        'is_featured' => 'nullable'
    ]);

    $cover = $request->file('cover')->store('articles', 'public');

    Article::create([
        'author_id' => Auth::id(),
        'category_id' => $request->category_id,
        'title' => $request->title,
        'slug' => Str::slug($request->title),
        'excerpt' => $request->excerpt,
        'content' => $request->content,
        'cover' => $cover,
        'status' => $request->status,
        'is_featured' => $request->has('is_featured'),
        'published_at' => $request->status == 'published'
            ? now()
            : null,
    ]);

    return redirect()
        ->route('articles.index')
        ->with('success', 'Artikel berhasil ditambahkan.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
 public function edit($id)
{
    $article = Article::findOrFail($id);

    $categories = ArticleCategory::orderBy('name')->get();

    return view('admin.edit-artikel', compact(
        'article',
        'categories'
    ));
}

    /**
     * Update the specified resource in storage.
     */
    
        public function update(Request $request, $id)
{
    $article = Article::findOrFail($id);

    $request->validate([
        'title' => 'required|max:255',
        'category_id' => 'required|exists:article_categories,id',
        'excerpt' => 'required|max:255',
        'content' => 'required',
        'cover' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'status' => 'required|in:draft,published',
    ]);

    $cover = $article->cover;

    if ($request->hasFile('cover')) {

        if ($article->cover && Storage::disk('public')->exists($article->cover)) {
            Storage::disk('public')->delete($article->cover);
        }

        $cover = $request->file('cover')->store('articles', 'public');
    }

    $article->update([
       'category_id' => $request->category_id,
    'title' => $request->title,
    'slug' => Str::slug($request->title),
        'excerpt' => $request->excerpt,
        'content' => $request->content,
        'cover' => $cover,
        'status' => $request->status,
        'is_featured' => $request->has('is_featured'),
        'published_at' => $request->status == 'published'
            ? now()
            : null,
    ]);

    return redirect()
        ->route('articles.index')
        ->with('success', 'Artikel berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
  public function destroy(string $id)
{
    $article = Article::findOrFail($id);

    $article->delete();

    return redirect()->route('articles.index')
                     ->with('success','Artikel berhasil dihapus');
}
}

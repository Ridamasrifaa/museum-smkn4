<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['author', 'category'])->get();
        $categories = Category::all();

        return view('admin.artikel', compact('articles', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.artikel-form', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'required|max:200',
            'content' => 'required',
            'cover' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:draft,published',
            'is_featured' => 'nullable'
        ]);

       $cover = $this->compressAndSaveImage($request->file('cover'));

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
            'published_at' => $request->status == 'published' ? now() : null,
        ]);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::orderBy('name')->get();

        return view('admin.artikel-form', compact('article', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
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
           $cover = $this->compressAndSaveImage($request->file('cover'));
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
            'published_at' => $request->status == 'published' ? now() : null,
        ]);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dihapus');
    }
    private function compressAndSaveImage($file)
    {
        // Generate nama file acak di dalam folder articles/
        $filename = 'articles/' . Str::random(20) . '.jpg';

        // Ambil data gambar asli
        $source = imagecreatefromstring(file_get_contents($file->getRealPath()));
        $width  = imagesx($source);
        $height = imagesy($source);

        // Resize max lebar 800px dengan merawat aspect ratio
        $maxWidth = 800;
        if ($width > $maxWidth) {
            $newWidth  = $maxWidth;
            $newHeight = intval($height * ($maxWidth / $width));
        } else {
            $newWidth  = $width;
            $newHeight = $height;
        }

        // Buat kanvas baru
        $resized = imagecreatetruecolor($newWidth, $newHeight);

        // Latar belakang putih
        $whiteBackground = imagecolorallocate($resized, 255, 255, 255);
        imagefill($resized, 0, 0, $whiteBackground);

        // Proses resize gambar
        imagecopyresampled(
            $resized, $source,
            0, 0, 0, 0,
            $newWidth, $newHeight,
            $width, $height
        );

        // Algoritma Kompresi Target Max 60 KB
        $maxFileSizeBytes = 60 * 1024;
        $quality = 85; 
        $compressedContent = '';

        do {
            ob_start();
            imagejpeg($resized, null, $quality);
            $compressedContent = ob_get_clean();

            // Turunkan kualitas jika masih di atas target ukuran
            $quality -= 5; 
        } while (strlen($compressedContent) > $maxFileSizeBytes && $quality >= 35);

        // Bersihkan memori server
        imagedestroy($source);
        imagedestroy($resized);

        // Simpan hasil akhir ke storage Laravel
        Storage::disk('public')->put($filename, $compressedContent);

        // Kirim data ukuran ke session untuk keperluan tampilan (opsional)
        session()->flash('foto_original_size', $file->getSize());
        session()->flash('foto_compressed_size', strlen($compressedContent));

        return $filename;
    }
}

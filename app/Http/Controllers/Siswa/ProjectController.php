<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('siswa.karya', compact('projects'));
    }

    public function show(Project $project)
    {
        if ($project->user_id != Auth::id()) {
            abort(403);
        }

        return view('siswa.detail-karya', compact('project'));
    }

    public function destroy(Project $project)
    {
        if ($project->user_id != Auth::id()) {
            abort(403);
        }

        if ($project->file_path) {
            Storage::disk('public')->delete($project->file_path);
        }

        $project->delete();

        return redirect('/siswa/karya')
            ->with('success', 'Karya berhasil dihapus.');
    }

    public function store(Request $request)
    {
        // 1. VALIDASI LANGSUNG DI DALAM CONTROLLER
        $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'jurusan'          => 'required|string|max:255',
            'technology_stack' => 'nullable|string|max:255',
            'live_link'        => 'nullable|url|max:255',
            'iframe_link'      => 'nullable|url|max:500',
            
            // ATURAN REVISI 1: Khusus PPLG WAJIB isi link GitHub
            'github_link'      => $request->jurusan === 'PPLG' ? 'required|url|max:255' : 'nullable|url|max:255',
            
            // ATURAN REVISI 2: Foto opsional jika ada iframe_link, tapi minimal pilih salah satu
            'file_path'        => 'nullable|required_without:iframe_link|image|mimes:jpg,jpeg,png,webp|max:10240',
        ], [
            'github_link.required'       => 'Khusus siswa jurusan PPLG, link repository GitHub wajib diisi!',
            'file_path.required_without' => 'Wajib mengunggah gambar karya jika tidak menyertakan link iframe.',
            'file_path.image'            => 'File yang diunggah harus berupa gambar (JPG, JPEG, PNG, WEBP).',
        ]);

        $path = null;
        $fileType = null;
        $fileSize = null;

        // 2. ATURAN REVISI 3: Logika Kompresi Gambar ke ~50 KB
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            
            // Proses kompresi gambar menggunakan fungsi di bawah
            $path = $this->compressAndSaveImage($file);
            $fileType = 'image/jpeg'; // Hasil kompresi selalu dikonversi ke JPEG
            $fileSize = Storage::disk('public')->size($path);
        }

        // 3. Simpan ke Database
        Project::create([
            'user_id'          => Auth::id(),
            'title'            => $request->title,
            'description'      => $request->description,
            'jurusan'          => $request->jurusan,
            'technology_stack' => $request->technology_stack,
            'live_link'        => $request->live_link,
            'iframe_link'      => $request->iframe_link,
            'github_link'      => $request->github_link,
            'file_path'        => $path,
            'file_type'        => $fileType,
            'file_size'        => $fileSize,
            'status'           => 'pending',
        ]);

        return redirect('/siswa/upload')
            ->with('success', 'Karya berhasil diupload dan dikompres.')
            ->with('active_jurusan', $request->jurusan);
    }

    public function upload()
    {
        $jurusanList = ['PPLG', 'DKV', 'TOI'];

        $jurusanColor = [
            'PPLG' => 'bg-green-600 hover:bg-green-700',
            'DKV'  => 'bg-orange-500 hover:bg-orange-600',
            'TOI'  => 'bg-gray-500 hover:bg-gray-600',
        ];

        $jurusanBadge = [
            'PPLG' => 'bg-green-600',
            'DKV'  => 'bg-orange-500',
            'TOI'  => 'bg-gray-500',
        ];

        return view('siswa.upload', compact('jurusanList', 'jurusanColor', 'jurusanBadge'));
    }

    /**
     * Fungsi Tambahan: Mengompresi gambar hingga ukurannya aman (~50 KB)
     */
    private function compressAndSaveImage($file)
    {
        // Generate nama file acak
        $filename = 'projects/' . Str::random(20) . '.jpg';

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

        // Algoritma Kompresi Target Max 50 KB
        $maxFileSizeBytes = 45 * 1024; // 50 KB
        $quality = 85; 
        $compressedContent = '';

        do {
            ob_start();
            imagejpeg($resized, null, $quality);
            $compressedContent = ob_get_clean();

            // Turunkan kualitas secara bertahap jika masih di atas 50 KB (batas minimal kualitas 25)
            $quality -= 5; 
        } while (strlen($compressedContent) > $maxFileSizeBytes && $quality >= 25);

        // Bersihkan memori server
        imagedestroy($source);
        imagedestroy($resized);

        // Simpan hasil akhir ke storage Laravel
        Storage::disk('public')->put($filename, $compressedContent);

        // Kirim data ukuran ke session untuk keperluan tampilan
        session()->flash('foto_original_size', $file->getSize());
        session()->flash('foto_compressed_size', strlen($compressedContent));

        return $filename;
    }
}
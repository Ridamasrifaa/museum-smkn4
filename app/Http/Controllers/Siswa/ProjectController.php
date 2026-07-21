<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


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
    // Pastikan siswa hanya bisa melihat project miliknya sendiri
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
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'jurusan' => 'required|string|max:255',
        'technology_stack' => 'nullable|string|max:255',
        'live_link' => 'nullable|url|max:255',
        'file_path' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx,zip,rar|max:10240', // max 10MB
    ]);

    // upload gambar
    $path = $request->file('file_path')->store('projects', 'public');
Project::create([
    'user_id'=>Auth::id(),
    'title'=>$request->title,
    'description'=>$request->description,
    'jurusan'=>$request->jurusan,
    'technology_stack'=>$request->technology_stack,
    'live_link'=>$request->live_link,

    'file_path'=>$path,
    'file_type'=>$request->file('file_path')->getClientMimeType(),
    'file_size'=>$request->file('file_path')->getSize(),

    'status'=>'pending'
]);

    return redirect('/siswa/upload')
            ->with('success','Karya berhasil diupload.');
}
public function upload()
{
    $jurusanList = ['PPLG', 'TKJ', 'DKV', 'TOI', 'TSM'];

    // Warna tombol pilihan jurusan (PPLG=success/hijau, TKJ=primary/biru,
    // DKV=warning/orange, TOI=secondary/abu-abu, TSM=danger/merah)
    $jurusanColor = [
        'PPLG' => 'bg-green-600 hover:bg-green-700',
        'TKJ'  => 'bg-blue-600 hover:bg-blue-700',
        'DKV'  => 'bg-orange-500 hover:bg-orange-600',
        'TOI'  => 'bg-gray-500 hover:bg-gray-600',
        'TSM'  => 'bg-red-600 hover:bg-red-700',
    ];

    // Warna badge "Form Upload - XXX"
    $jurusanBadge = [
        'PPLG' => 'bg-green-600',
        'TKJ'  => 'bg-blue-600',
        'DKV'  => 'bg-orange-500',
        'TOI'  => 'bg-gray-500',
        'TSM'  => 'bg-red-600',
    ];

    return view('siswa.upload', compact('jurusanList', 'jurusanColor', 'jurusanBadge'));
}


}
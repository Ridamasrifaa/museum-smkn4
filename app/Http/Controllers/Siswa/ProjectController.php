<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Category;

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
public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'description' => 'required|string',
        'live_link' => 'required|url',
        'file_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
    ]);

    $path = $request->file('file_path')->store('projects', 'public');

    Project::create([
        'user_id' => Auth::id(),
        'category_id' => $request->category_id,
        'title' => $request->title,
        'description' => $request->description,
        'live_link' => $request->live_link,
        'file_path' => $path,
        'file_type' => $request->file('file_path')->getClientMimeType(),
        'file_size' => $request->file('file_path')->getSize(),
        'status' => 'pending',
    ]);

    return redirect('/siswa/karya')->with('success', 'Project berhasil diupload.');
}
public function create()
{
    $categories = Category::all();

    return view('siswa.upload', compact('categories'));
}
public function upload()
{
    $categories = Category::all();

    return view('siswa.upload', compact('categories'));
}
}
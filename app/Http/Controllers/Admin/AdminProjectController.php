<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class AdminProjectController extends Controller
{
public function index(Request $request)
{
    $search = $request->search;

    $projects = Project::with('user')

        ->when($search, function ($query) use ($search) {

            $query->where('title', 'like', "%{$search}%")

                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })

                ->orWhere('jurusan', 'like', "%{$search}%");
        })

        ->latest()
        ->simplePaginate(10)
        ->withQueryString();

    return view('admin.karya', compact('projects'));
}
    public function updateStatus(Request $request, Project $project)
{
    $request->validate([
        'status' => 'required|in:approved,rejected',
        'catatan' => 'nullable|string'
    ]);

    if ($request->status == 'approved') {

        $project->update([
            'status' => 'approved',
            'approval_note' => $request->catatan,
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

    } else {

        $project->update([
            'status' => 'rejected',
            'rejection_reason' => $request->catatan,
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

    }

    return redirect('/admin/karya')
        ->with('success','Status berhasil diperbarui');
}

    public function show(Project $project)
    {
        return view('admin.detail-karya', compact('project'));
    }

    public function destroy(Project $project)
    {
        if ($project->file_path) {
            Storage::disk('public')->delete($project->file_path);
        }

        $project->delete();

        return redirect('/admin/karya')
            ->with('success', 'Karya berhasil dihapus.');
    }
}
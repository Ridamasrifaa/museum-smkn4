<?php

namespace App\Http\Controllers;

use App\Models\Project;

class KaryaController extends Controller
{
    public function index()
    {
        $karyas = Project::with('user')
            ->approved()
            ->latest()
            ->get();

        return view('karya', compact('karyas'));
    }

    public function show(Project $project)
    {
        return view('karya.detail', compact('project'));
    }

    public function like(Project $project)
    {
        $project->increment('likes_count');

        return response()->json(['likes' => $project->likes_count]);
    }
}
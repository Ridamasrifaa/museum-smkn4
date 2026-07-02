<?php

namespace App\Http\Controllers;

use App\Models\Project;

class KaryaController extends Controller
{
    public function index()
{
    $karyas = Project::with(['user','category'])
        ->approved()
        ->latest()
        ->get();

    return view('karya', compact('karyas'));
}

    public function show(Project $project)
    {
        return view('karya.detail', compact('project'));
    }
}
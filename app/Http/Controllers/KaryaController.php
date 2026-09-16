<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class KaryaController extends Controller
{
    /**
     * Menampilkan daftar seluruh karya yang disetujui.
     */
    public function index()
    {
        $karyas = Project::with('user')
            ->approved()
            ->latest()
            ->get(); // Mengambil seluruh data agar dikelola oleh pagination JavaScript

        return view('karya', compact('karyas'));
    }

    /**
     * Menampilkan detail karya tertentu.
     */
    public function show(Project $project)
    {
        return view('karya.detail', compact('project'));
    }

    /**
     * Menambahkan jumlah suka (like) pada karya.
     */
    public function like(Project $project)
    {
        $project->increment('likes_count');

        return response()->json([
            'likes' => $project->likes_count
        ]);
    }
}
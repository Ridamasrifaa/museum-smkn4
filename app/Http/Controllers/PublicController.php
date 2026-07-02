<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;

class PublicController extends Controller
{
    public function index()
    {
        $projects = Project::with(['user','category'])
            ->where('status', 'approved')
            ->latest()
            ->get();

        $totalKarya = Project::where('status', 'approved')->count();

     $totalSiswa = User::where('role', 2)->count();

$totalAdmin = User::where('role', 1)->count();
        return view('index', compact(
            'projects',
            'totalKarya',
            'totalSiswa',
            'totalAdmin'
        ));
    }
}
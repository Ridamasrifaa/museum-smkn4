<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalProject = Project::count();

        $pending = Project::pending()->count();

        $approved = Project::approved()->count();

        $totalSiswa = User::where('role', 2)->count();

        return view('admin.dashboard', compact(
            'totalProject',
            'pending',
            'approved',
            'totalSiswa'
        ));
    }
}
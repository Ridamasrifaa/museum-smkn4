<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Query Utama
        $projectQuery = Project::query();
        $siswaQuery = User::where('role', 2); // Role 2 = Siswa

        // Filter Jurusan jika BUKAN Super Admin
        if (!$user->isSuperAdmin() && $user->jurusan) {
            $projectQuery->where('jurusan', $user->jurusan);
            $siswaQuery->where('jurusan', $user->jurusan);
        }

        // Hitung Statistik
        $totalProject = (clone $projectQuery)->count();
        $pending      = (clone $projectQuery)->pending()->count();
        $approved     = (clone $projectQuery)->approved()->count();
        $totalSiswa   = $siswaQuery->count();

        // Overview 1: Karya Menunggu Moderasi (Max 5)
        $pendingProjects = (clone $projectQuery)
            ->with('user')
            ->pending()
            ->latest()
            ->take(5)
            ->get();

        // Overview 2: Karya Terbaru yang Sudah Disetujui (Max 5)
        $approvedProjects = (clone $projectQuery)
            ->with('user')
            ->approved()
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProject',
            'pending',
            'approved',
            'totalSiswa',
            'pendingProjects',
            'approvedProjects',
            'user'
        ));
    }
}
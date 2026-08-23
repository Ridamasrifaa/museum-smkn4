<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use App\Models\InvitationCode;

class DashboardController extends Controller
{
    public function index()
    {
        // ================= RINGKASAN / TOTAL DATA =================
        $totalKarya    = Project::count();
        $totalSiswa    = User::where('role', 2)->count();
        $totalKodeUnik = InvitationCode::count();

        // ================= KARYA TERBARU DARI SISWA =================
        // 'user' = siswa yang upload, 'reviewer' = admin yang sudah review (kalau sudah)
        $karyaTerbaru = Project::with(['user', 'reviewer'])
            ->latest()
            ->take(5)
            ->get();

        // ================= DAFTAR ADMIN & AKTIVITASNYA =================
        // Admin (role = 1) diukur dari jumlah karya yang sudah mereka review.
        $daftarAdmin = User::where('role', 1)
            ->withCount('reviewedProjects')
            ->latest()
            ->take(10)
            ->get();

        return view('superadmin.dashboard', compact(
            'totalKarya',
            'totalSiswa',
            'totalKodeUnik',
            'karyaTerbaru',
            'daftarAdmin'
        ));
    }
}
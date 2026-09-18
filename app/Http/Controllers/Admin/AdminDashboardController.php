<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;

class AdminDashboardController extends Controller
{
    /**
     * Daftar 5 jurusan tetap yang ditampilkan di dashboard,
     * lengkap dengan emoji dan warna neubrutalism masing-masing.
     */
    protected array $jurusanMeta = [
        'PPLG' => ['label' => 'PPLG', 'emoji' => '💻', 'bar' => 'bg-[#ffcc00]', 'dot' => 'bg-yellow-500'],
        'TJKT' => ['label' => 'TJKT', 'emoji' => '🌐', 'bar' => 'bg-sky-400',   'dot' => 'bg-sky-500'],
        'TOI'  => ['label' => 'TOI',  'emoji' => '⚙️', 'bar' => 'bg-purple-400', 'dot' => 'bg-purple-500'],
        'DKV'  => ['label' => 'DKV',  'emoji' => '🎨', 'bar' => 'bg-green-400', 'dot' => 'bg-green-500'],
        'TSM'  => ['label' => 'TSM',  'emoji' => '🏍️', 'bar' => 'bg-rose-400',  'dot' => 'bg-rose-500'],
    ];

    public function index()
    {
        $totalProject = Project::count();

        $pending = Project::pending()->count();

        $approved = Project::approved()->count();

        $totalSiswa = User::where('role', 2)->count();

        // Statistik & Aktivitas per 5 Jurusan (PPLG, TJKT, TOI, DKV, TSM)
        $jurusanStats = [];
        foreach ($this->jurusanMeta as $kode => $meta) {
            $count = (clone $projectQuery)->byJurusan($kode)->count();

            $jurusanStats[] = [
                'kode'       => $kode,
                'label'      => $meta['label'],
                'emoji'      => $meta['emoji'],
                'bar'        => $meta['bar'],
                'dot'        => $meta['dot'],
                'count'      => $count,
                'percentage' => $totalProject > 0 ? round(($count / $totalProject) * 100, 1) : 0,
                'latest'     => (clone $projectQuery)->byJurusan($kode)->latest()->first(),
            ];
        }

        return view('admin.dashboard', compact(
            'totalProject',
            'pending',
            'approved',
<<<<<<< Updated upstream
            'totalSiswa'
=======
            'totalSiswa',
            'pendingProjects',
            'approvedProjects',
            'jurusanStats',
            'user'
>>>>>>> Stashed changes
        ));
    }
}
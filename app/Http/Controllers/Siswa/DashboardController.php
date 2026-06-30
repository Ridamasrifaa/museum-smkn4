<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
{
    $user = Auth::user();

    $totalProject = Project::where('user_id', $user->id)->count();

    $approved = Project::where('user_id', $user->id)
        ->approved()
        ->count();

    $pending = Project::where('user_id', $user->id)
        ->pending()
        ->count();

    return view('siswa.dashboard', compact(
        'totalProject',
        'approved',
        'pending'
    ));
}
}

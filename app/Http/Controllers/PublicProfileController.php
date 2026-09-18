<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- TAMBAHKAN BARIS INI DI ATAS

class PublicProfileController extends Controller
{
    public function show($id)
    {
        $user = User::with(['projects' => function($query) {
            $query->withCount(['likes', 'comments'])
                  ->with(['likes' => function($q) {
                      $q->where('user_id', Auth::id());
                  }]);
        }])->findOrFail($id);

        return view('profile.show', compact('user'));
    }
}
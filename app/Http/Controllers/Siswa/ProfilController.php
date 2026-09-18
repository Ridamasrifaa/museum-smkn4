<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfilController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $projects = $user->projects()
            ->withCount(['likes', 'comments'])
            ->with(['likes' => function($q) use ($user) {
                $q->where('user_id', $user->id);
            }])
            ->latest()
            ->get();

        return view('siswa.profil-siswa', compact('user', 'projects'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('siswa.edit-profil', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'jurusan'  => 'nullable|string|max:255', // Diubah dari 'in:...' menjadi string bebas
            'bio'      => 'nullable|string|max:500', 
            'avatar'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => ['nullable', 'confirmed', Password::min(6)],
        ]);

        $user->name    = $validated['name'];
        $user->jurusan = $validated['jurusan'] ?? $user->jurusan;
        $user->bio     = $request->bio; 

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = '/storage/' . $path;
        }

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('siswa.profil')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
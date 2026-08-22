<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfilController extends Controller
{
    /**
     * Tampilkan halaman profil + karya milik user yang login
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $projects = $user->projects()
            ->latest()
            ->get();

        return view('siswa.profil-siswa', compact('user', 'projects'));
    }

    /**
     * Tampilkan form edit profil
     */
    public function edit()
    {
        $user = Auth::user();
        return view('siswa.edit-profil', compact('user'));
    }

    /**
     * Proses update profil
     */
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'kelas'    => 'nullable|string|max:50',
            'jurusan'  => 'nullable|string|max:50',
            'angkatan' => 'nullable|integer|min:2000|max:' . (date('Y') + 1),
            'avatar'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => ['nullable', 'confirmed', Password::min(6)],
        ]);

        // Update data dasar
        $user->name     = $validated['name'];
        $user->kelas    = $validated['kelas'] ?? $user->kelas;
        $user->jurusan  = $validated['jurusan'] ?? $user->jurusan;
        $user->angkatan = $validated['angkatan'] ?? $user->angkatan;

        // Update avatar jika ada
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = '/storage/' . $path;
        }

        // Update password jika diisi
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('siswa.profil')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
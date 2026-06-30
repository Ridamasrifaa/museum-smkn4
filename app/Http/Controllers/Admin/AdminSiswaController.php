<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminSiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $siswas = User::where('role', 2)

            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where('name', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%")
                     ;
                });

            })

            ->latest()
            ->get();

        return view('admin.siswa', compact('siswas'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'kelas' => 'required',
            'email' => 'required|email',
        ]);

        $user->update([
            'name' => $request->name,
            'kelas' => $request->kelas,
            'email' => $request->email,
        ]);

        return back()->with('success','Data siswa berhasil diubah.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success','Data siswa berhasil dihapus.');
    }
}
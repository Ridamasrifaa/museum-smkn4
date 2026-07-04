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

        $query = User::where('role', 2)

            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where('name', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%")
                     ;
                });

            });

        $totalSiswa = (clone $query)->count();

        $siswas = $query->latest()
            ->simplePaginate(10)
            ->withQueryString();

        return view('admin.siswa', compact('siswas', 'totalSiswa'));
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
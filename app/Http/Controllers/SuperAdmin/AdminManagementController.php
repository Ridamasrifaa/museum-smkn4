<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminManagementController extends Controller
{
    public function index(Request $request)
    {
        $admins = User::whereIn('role', [0, 1]); // Super Admin + Admin Biasa

        if ($request->search) {
            $admins->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $admins = $admins->latest()->paginate(5);

        return view('superadmin.manajemen-admin', compact('admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:0,1,2', // Memastikan role bernilai 0, 1, atau 2
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => (int) $request->role, // Pastikan dikonversi ke Integer
            'status'   => 'approved',
        ]);

        return redirect()->back()->with('success', 'User berhasil ditambahkan!');
    }

    public function update(Request $request, User $user)
    {
        // Hanya boleh update user role 0 atau 1
        if (!in_array($user->role, [0, 1])) {
            return back()->with('error', 'User tidak valid.');
        }

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required|in:0,1',
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->role  = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Admin berhasil diupdate');
    }

    public function destroy(User $user)
    {
        // Hanya boleh hapus role 0 atau 1
        if (!in_array($user->role, [0, 1])) {
            return back()->with('error', 'User tidak valid.');
        }

        // Optional: cegah hapus diri sendiri (bisa dihapus kalau mau boleh)
        // if ($user->id === auth()->id()) {
        //     return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        // }

        $user->delete();

        return back()->with('success', 'Admin berhasil dihapus');
    }
}
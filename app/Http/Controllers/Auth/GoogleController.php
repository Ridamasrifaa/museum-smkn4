<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->stateless()
            ->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        if ($request->has('error')) {
            return redirect('/login')->with('error', 'Login Google dibatalkan.');
        }

        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Cek apakah email sudah terdaftar
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // User sudah ada → langsung login
                Auth::login($user);
                return redirect('/siswa/dashboard');
            }

            // User belum ada → simpan data Google ke session, lalu minta kode undangan
            session([
                'google_user' => [
                    'google_id' => $googleUser->getId(),
                    'name'      => $googleUser->getName(),
                    'email'     => $googleUser->getEmail(),
                    'avatar'    => $googleUser->getAvatar(),
                ]
            ]);

            return redirect()->route('auth.kode-undangan');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Login Google gagal. Silakan coba lagi.');
        }
    }
}
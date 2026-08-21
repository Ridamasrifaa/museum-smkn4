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
        // Jika user membatalkan login Google
        if ($request->has('error')) {
            return redirect('/login')
                ->with('error', 'Login Google dibatalkan.');
        }

        try {

            $googleUser = Socialite::driver('google')
                ->stateless()
                ->user();

            $user = User::updateOrCreate(
                [
                    'email' => $googleUser->getEmail(),
                ],
                [
                    'name' => $googleUser->getName(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => bcrypt('password_siswa123'),
                    'role' => 2,
                ]
            );

            Auth::login($user);

            return redirect('/siswa/dashboard');

        } catch (\Exception $e) {

            return redirect('/login')
                ->with('error', 'Login Google gagal. Silakan coba lagi.');
        }
    }
}
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Auth;

class SocialAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle Google callback
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        // dd($user);

        $existingUser = User::where('email', $user->getEmail())->first();
        if ($existingUser) {
            Auth::login($existingUser);
        } else {
            $newUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt('defaultpassword'), // set a default password or random one
                'email_verified_at' => Carbon::now(),
            ]);
            Auth::login($newUser);
        }

        return redirect()->route('projects.index'); // Redirect to your projects page after login
    }

    // Redirect to GitHub OAuth
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    // Handle GitHub callback
    public function handleGithubCallback()
    {
        $user = Socialite::driver('github')->user();
        $existingUser = User::where('email', $user->getEmail())->first();
        if ($existingUser) {
            Auth::login($existingUser);
        } else {
            $newUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt('defaultpassword'), // set a default password or random one
            ]);
            Auth::login($newUser);
        }

        return redirect()->route('projects.index'); // Redirect to your home page after login
    }
}

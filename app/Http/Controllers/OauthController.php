<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class OauthController extends Controller{

    public function redirectToGoogle(){
        return Socialite::driver('google')
        ->scopes([
            'https://www.googleapis.com/auth/gmail.modify'
            ])
            ->with(['access_type' => 'offline'])
        ->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback(){
        $googleUser = Socialite::driver('google')->user();

        //dd($googleUser);
     
        $user = User::updateOrCreate([
            'google_id' => $googleUser->id,
        ], [
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'google_token' => $googleUser->token,
            'google_refresh_token' => $googleUser->refreshToken,
            'password' => null,
        ]);
     
        Auth::login($user);
     
        return redirect('/dashboard');
    }
}
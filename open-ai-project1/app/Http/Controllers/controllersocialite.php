<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\utilisateur;
use Illuminate\Support\Facades\Hash;

class controllersocialite extends Controller
{
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider){
        $SocialUser = Socialite::driver($provider)->user();
        $user = utilisateur::updateOrCreate([
            'provider_id' => $SocialUser->id,
            'provider'=>$provider
        ], [
            'name' => $SocialUser->name,
            'username'=>$SocialUser->nickname,
            'email' => $SocialUser->email,
            'provider_token' => $SocialUser->token,
            'password'=>Hash::make($SocialUser->password)
        ]);
     
        Auth::login($user);
     
        return redirect('/setting');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
class SocialLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        $user = Socialite::driver('google')->user();
        $userCheck = User::where('google_id',$user->id)->first();
        if(!empty($userCheck)){
            Auth::login($userCheck);
            return redirect('users');
        }else{
            $user = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id' => $user->id
            ]);
            Auth::login($user);
            return redirect('users');
        }
    }
}

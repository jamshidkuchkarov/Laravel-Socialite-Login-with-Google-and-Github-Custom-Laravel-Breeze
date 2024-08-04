<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {

        try {
            $SocialUser = Socialite::driver($provider)->user();

            if(User::where('email', $SocialUser->getEmail())->exists()) {
                return  redirect('/login')
                    ->withErrors(['email'=>'This email is already registered,please choose another one.']);
            }

            $user = User::where([
                'provider_id' => $SocialUser->id,
                'provider' => $provider,
            ])->first();

            if(!$user){
                $user = User::create(
                    [
                        'name' => $SocialUser->getName(),
                        'username' => User::generateUserName($SocialUser->nickname),
                        'email' => $SocialUser->getEmail(),
                        'provider' =>$provider,
                        'provider_id' => $SocialUser->getId(),
                        'provider_token' => $SocialUser->token,
                        'email_verified_at' => now(),

                    ]);
            }
            Auth::login($user);

            return redirect('/dashboard');
        }
        catch (\Exception $e) {
            dd($e->getMessage());
            return redirect('/login');
        }


    }

}

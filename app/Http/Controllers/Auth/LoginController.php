<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;

class LoginController extends Controller
{

    use AuthenticatesUsers;

  
    public function redirectToProvider()
    {
         return Socialite::driver('github')->redirect();        
    }

    public function handleProviderCallback()
    {
        $githubUser = Socialite::driver('github')->user();

        $user = $this->findOrCreateGithubUser($githubUser);

        auth()->login($user);

        return redirect('/');
    }

    public function findOrCreateGithubUser($githubUser)
    {

        $user = User::firstOrNew(['github_id'=>$githubUser->id]);
        
        if ($user->exists) {
                    
            return $user;
        }


        $user->fill([
            'name' => $githubUser->nickname,
            'email' => $githubUser->email,
            'avatar' => $githubUser->avatar,
        ])->save();

        return $user;

    }

}







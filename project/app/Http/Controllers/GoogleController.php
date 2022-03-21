<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->user();
       		
            // dd($user);

            $finduser = User::where('google_id', $user->id)->first();
       
            if($finduser){
       
                Auth::login($finduser);
      
                return redirect()->route('myAccount');
       
            }else{
            	$pass = 'password';
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone_number' => 23423,
                    'google_id'=> $user->id,
                    'password' => Hash::make($pass)
                ]);
      
                Auth::login($newUser);
      
                return redirect()->route('myAccount');
            }
      
        } catch (Exception $e) {
            dd($e);
            dd("ney");
        }
    }
}

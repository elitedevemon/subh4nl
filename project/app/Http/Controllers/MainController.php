<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class MainController extends Controller
{
    public function resetIndex()
    {
    	return view('auth.passwords.email');
    }
     public function varifyEmail(Request $request)
    {
    	$email = $request->email;
    	$exitsEmail = \App\Models\User::where('email', $email)->exists();

    	if ($exitsEmail) {

    		 $details = [
                      'title' => 'Mail from Jardin de Kashmir',
                      'body' => $request->email,
                      'priority' => 'This is for testing email using smtp',
                      'from' => 'from',
                      'sender' => 'Jardin de Kashmir',
                      'to' => 'to',
                      'cc' => 'cc',
                      'bcc' => 'bcc',
                      'replyTo' => 'replyTo',
                      'subject' => 'subject',
                  ];

        //dynamic email need ConFMail.php

                  \Mail::to([$email])->send(new \App\Mail\VarifyEm($details));
                  // dd("Email is Sent.");



    		return back()->with('status','Nous envoyons un lien de réinitialisation de mot de passe sur votre adresse e-mail');
    	}else{
    		return back()->with('status',"nous n'avons pas pu trouver votre e-mail réessayez");
    	}
    	return back();
    }
    public function varifyEmailToken($value)
    {
    	return view('auth.passwords.reset', compact('value'));
    }

    public function varifyPassword(Request $request)
    {
    	    $this->validate($request,[
                    'password' => 'required|confirmed'
                ]);
    	    $user = \App\Models\User::where('email', $request->email)->first();

            // $hashPassword = Auth::user()->password;

           if($user){

                        // $user = User::find(Auth::id());
                        $user->password = Hash::make($request->password);
                        $user->save();
                        return redirect()->route('index');


           }else{
               return redirect()->back()->with('status', 'You put wrong Password try aging');
           }

        return back()->with('status',"Votre mot de passe à été changé avec succès");
    }
}

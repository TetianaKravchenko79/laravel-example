<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Services\Mail;
use App\Models\User;
use App\Http\Requests\ChangePasswordRequest;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

 /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request, Mail $mailer)
    {
    //    print_r($request->email);

    $this->validateEmail($request);

    $user = User::where('email', $request->email)->first();

    if ($user) {
        $newPassword =  \Str::random(8);

            $user->password = \Hash::make($newPassword);
            $user->save();
            
            $mailer->emailTo = $request->email;

            $mailer->funcSend('Your new password', $newPassword);

            return redirect()->route('login')->with('resetPassword', 'A new password has been sent to your email address.');

    } else {
        return redirect()->route('password.request')->with('notExistEmail', 'This Email does not exist.');
    }

  

    }
/**
     * Send a reset link change-password.
     *
     * @param  \Illuminate\Http\Request  $request
     */

    public function linkChangePassword()
    {
   return view('auth.passwords.change');

    }


    /**
     * Send a reset link change-password.
     *
     * @param  \Illuminate\Http\Request  $request
     */

     public function changePassword(ChangePasswordRequest $request)
     {
      $user = auth()->user();  //  \Auth::user();

      $user->password = \Hash::make($request->password);
      $user->save();

      \Auth::logout();

      return redirect(route('login'))->with('changePassword', 'Your password has been changed.');
 
     }
 

}
 
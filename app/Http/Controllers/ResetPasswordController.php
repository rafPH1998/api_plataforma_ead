<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function resetPasswordLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

         return $status = Password::RESET_LINK_SENT 
            ? response()->json(['status' => __($status)]) 
            : response()->json(['email' => __($status)], 422);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:4|max:10'
        ]);
        $status = Password::reset(
            $request->only('email', 'password', 'token'),
            function($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status = Password::PASSWORD_RESET
            ? response()->json(['status' => __($status)]) 
            : response()->json(['email' => __($status)], 422);

    }
}

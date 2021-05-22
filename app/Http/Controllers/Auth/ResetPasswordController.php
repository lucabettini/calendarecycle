<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    // @get      /resetPassword/{token}
    public function index($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    // @get      /resetPassword
    public function store(Request $request)
    {

        // VALIDATION 
        // If this fails, throws an exception and redirects back
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        // PASSWORD RESET
        // If the entered data are valid the closure is invoked, saving
        // the new password in the DB
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        // REDIRECT 
        // Either to /login with confirmation message or back with error message
        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', 'password_changed')
            : back()->with('status', 'failed');
    }
}

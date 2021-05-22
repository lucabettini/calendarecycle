<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    // @get      /forgotPassword
    public function index()
    {
        return view('auth.forgot-password');
    }

    // @post      /forgotPassword
    public function store(Request $request)
    {
        // VALIDATION
        // If this fails, throws an exception and redirects back
        $request->validate(['email' => 'required|email']);

        // SEND EMAIL WITH RESET TOKEN
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // SHOW EITHER CONFIRMATION OR ERROR MESSAGE
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => 'success'])
            : back()->with(['status' => 'failed']);
    }
}

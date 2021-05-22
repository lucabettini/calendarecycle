<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    // @get      /login
    public function index()
    {
        return view('auth.login');
    }

    // @post      /register
    public function store(Request $request)
    {
        // VALIDATION 
        // If this fails, throws an exception and redirects back
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // SIGN-IN USER
        // If this fails, redirects back with an error message
        if (!Auth::attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'failed');
        };

        // REDIRECT 
        // Redirects back to the protected route if the request was intercepted 
        // by the auth middleware, otherwise defaults to /home
        return redirect()->intended('home');
    }
}

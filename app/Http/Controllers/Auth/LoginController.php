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

    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // VALIDATION 
        // If this fails, throws an exception and redirects back
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // SIGN-IN USER
        if (!Auth::attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'failed');
        };

        // REDIRECT 
        return redirect()->intended('home');
    }
}

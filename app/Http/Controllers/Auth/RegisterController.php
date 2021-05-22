<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }


    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // VALIDATION
        // If this fails, throws an exception and redirects back
        $this->validate($request, [
            'name' => 'required|max:255|unique:users',
            'email' => 'required|max:255|email|unique:users',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->letters()->numbers()
            ],
            'timezone' => 'max:255'
        ]);

        // STORE USER IN DATABASE
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'timezone' => $request->timezone
        ]);

        // SIGN-IN USER AND REDIRECT
        Auth::attempt($request->only('email', 'password'));
        return redirect()->route('home');
    }
}

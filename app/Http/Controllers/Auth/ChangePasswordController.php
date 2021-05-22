<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    // @get      /changePassword
    public function index()
    {
        return view('auth.change-password');
    }

    // @post    /changePassword
    public function store(Request $request, User $user)
    {
        // GET CURRENT USER INSTANCE 
        $currentUser = $user->find(auth()->user()->id);

        // OLD PASSWORD VALIDATION
        // If this fails, redirects back with an error message
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->withErrors([
                'old_password' => 'The old password is not valid'
            ]);
        };

        // NEW PASSWORD VALIDATION
        // If this fails, throws an exception and redirects back
        $this->validate($request, [
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->letters()->numbers()
            ]
        ]);

        // CHANGE PASSWORD IN DB
        $currentUser->update([
            'password' => Hash::make($request->password),
        ]);

        // SIGN-IN USER AND REDIRECT
        // Redirects back, confirmation message is shown 
        return back()->with('status', 'success');
    }
}

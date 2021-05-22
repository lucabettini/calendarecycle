<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EditAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    // @get     /editAccount
    public function index()
    {
        return view('auth.edit-profile');
    }

    // @put     /editAccount
    public function store(Request $request, User $user)
    {

        // GET CURRENT USER INSTANCE 
        $currentUser = $user->find(auth()->user()->id);

        // VALIDATION
        // If this fails, redirects back with an error message
        // Ignoring currentUser in case name or email were not changed
        $this->validate($request, [
            'name' => [
                'required',
                'max:255',
                Rule::unique('users')->ignore($currentUser)
            ],
            'email' => [
                'required',
                'max:255',
                'email',
                Rule::unique('users')->ignore($currentUser)
            ],

        ]);

        // CHANGE INFOS IN DB
        $currentUser->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        // REDIRECT TO /profile
        return redirect()->route('profile');
    }

    // @delete     /editAccount
    public function destroy(Request $request, User $user)
    {
        // GET CURRENT USER INSTANCE
        $currentUser = $user->find(auth()->user()->id);

        // LOGOUT 
        Auth::logout();
        $request->session()->invalidate();
        // regenerate CSRF token
        $request->session()->regenerateToken();

        // DELETE USER FROM DB
        $currentUser->delete();

        // REDIRECT TO /
        return redirect('/');
    }
}

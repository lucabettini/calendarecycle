<?php

namespace App\Http\Controllers;

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

    public function index()
    {
        return view('auth.edit-profile');
    }

    public function store(Request $request, User $user)
    {

        // Get current user instance
        $currentUser = $user->find(auth()->user()->id);

        // VALIDATION
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

        $currentUser->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect()->route('profile');
    }

    public function destroy(User $user)
    {
        $currentUser = $user->find(auth()->user()->id);
        Auth::logout();
        $currentUser->delete();

        return redirect('/');
    }
}

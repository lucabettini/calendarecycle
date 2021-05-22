<?php

namespace App\Http\Controllers;

use App\Http\Requests\BinRequest;
use App\Models\Bin;
use Illuminate\Http\Request;

class BinController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    // @get      /addBin
    public function index()
    {
        return view('forms.addBin');
    }


    // @post    /bins
    public function store(BinRequest $request)
    {
        // VALIDATION 
        // At this point, the request was already validated. See BinRequest
        // for validation rules

        // ADD BIN TO DB
        $request->user()->bins()->create([
            'name' => $request->name,
            'color' => $request->color,
            'day' => $request->day,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
        ]);

        // REDIRECT TO /home
        return redirect()->route('home');
    }

    // @get     /bins/edit/{id}
    public function edit(Bin $bin)
    {
        return view('forms.editBin', [
            'bin' => $bin
        ]);
    }

    // @put     /bins/edit/{id}
    public function update(BinRequest $request, Bin $bin)
    {
        // VALIDATION 
        // At this point, the request was already validated. See BinRequest
        // for validation rules

        // AUTHENTICATION
        // See BinPolicy for authentication
        if ($request->user()->cannot('change', $bin)) {
            abort(403);
        }

        // UPDATE BIN IN DB
        $bin->update([
            'name' => $request->name,
            'color' => $request->color,
            'day' => $request->day,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
        ]);

        // REDIRECT TO /home
        return redirect()->route('home');
    }

    // @delete     /bins/edit/{id}
    public function destroy(Request $request, Bin $bin)
    {

        // AUTHENTICATION
        // See BinPolicy for authentication
        if ($request->user()->cannot('change', $bin)) {
            abort(403);
        }

        // DELETE BIN IN DB
        $bin->delete();

        // REDIRECT TO /home
        return redirect()->route('home');
    }
}

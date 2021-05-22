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

    // @get     /bins/edit/id
    public function edit(Bin $bin)
    {
        return view('forms.editBin', [
            'bin' => $bin
        ]);
    }

    // @post    /bins
    public function store(BinRequest $request)
    {
        // See BinRequest for validation rules
        $request->user()->bins()->create([
            'name' => $request->name,
            'color' => $request->color,
            'day' => $request->day,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
        ]);

        return redirect()->route('home');
    }

    // @put     /bins/edit/id
    public function update(BinRequest $request, Bin $bin)
    {

        // See BinRequest for validation rules
        // See BinPolicy for authentication
        if ($request->user()->cannot('change', $bin)) {
            abort(403);
        }

        $bin->update([
            'name' => $request->name,
            'color' => $request->color,
            'day' => $request->day,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
        ]);

        return redirect()->route('home');
    }

    // @delete     /bins/edit/id
    public function destroy(Request $request, Bin $bin)
    {

        // See BinPolicy for authentication
        if ($request->user()->cannot('change', $bin)) {
            abort(403);
        }

        $bin->delete();

        return redirect()->route('home');
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function home()
    {
        return view('home', [
            'bins' => auth()->user()->bins
                ->where('day', Carbon::now(auth()->user()->timezone)->dayOfWeek)
                ->sortBy('start_at')
        ]);
    }

    public function tomorrow()
    {
        return view('home', [
            'bins' => auth()->user()->bins
                ->where('day', Carbon::tomorrow(auth()->user()->timezone)->dayOfWeek)
                ->sortBy('start_at')
        ]);
    }

    public function week()
    {
        return view('home', [
            'bins' => auth()->user()->bins
                ->sortBy([
                    ['day', 'asc'],
                    ['start_at', 'asc']
                ])
        ]);
    }
}

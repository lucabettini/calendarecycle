<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    // @get     /home
    public function home()
    {
        // Pass only today's bins to the view
        return view('home', [
            'bins' => auth()->user()->bins
                ->where('day', Carbon::now(auth()->user()->timezone)->dayOfWeek)
                ->sortBy('start_at')
        ]);
    }

    // @get     /tomorrow
    public function tomorrow()
    {
        // Pass only tomorrow's bins to the view
        return view('home', [
            'bins' => auth()->user()->bins
                ->where('day', Carbon::tomorrow(auth()->user()->timezone)->dayOfWeek)
                ->sortBy('start_at')
        ]);
    }

    // @get     /week
    public function week()
    {
        // Pass all bins to the view, sorted by day
        return view('home', [
            'bins' => auth()->user()->bins
                ->sortBy([
                    ['day', 'asc'],
                    ['start_at', 'asc']
                ])
        ]);
    }
}

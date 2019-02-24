<?php

namespace App\Http\Controllers;

use App\Http\Requests\VenueAddRequest;
use App\Venue;
use Auth;

class VenueController extends Controller
{
    public function store(VenueAddRequest $request)
    {
        $venue = new Venue;
        $venue->creator_id = Auth::id();
        $venue->name = $request->name;
        $venue->address = $request->address;
        $venue->postcode = $request->postcode;
        $venue->latitude = $request->latitude;
        $venue->longitude = $request->longitude;
        $venue->website = $request->website ?? '';
        $venue->telephone = $request->telephone ?? '';
        $venue->save();

        return redirect('/');
    }
}

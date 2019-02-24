<?php

namespace App\Http\Controllers;

use App\Http\Requests\VenueSearchRequest;
use App\Venue;

class VenueSearchController extends Controller
{
    public function index(VenueSearchRequest $request)
    {
        $venues = Venue::whereBetween(
            'latitude',
            [$request->swlat, $request->nelat]
        )->whereBetween(
            'longitude',
            [$request->swlng, $request->nelng]
        )->select([
            'id',
            'name',
            'address',
            'postcode',
            'telephone',
            'latitude',
            'longitude',
        ])->get();

        if ($request->isXmlHttpRequest()) {
            return response()->json($venues);
        }

        return $venues;
    }
}

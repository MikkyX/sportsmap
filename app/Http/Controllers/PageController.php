<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $latitude = session('latitude', 54.00366);
        $longitude = session('longitude', -2.547855);

        return view('index', [
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
    }
}

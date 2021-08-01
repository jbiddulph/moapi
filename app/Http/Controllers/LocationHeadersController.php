<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationHeadersController extends Controller
{
    public function index(Location $location)
    {
        $headers = $location->headers;
        
        \Log::info($headers);
        return response()->json($headers);
    }
}

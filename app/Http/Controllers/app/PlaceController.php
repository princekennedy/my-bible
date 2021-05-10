<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Facades\App\Cache\PlacesCache;

class PlaceController extends Controller
{
    
    public function index(){
        $places = PlacesCache::getPlacePaginate();
        return Inertia("places/index", compact('places'));
    }
}
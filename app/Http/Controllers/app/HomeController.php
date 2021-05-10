<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use Facades\App\Cache\UsersCache;
use Facades\App\Cache\PlacesCache;
use App\Models\Company;
use App\Models\Place;

class HomeController extends Controller
{

    public function index(){
        $cards = [
			[
				"name" => "Companies",
				"total" => Company::count(),
				"icon" => "  fa fa-database ",
				"link" => "/company",
			],				
			[
				"name" => "Users",
				"total" => UsersCache::countUsers(),
				"icon" => "  fa fa-users ",
				"link" => "/users",
			],			
			[
				"name" => "Depos",
				"total" => PlacesCache::countPlaces(),
				"icon" => "  fa fa-wallet ",
				"link" => "/places",
			],
			[
				"name" => "Waiting List",
				"total" => 900,
				"icon" => "  fa fa-users ",
				"link" => "/waiting-list",
			]
		];

        $places = Place::paginate(10);
        $users = PlacesCache::getAllPlacesWaitingList();
        return Inertia('home', compact('cards', 'places', 'users') );
    }

    public function waitingList(){
        $users = PlacesCache::getAllPlacesWaitingList();
        return Inertia('places/waiting-list', compact('users') );
    }


	
}

// dd(request()->getClientIp());
// $ip = request()->ip();
// $ip = '196.216.9.155'; //For static IP address get
// $location = Location::get($ip); 
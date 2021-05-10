<?php
namespace App\Cache;
use App\Models\Place;

class PlacesCache{

    public function getPlaces(){
        return Place::with("users")->get();
    }    

    public function getPlacePaginate(){
        return Place::with("users")->paginate(10);
    }    

    public function countPlaces(){
        return count( $this->getPlaces());
    }    

    public function getAllPlacesWaitingList(){
        $places = Place::select([
                "places.*",
                "users.firstname",
                "users.lastname",
                "users.email",
            ])
            ->join("place_user", "place_user.place_id", "places.id")
            ->join("users", "place_user.user_id", "places.id")
            ->paginate(10);
		// $places = $this->getPlaces();
		// $data = [];
		// foreach ($places as $place) {
		//     $data = array_merge($data, $places->toArray());
		// }   
		return $places; 	
    }

}
<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use DB;

class PlaceUserFactory extends Factory
{
    /**Database\Factories;
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = "place_user"; //Model::class;

    // protected $table = "place_user";

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }

    public static function placeUser(){
        for ($i = 0; $i < 100; $i++) {
            $params = [
                "user_id" => \App\Models\User::inRandomOrder()->first()->id,
                "place_id" => \App\Models\Place::inRandomOrder()->first()->id,
                "created_by" => \App\Models\User::inRandomOrder()->first()->id,
            ];
            DB::table("place_user")->insert($params);
        }

    }
}

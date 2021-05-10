<?php

namespace Database\Factories;

use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PlaceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Place::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'long' => rand(1,100),
            'lat' => rand(1,140),
            'company_id' =>  \App\Models\Company::inRandomOrder()->first()->id,
            'created_by' =>  \App\Models\User::inRandomOrder()->first()->id,
            'description' => $this->faker->word,
            // Str::random(10),
        ];
    }
}

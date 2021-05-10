<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(15)->create();
        \App\Models\Company::factory(5)->create();
        \App\Models\Place::factory(20)->create();
        \Database\Factories\PlaceUserFactory::placeUser();
        \Database\Factories\AdminFactory::seedAdmin();
    }
}

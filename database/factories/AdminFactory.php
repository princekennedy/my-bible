<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

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

    public static function seedAdmin(){

        $user = \App\Models\User::first();
        $role = \App\Models\Role::first();
        $permissions = \App\Models\Permission::all();
        $company = \App\Models\Company::all();

        if(count($company)) $user->companies()->sync($company);
        if(count($permissions)) $role->permissions()->sync($permissions);
        if($role) $user->roles()->sync($role);
        
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\CreatedUpdatedTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes, 
        Notifiable, HasApiTokens, 
        CreatedUpdatedTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'firstname', 'lastname','email',
        'password','email_verified_at',

        'created_at', 'updated_at', 'deleted_at', 
        'created_by', 'updated_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    
    protected $casts = [
       'created_at' => 'datetime:Y-m-d h:i:s',
       'updated_at' => 'datetime:Y-m-d h:i:s',
       'deleted_at' => 'datetime:Y-m-d h:i:s'
    ];

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }


}
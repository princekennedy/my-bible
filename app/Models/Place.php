<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedUpdatedTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use HasFactory, CreatedUpdatedTrait, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'description','long','lat',

        'created_at', 'updated_at', 'deleted_at', 
        'created_by', 'updated_by'
    ];
    
    protected $casts = [
       'created_at' => 'datetime:Y-m-d h:i:s',
       'updated_at' => 'datetime:Y-m-d h:i:s',
       'deleted_at' => 'datetime:Y-m-d h:i:s'
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\CreatedUpdatedTrait;

class Company extends Model
{
    use HasFactory, SoftDeletes,CreatedUpdatedTrait;

    protected $casts = [
       'created_at' => 'datetime:Y-m-d h:i:s',
       'updated_at' => 'datetime:Y-m-d h:i:s',
       'deleted_at' => 'datetime:Y-m-d h:i:s'
    ];
    

    protected $fillable = [
      'name', 'description',

        'active',
        'created_at', 'updated_at', 'created_by', 
        'updated_by', 'deleted_at'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function places()
    {
        return $this->belongsToMany(Place::class);
    }

}

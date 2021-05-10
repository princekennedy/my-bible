<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Facades\App\Cache\Users;

trait CreatedUpdatedTrait
{


    public static function bootCreatedUpdatedTrait()
    {

	    if (auth()->check()) {

            // static::addGlobalScope(function (Builder $builder) {
            //     $builder->where('business_id', $connection->id); //->orWhereNull($field);
            // });

            static::creating(function ($model) {
		        $model->created_by = auth()->id();
		    });

            static::updating(function ($model) {
		        $model->updated_by = auth()->id();
		    });

            static::deleting(function ($model) {
                $model->updated_by = auth()->id();
            });

        }
    }

}

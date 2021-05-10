<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Facades\App\Cache\Users;

trait FilterModelByBusinessTrait
{

    public static $arrowed = [
        'product-details', 'shopping-list',
    ];

    public static function getFirstRouteName($route){
        $route = explode('/', $route);
        return ( count($route)) ? $route[0] : '' ;
    }

    public static function bootFilterModelByBusinessTrait()
    {
    	$business = Users::getActiveBusiness();

        if( in_array( self::getFirstRouteName(request()->path()), self::$arrowed ) ) return;

	    if ($business) {

            static::addGlobalScope(function (Builder $builder) use ($business) {
                $builder->where('business_id', $business->id); //->orWhereNull($field);
            });

            static::creating(function ($model) use ($business) {
		        $model->business_id = $business->id;
		    });
            static::updating(function ($model) use ($business) {
		        $model->business_id = $business->id;
		    });
        }
    }

}

<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Facades\App\Cache\Users;
use App\Models\ActiveConfig;

trait ActiveConfigTrait
{

    public static function bootActiveConfigTrait(){}

    public static function setConfig($params, $remove = null){
    	if($remove) self::deleteConfig($remove);
        $activeConfig = ActiveConfig::where('key', _from($params, 'key'))->first();
        ($activeConfig) ? $activeConfig->update($params) : ActiveConfig::create($params);
    }

    public static function getConfig($key){
        if(is_string($key)) return auth()->user()->config()->where('key' , $key)->value('value');
        if(is_array($key)) return auth()->user()->config()->whereIn('key' , $key)->get('value');
    }

    public static function deleteConfig($key){
        if(is_string($key)) return auth()->user()->config()->where('key' , $key)->delete();
        if(is_array($key)) return auth()->user()->config()->whereIn('key' , $key)->delete();
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
  
   /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    /**
    * The attributes that should be cast.
    *
    * @var array
    */
    use SoftDeletes;

    public $table = 'permissions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts = [
       'created_at' => 'datetime:Y-m-d h:i:s',
       'updated_at' => 'datetime:Y-m-d h:i:s',
       'deleted_at' => 'datetime:Y-m-d h:i:s'
    ];
    protected $guarded = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public static function getUserMenus(User $user){
   //   $menuList = self::join('role_menus','user_type_menus.system_menu_id','system_menu.id')
            // ->where('user_type_menus.user_type_id', $user->user_type_id)
        $menuList = self::orderBy('system_menu.sequence', 'ASC')->get();
        $menus  = [];

        foreach ($menuList as $key => $menu) {
            if( ! $menu->parent ){
                $parent = $menu;
                unset($menuList[$key]);
                $parent->children = self::getChildren($menuList, $parent);
                $menus[] = $parent;
            }
        }
        return $menus;
    }    

    public static function getMenus(){
        $menuList = self::orderBy('sequence', 'ASC')->get();
        $menus  = [];
        foreach ($menuList as $key => $menu) {
            if( ! $menu->parent ){
                $parent = $menu;
                unset($menuList[$key]);
                $parent->children = self::getChildren($menuList, $parent);
                $menus[] = $parent;
            }
        }
        return $menus;
    }

    public static function getChildren($menuList, $parent){
        $menus = [];
        foreach ($menuList as $key => $menu) {
            $newParent = $menu;
            if( $menu->parent == $parent->id ){
                unset($menuList[$key]);
                $parent->children = self::getChildren($menuList, $newParent);
                $menus[] = $newParent;
            }
        }
        return $menus;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    


    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */



    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}

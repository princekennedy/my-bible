<?php
namespace App\Cache;
use App\Models\Company;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class UsersCache{

    public function getUsers(){
        return User::all();
    }    

    public function getUserPaginate(){
        return User::paginate(10);
    }    

    public function countUsers(){
        return count($this->getUsers());
    }

	public function getActiveCompany(){
		if(!auth()->check()) return null;
		$company_id = auth()->user()->activeConfig()->where('key' , 'company')->value('value');
	    return Company::where('id', $company_id)->first();
	} 


    public function getRoles(){
        return Role::whereNotIn("id", [1])->get();
    } 

    public function getPermissions(){
        return Permission::get();
    }  

    public function getRolePaginate(){
        return Role::whereNotIn("id", [1])->with("permissions")->paginate();
    }    

}
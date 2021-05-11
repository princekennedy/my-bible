<?php
namespace App\Cache;
use App\Models\Company;
use App\Models\User;

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
}
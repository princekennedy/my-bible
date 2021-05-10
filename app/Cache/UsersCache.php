<?php
namespace App\Cache;
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

}
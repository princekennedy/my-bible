<?php
namespace App\Cache;
use App\Models\Company;

class CompanyCache{

    public function getCompany(){
        return Company::with("users")->get();
    }    

    public function getCompanyPaginate(){
        return Company::with("users")->paginate(10);
    }    

    public function countCompany(){
        return count( $this->getCompany());
    }    

    public function getAllCompanyWaitingList(){
        $company = Company::paginate(10);
		return $company; 	
    }

}
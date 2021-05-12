<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Facades\App\Cache\CompanyCache;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = CompanyCache::getCompanyPaginate();
        return Inertia("company/index", compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = request()->validate([
            "name" => ["required", "unique:companies"],
            "description" => [],
        ]);
        $company = Company::create($validated);
        session()->flash('message' , ($company) ? "Company created sucessfully" : " Company Already exist");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Company $company)
    {
        $validated = request()->validate([
            "name" => ["required"],
            "description" => [],
        ]);
        $company = $company->update($validated);
        session()->flash('message' , "Company Updated sucessfully");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Company $company){
        $company->delete();
        session()->flash('message' , "Company Disabled sucessfully");
        return redirect()->back();
    }

    public function destroy(Company $company)
    {
        $company->delete();
        session()->flash('message' , "Company Disabled sucessfully");
        return redirect()->back();
    }
    public function changeCompany(Company $company){
        auth()->user()->setConfig([ 
            "key" => "company", 
            "value" => $company->id 
        ]);
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Facades\App\Cache\UsersCache;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = UsersCache::getPermissions();
        $roles = UsersCache::getRolePaginate();
        return Inertia("roles/index", compact('roles', 'permissions'));
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
            "name" => ["required", "unique:roles"],
            "permissions" => [],
        ]);
        $role = Role::create($validated);
        if( count( _from($validated, "permissions") ) ) $role->permissions()->sync(_from($validated, "permissions"));
        session()->flash('message' ,"Role created sucessfully" );
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
    public function update(Request $request,Role $role)
    {
        $validated = request()->validate([
            "name" => ["required"],
            "permissions" => [],
        ]);
        $role->update($validated);
        if( count( _from($validated, "permissions") ) ) $role->permissions()->sync(_from($validated, "permissions"));
        session()->flash('message' ,"Role update sucessfully" );
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function delete(Role $role){
        $role->delete();
        session()->flash('message' , "Role deleted sucessfully");
        return redirect()->back();
    }
}

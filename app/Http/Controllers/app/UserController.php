<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Facades\App\Cache\UsersCache;

class UserController extends Controller
{
    
    public function index(){
        $users = UsersCache::getUserPaginate();
        $roles = UsersCache::getRoles();
        return Inertia("users/index", compact('users', 'roles'));
    }

    public function store(Request $request){

        $validated = request()->validate([
            "firstname" => ["required"],
            "lastname" => ["required"],
            "email" => ["required", "unique:users"],
            "password" => ["required"],
            "roles" => [],
        ]);
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);
        if( count( _from($validated, "roles") ) ) $user->roles()->sync(_from($validated, "roles"));
        session()->flash('message' , ($user) ? "User created sucessfully" : " User Already exist");
        return redirect()->back();
    }

    public function update(Request $request, User $user){
        $validated = request()->validate([
            "firstname" => ["required"],
            "lastname" => ["required"],
            "email" => ["required"],
            "roles" => [],
        ]);
        if( $request->password ) $validated['password'] = Hash::make($validated['password']);
        $user->update($validated);
        if( count( _from($validated, "roles") ) ) $user->roles()->sync(_from($validated, "roles"));
        session()->flash('message' , "User updated sucessfully");
        return redirect()->back();
    }

    public function register(){
        return Inertia('users/register');
    }

    public function loginUser(Request $request){
        $params = request()->validate([
            "email" => ["required"],
            "password" => ["required"],
        ]);

        if(
            !Auth::attempt( $params) &&
            !Auth::attempt([
                'email' => $request->username, 
                'password' => $request->password,
            ])
        ){
            return Inertia('auth/login', ['error' => 'Invalid login Credentials']);
        }
        // Auth::user()->createToken("my-pos");//->accessToken;
        return redirect('/');
    }

    public function login(){
        return Inertia('auth/login');
    }

    public function logout(Request $request){
        // Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function delete(User $user){
        $user->delete();
        session()->flash('message' , "User deleted sucessfully");
        return redirect()->back();
    }

}
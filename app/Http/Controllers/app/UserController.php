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
        return Inertia("users/index", compact('users'));
    }

    public function store(Request $request){

        $validated = request()->validate([
            "firstname" => ["required"],
            "lastname" => ["required"],
            "email" => ["required", "unique:users"],
            "password" => ["required"],
        ]);
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);
        return Inertia('users/register', [
            'message' => ($user) ? "User created sucessfully" : " User Already exist"
        ]);
        
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



}
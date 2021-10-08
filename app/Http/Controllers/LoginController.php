<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only("username", "password");

        if(Auth::attempt($credentials)){
            return response(Auth::user(), 200);
        }
        
        abort(401);
    }

    public function logout()
    {
        Auth::logout();
        return response(null, 200);
    }

    public function register(Request $request)
    {
  

        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required'],
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

    }

    public function me(){
        dd(Auth::check());
    }

}

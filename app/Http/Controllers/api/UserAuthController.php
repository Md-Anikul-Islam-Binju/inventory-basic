<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    //user login
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required|email',
            'password'=> 'required'
        ]);
        if(!auth()->attempt($loginData)){
            return response(['message'=>'Invalid Credentials']);
        }
        $accessToken = auth()->user()->createToken('authToken')->plainTextToken;
        return response(['user'=>auth()->user(), 'access_token'=>$accessToken]);
    }






}

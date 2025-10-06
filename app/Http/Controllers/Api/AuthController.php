<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\User;

class AuthController extends Controller
{
    public function login(Request $request){
        
        $user = User::where('username', '=', $request->username);
            if($user){
                if(password_verify($request->password, $user->password)){
                    $response = [
                        'user' => $user,
                        'token' => '123'
                    ];
                return $response;
            }
        }
        return false;
    }

    public function register(){

    }
}

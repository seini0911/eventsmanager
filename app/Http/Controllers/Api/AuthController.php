<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserLoginRequest;
use App\Http\Requests\Api\UserRegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    //

    public function register(UserRegistrationRequest $request){
       if($request->validated()){

            $user  = User::create([
                'name'=> $request->name,
                'phone'=> $request->phone,
                'email'=> $request->email,
                'password'=> bcrypt($request->password)
            ]);
            return response()->json([
                'success'=> true,
                'message'=>'Registration done successfully.',
                'data'=> $user
            ] ,201);
       }
    }

    public function login(UserLoginRequest $request){

        if($request->validated()){
            $token = JWTAuth::attempt(['email' => $request->email, 'password' => $request->password]);
            if(!$token){
                return response()->json([
                    'success'=>false,
                    'message' => 'Unauthorized',
                ], 401);
            }

            return response()->json([
                'success'=>true,
                'message'=>'Login successfull',
                'data'=> $token
            ]);
        }
    }

    public function myAccount(Request $request){
        return response()->json([
            $request->user()
        ]);
    }

    public function logout(){
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json([
            'success'=> true,
            'message'=>'Successfully logged out.'
        ]);
    }

}

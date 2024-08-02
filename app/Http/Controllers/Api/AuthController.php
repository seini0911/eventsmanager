<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Api\ApiExceptions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserLoginRequest;
use App\Http\Requests\Api\UserRegistrationRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{


    /**
     *
     * Register a new user
     * @param \App\Http\Requests\Api\UserRegistrationRequest $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function register(UserRegistrationRequest $request){
       $request->validated();
       try{
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

       }catch(Exception $e){
            return ApiExceptions::handle($e);
       }
    }

    /**
     * Login a user having an account
     * @param \App\Http\Requests\Api\UserLoginRequest $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function login(UserLoginRequest $request){
        $request->validated();
        try{
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
                'token'=> $token
            ]);
        }catch(Exception $e){
            return ApiExceptions::handle($e);
        }
    }

    /**
     * Get the authenticated user
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     *
     *
     */
    public function profile(Request $request){
        return response()->json([
            $request->user()
        ]);
    }

    /**
     *
     * Logout an authenticated user
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function logout(){
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json([
            'success'=> true,
            'message'=>'Successfully logged out.'
        ]);
    }


    // public function refresh(){
    //     return $this->respondWithToken(auth()->refresh());
    // }


    // protected function respondWithToken($token){
    //     return response()->json([
    //         'access_token'=>$token,
    //         'token_type'=> 'bearer',
    //         'expires_in' =>auth()->factory()->getTTL()*60,
    //     ],400);
    // }

}

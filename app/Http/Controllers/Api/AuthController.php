<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Api\ApiExceptions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserLoginRequest;
use App\Http\Requests\Api\UserRegistrationRequest;
use App\Models\User;
use App\Responses\Api\ApiResponse;
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
                'name'=> trim($request->name),
                'phone'=> trim($request->phone),
                'email'=> trim($request->email),
                'password'=> bcrypt($request->password)
            ]);
            return ApiResponse::success($user,'Registration done successfully.', 201);

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
            $token = JWTAuth::attempt(['email' => trim($request->email), 'password' => trim($request->password)]);
            if(!$token){
                return ApiResponse::error('Unauthorized.', 401);
            }
            return ApiResponse::success($token,'Login successfull.');
        }catch(Exception $e){
            return ApiExceptions::handle($e);
        }
    }
    /**
     * Get the authenticated user
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function profile(Request $request){
        return ApiResponse::success($request->user());
    }

    /**
     *
     * Logout an authenticated user
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function logout(){
        try{
            JWTAuth::invalidate(JWTAuth::getToken());
            return ApiResponse::success(null,'Logout successfully.');
        }catch(Exception $e){
            return ApiExceptions::handle($e);
        }
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

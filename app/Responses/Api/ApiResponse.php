<?php

namespace App\Responses\Api;

class ApiResponse
{


    public static function success($data, $message = "Operation done successfully.", $statusCode =200){

        return response()->json([
            'success'=> true,
            'message'=> $message,
            'data'=>$data
        ], $statusCode);
    }


    public static function error($message, $statusCode = 400){

        return response()->json([
            'success'=> false,
            'message'=> $message
        ], $statusCode);
    }
}

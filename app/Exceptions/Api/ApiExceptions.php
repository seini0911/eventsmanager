<?php

namespace App\Exceptions\Api;

use Exception;
use Illuminate\Validation\ValidationException;

class ApiExceptions
{

    public static function handle(Exception $exception){

        //validation errors encountered
        if($exception instanceof  ValidationException){
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $exception->validator->errors()
            ], 422);
        }

        //internal errors encountered
        return response()->json([
            'success' => false,
            'message' => 'An internal server has occured'
        ], 500);
    }


}

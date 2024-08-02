<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //

    public function index(){
        return response()->json("Get all events",200);
    }

    public function store(Request $request){

    }

    public function show($id){

    }


    public function update(Request $request, $id){

    }

    public function destroy($id){

    }

}

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
        return response()->json(['message'=>'storing a new event']);
    }

    public function show($id){
        return response()->json(['message'=>'showing an event']);
    }


    public function update(Request $request, $id){
        return response()->json(['message'=>'updating an event']);
    }

    public function destroy($id){
        return response()->json(['message'=>'deleting an event']);
    }

}

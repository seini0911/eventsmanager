<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class,'login'])->name('login');


Route::middleware(['auth'])->group(function(){
    //get loggein user details
    Route::post('/profile', [AuthController::class,'profile'])->name('profile');
    //logout user
    Route::post('/logout', [AuthController::class,'logout'])->name('logout');
    Route::post('/events',[EventController::class, 'store'])->name('events.store'); //create a new event
    Route::get('/events/user',[EventController::class, 'getUserEvents'])->name('events.users'); //users events
    Route::get('/events',[EventController::class, 'index'])->name('events.index'); //retrieve all events
    Route::get('/events/{event}',[EventController::class, 'show'])->name('events.show'); //show an event
    Route::put('/events/{event}',[EventController::class, 'update'])->name('events.update'); //update an event
    Route::delete('/events/{event}',[EventController::class, 'destroy'])->name('events.delete'); //delete an event
    Route::post('/events/{event}/rsvp',[EventController::class, 'rsvp'])->name('events.rsvp'); //rspv to an event
});

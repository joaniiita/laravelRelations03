<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function(){
    Route::post('register', 'register');
    Route::get('user/{user}', 'show');
    Route::get('user/{user}/address', 'show_address');
    Route::post('users/{user}/events/{event}/book', 'bookEvent');
    Route::get('user/{user}/events', 'listEvents');
});
Route::controller(AddressController::class)->group(function() {
    Route::post('address', 'store');
    Route::get('address/{address}', 'show');
    Route::get('address/{address}/user', 'show_user');
});
Route::controller(EventController::class)->group(function() {
    Route::post('event', 'store');
    Route::get('event/{event}/users', 'listUsers');
});

Route::controller(EventTypeController::class)->group(function() {
    Route::post('type', 'store');
    Route::get('type/{type}', 'listEvents');
});

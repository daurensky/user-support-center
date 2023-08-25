<?php

use Illuminate\Support\Facades\Route;

Route::post('login', 'LoginController@store');
Route::post('register', 'UserController@store');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', 'LoginController@destroy');

    Route::post('requests', 'UserRequestController@store')
        ->middleware('can:create,user_request');
    Route::delete('requests/{userRequest}', 'UserRequestController@destroy')
        ->middleware('can:delete,user_request');

    Route::get('requests', 'UserRequestController@index')
        ->middleware('can:resolve requests');
    Route::put('requests/{userRequest}', 'UserRequestController@update')
        ->middleware('can:resolve requests');
});

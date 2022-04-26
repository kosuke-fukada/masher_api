<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignoutAction;
use App\Http\Controllers\SigninWithTwitterAction;
use App\Http\Controllers\GetTwitterRedirectUrlAction;
use App\Http\Controllers\GetUserInfoAction;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('signin')->group(function() {
    Route::prefix('twitter')->group(function() {
        Route::get('/', GetTwitterRedirectUrlAction::class);
        Route::get('/callback', SigninWithTwitterAction::class);
    });
});

Route::get('/signout', SignoutAction::class);

Route::get('/user', GetUserInfoAction::class);

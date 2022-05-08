<?php

use App\Http\Signout\SignoutAction;
use App\Http\GetTweet\GetTweetAction;
use Illuminate\Support\Facades\Route;
use App\Http\GetUserInfo\GetUserInfoAction;
use App\Http\Signin\SigninWithTwitterAction;
use App\Http\Signin\GetTwitterRedirectUrlAction;
use App\Http\Middleware\VerifyTwitterAccessTokenExpired;
use App\Http\GetTwitterLikeList\GetTwitterLikeListAction;
use App\Http\RefreshTwitterAccessToken\RefreshTwitterAccessTokenAction;

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

Route::prefix('user')->middleware(VerifyTwitterAccessTokenExpired::class)
    ->group(function() {
        Route::get('/', GetUserInfoAction::class);
        Route::get('/refresh/twitter', RefreshTwitterAccessTokenAction::class);
    });

Route::prefix('likes')->middleware(VerifyTwitterAccessTokenExpired::class)
    ->group(function() {
        Route::prefix('twitter')->group(function() {
            Route::get('/', GetTwitterLikeListAction::class);
        });
    });

Route::get('/tweet', GetTweetAction::class);
